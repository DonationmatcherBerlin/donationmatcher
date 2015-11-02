<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_list_entry_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Returns stock list entries of other stock lists that offers stuff you need
     *
     * @param $stock_list_id
     * @return array
     */
    public function get_demand($stock_list_id)
    {
        $category_ids = $this->get_categories($stock_list_id, -1);
        if (empty($category_ids)) {
            return [];
        }

        $foreign_list = $this->get_demand_list($stock_list_id, 1, array_column($category_ids, 'category_id'));
        return $this->handle_exact_match($stock_list_id, $foreign_list, 1);
    }

    /**
     * Returns stock list entries of other stock lists that demand stuff you have
     *
     * @param $stock_list_id
     * @return array
     */
    public function get_offers($stock_list_id)
    {
        $category_ids = $this->get_categories($stock_list_id, 1);
        if (empty($category_ids)) {
            return [];
        }

        $foreign_list = $this->get_demand_list($stock_list_id, -1, array_column($category_ids, 'category_id'));

        return $this->handle_exact_match($stock_list_id, $foreign_list, -1);
    }

    /**
     * Returns all stock list entries of given stock list
     *
     * @param int $stock_list_id
     * @return array
     */
    public function get_by_stock_list($stock_list_id)
    {
        $query = $this->db->query(
            '
              SELECT
                *
              FROM
                stock_list_entry sle
              WHERE
                sle.StockList = ?
            ',
            [
                (int) $stock_list_id,
            ]
        );

        return $query->result_array();
    }

    /**
     * Removes or highlights exact matches
     *
     * @param $stock_list_id
     * @param $foreign_list
     */
    private function handle_exact_match($stock_list_id, $foreign_list, $demand)
    {
        $own_list = $this->get_by_stock_list($stock_list_id);
        foreach ($foreign_list as $i => $foreign_row) {
            foreach ($own_list as $own_row) {
                if ($own_row['name'] == $foreign_row['name']) {
                    switch ((int) $own_row['demand']) {
                        case '0':
                        case $demand:
                            unset($foreign_list[$i]);
                            continue 2;
                            break;
                        case $demand*-1:
                            $foreign_list[$i]['exact'] = true;
                            break;
                    }
                }
            }
        }

        return $foreign_list;
    }

    /**
     * Grouped by facility
     *
     * @param array $list
     * @return array
     */
    private function group(array $list)
    {
        $grouped = [];
        foreach ($list as $entry) {
            $grouped[$entry['facility']][] = $entry;
        }

        return $grouped;
    }

    /**
     * Get all categories of entries with negative demand from own stock list
     */
    private function get_categories($stock_list_id, $demand)
    {
        $query = $this->db->query(
            '
              SELECT
                c.category_id
              FROM stock_list_entry sle
                INNER JOIN category c ON sle.Category = c.category_id
              WHERE
                sle.StockList = ?
                AND sle.demand = ?
              GROUP BY
                c.category_id
            ',
            [
                (int) $stock_list_id,
                (int) $demand
            ]
        );

        return $query->result_array();
    }

    /**
     * Get facilities with positive demand in those categories
     */
    private function get_demand_list($stock_list_id, $demand, array $category_ids)
    {
        $query = $this->db->query(
            '
              SELECT
                sle.name AS `name`,
                c.category_id AS `category_id`,
                c.name AS category_name,
                f.facility_id
              FROM stock_list_entry sle
                INNER JOIN stock_list sl ON sl.stock_list_id = sle.StockList
                INNER JOIN facility f ON f.facility_id = sl.Facility
                INNER JOIN category c ON sle.Category = c.category_id
              WHERE
                sle.StockList != ?
                AND sle.demand = ?
                AND sle.Category IN ('.implode(',', $category_ids).')
            ',
            [
                (int) $stock_list_id,
                (int) $demand
            ]
        );
        $results = $query->result_array();

        return $results;
    }

    /**
     * BUlk updates stock list entries
     *
     * @param array $entries
     */
    public function update(array $entries){
        $this->db->update_batch('stock_list_entry', $entries, 'stock_list_entry_id');
    }

    private $template = [
        // Nahrungsmittel
        ['name' => 'Äpfel', 'parent' => 1],
        ['name' => 'Apfelsaft', 'parent' => 1],
        ['name' => 'Baby Anfangsmilch / Milchpulver', 'parent' => 1],
        ['name' => 'Babynahrung', 'parent' => 1],
        ['name' => 'Bananen', 'parent' => 1],
        ['name' => 'Bonbons', 'parent' => 1],
        ['name' => 'Cornflakes', 'parent' => 1],
        ['name' => 'Cracker', 'parent' => 1],
        ['name' => 'Filterkaffee', 'parent' => 1],
        ['name' => 'Frischkäse', 'parent' => 1],
        ['name' => 'Gewürze', 'parent' => 1],
        ['name' => 'Gurken', 'parent' => 1],
        ['name' => 'Kekse', 'parent' => 1],
        ['name' => 'Kakao', 'parent' => 1],
        ['name' => 'Kindergetränke (Tetrapaks m. Strohhalm)', 'parent' => 1],
        ['name' => 'kleinteiliges Obst (Trauben etc.)', 'parent' => 1],
        ['name' => 'Margarine', 'parent' => 1],
        ['name' => 'Milch (frisch)', 'parent' => 1],
        ['name' => 'Mich (H-Milch, haltbar)', 'parent' => 1],
        ['name' => 'Müsliriegel', 'parent' => 1],
        ['name' => 'Nussnugatcreme/Nutella', 'parent' => 1],
        ['name' => 'Obst allgemein', 'parent' => 1],
        ['name' => 'Orangensaft', 'parent' => 1],
        ['name' => 'Salz (kleine Portionen)', 'parent' => 1],
        ['name' => 'Schokolade', 'parent' => 1],
        ['name' => 'Scheibenkäse (Butterkäse)', 'parent' => 1],
        ['name' => 'Stilles Wasser', 'parent' => 1],
        ['name' => 'Studentenfutter', 'parent' => 1],
        ['name' => 'Tee (schwarz)', 'parent' => 1],
        ['name' => 'Toastbrot', 'parent' => 1],
        ['name' => 'verpackte Snacks allgemein', 'parent' => 1],
        ['name' => 'Weintrauben', 'parent' => 1],
        ['name' => 'Zucker/Würfelzucker', 'parent' => 1],


        // Baby / Kinder Allgemeinbedarf
        ['name' => 'Babybadewannen', 'parent' => 2],
        ['name' => 'Babybetten (Holz)', 'parent' => 2],
        ['name' => 'Babycreme', 'parent' => 2],
        ['name' => 'Babyflaschen', 'parent' => 2],
        ['name' => 'Babyhaarbürsten', 'parent' => 2],
        ['name' => 'Babylotion', 'parent' => 2],
        ['name' => 'Babyöl', 'parent' => 2],
        ['name' => 'Babypuder', 'parent' => 2],
        ['name' => 'Babyreisebetten', 'parent' => 2],
        ['name' => 'Babytragen/Bauchtragen', 'parent' => 2],
        ['name' => 'Babyschlafsäcke', 'parent' => 2],
        ['name' => 'Buggy', 'parent' => 2],
        ['name' => 'Feuchttücher', 'parent' => 2],
        ['name' => 'Fußsack für Kinderwagen', 'parent' => 2],
        ['name' => 'Duschgel Babys/Kinder', 'parent' => 2],
        ['name' => 'Kinderwagen', 'parent' => 2],
        ['name' => 'MaxiCosi', 'parent' => 2],
        ['name' => 'Regenverdeck für Kinderwagen', 'parent' => 2],
        ['name' => 'Shampoo Babys/Kinder', 'parent' => 2],
        ['name' => 'Sterilisator für Babyflaschen', 'parent' => 2],
        ['name' => 'Strumpfhosen', 'parent' => 2],
        ['name' => 'Wickelauflagen', 'parent' => 2],
        ['name' => 'Windeln 1-2', 'parent' => 2],
        ['name' => 'Windeln 3', 'parent' => 2],
        ['name' => 'Windeln 4-5', 'parent' => 2],
        ['name' => 'Wundschutzcreme', 'parent' => 2],
        ['name' => 'Zahnbürsten', 'parent' => 2],
        ['name' => 'Zahnpasta', 'parent' => 2],

        // Kosmetikartikel / Waschen
        ['name' => 'Badelatschen / FlipFlops', 'parent' => 3],
        ['name' => 'Handschuhe', 'parent' => 3],
        ['name' => 'Regenkleidung', 'parent' => 3],
        ['name' => 'Schlafanzüge', 'parent' => 3],
        ['name' => 'Socken', 'parent' => 3],
        ['name' => 'Schuhe (warm &Winter)', 'parent' => 3],
        ['name' => 'Strumpfhosen', 'parent' => 3],
        ['name' => 'Unterwäsche (neu)', 'parent' => 3],
        ['name' => 'Winterjacken', 'parent' => 3],

        // Teenies / Jugendliche Bekleidung
        ['name' => 'Teenies / Jugendliche Bekleidung', 'parent' => 4],
        ['name' => 'Badelatschen / FlipFlops', 'parent' => 4],
        ['name' => 'Jeans (146-176)', 'parent' => 4],
        ['name' => 'Jeans (86-146)', 'parent' => 4],
        ['name' => 'Jogginghosen/-Anzüge', 'parent' => 4],
        ['name' => 'Leggins/Hosen (134-176)', 'parent' => 4],
        ['name' => 'Mützen,Schals, Handschuhe', 'parent' => 4],
        ['name' => 'Pullover/Sweatshirts (134-176)', 'parent' => 4],
        ['name' => 'Regenponchos/Regenkleidung', 'parent' => 4],
        ['name' => 'Schlafanzüge (80-176)', 'parent' => 4],
        ['name' => 'Socken', 'parent' => 4],
        ['name' => 'Strumpfhosen', 'parent' => 4],
        ['name' => 'T-Shirts (146-176)', 'parent' => 4],
        ['name' => 'Unterwäsche neu (80-176)', 'parent' => 4],
        ['name' => 'Winterjacken (50-176)', 'parent' => 4],
        ['name' => 'Winterschuhe (35-38)', 'parent' => 4],

        // Männer-Bekleidung
        ['name' => 'Badelatschen / FlipFlops', 'parent' => 5],
        ['name' => 'Fleecejacken / Pullover', 'parent' => 5],
        ['name' => 'Gürtel', 'parent' => 5],
        ['name' => 'Hosen & Jeans (S/M)', 'parent' => 5],
        ['name' => 'Jacken (kl. Größen)', 'parent' => 5],
        ['name' => 'Jogging- / Baumwollhosen (S-M)', 'parent' => 5],
        ['name' => 'Jogging- / Baumwollhosen (XL-XXL)', 'parent' => 5],
        ['name' => 'Mützen / Schals / Handschuhe', 'parent' => 5],
        ['name' => 'Schlafanzüge / Pyjamas (klein)', 'parent' => 5],
        ['name' => 'Regenponchos / Regenkleidung', 'parent' => 5],
        ['name' => 'Socken (neu)', 'parent' => 5],
        ['name' => 'Sportschuhe (<44)', 'parent' => 5],
        ['name' => 'Schuhe (>41)', 'parent' => 5],
        ['name' => 'Sweatshirts / Langarmshirts (S/M)', 'parent' => 5],
        ['name' => 'T-Shirts (S/M)', 'parent' => 5],
        ['name' => 'T-Shirts (XL-XXL)', 'parent' => 5],
        ['name' => 'Unterhemden', 'parent' => 5],
        ['name' => 'Unterwäsche S/M/L (neu)', 'parent' => 5],
        ['name' => 'Unterwäsche XXL (neu)', 'parent' => 5],
        ['name' => 'Winterjacken (kl. Größen)', 'parent' => 5],
        ['name' => 'Winter- & Herbstschuhe (<44)', 'parent' => 5],

        // Frauen-Bekleidung
        ['name' => 'Badelatschen/FlipFlops', 'parent' => 6],
        ['name' => '(Baum)wollkleider (dunkel/schwarz)', 'parent' => 6],
        ['name' => 'Gürtel', 'parent' => 6],
        ['name' => 'Hosen & Jeans', 'parent' => 6],
        ['name' => 'Jogginghosen', 'parent' => 6],
        ['name' => 'Kopftücher', 'parent' => 6],
        ['name' => 'Leggins (XS/S/M) wenig L', 'parent' => 6],
        ['name' => 'Muslimische Kleidung', 'parent' => 6],
        ['name' => 'Mützen, Schals, Handschuhe', 'parent' => 6],
        ['name' => 'Regenponchos / Regenkleidung', 'parent' => 6],
        ['name' => 'Schlafanzüge/Pyjamas (klein)', 'parent' => 6],
        ['name' => 'Schuhe / Winterschuhe', 'parent' => 6],
        ['name' => 'Socken (neu)', 'parent' => 6],
        ['name' => 'Still-BHs', 'parent' => 6],
        ['name' => 'Strumpfhosen', 'parent' => 6],
        ['name' => 'Umstandsmode (Oberteile)', 'parent' => 6],
        ['name' => 'Umstandsmode (Unterteile)', 'parent' => 6],
        ['name' => 'Unterwäsche L (neu)', 'parent' => 6],
        ['name' => 'Unterwäsche S/M (neu)', 'parent' => 6],
        ['name' => 'Winterjacken/Mäntel', 'parent' => 6],

        // Allgemein
        ['name' => 'Akkuschrauber', 'parent' => 7],
        ['name' => 'Bettlaken', 'parent' => 7],
        ['name' => 'Bettvorleger (kleine Teppiche', 'parent' => 7],
        ['name' => 'Bettwäsche', 'parent' => 7],
        ['name' => 'Bänder und Schnüre', 'parent' => 7],
        ['name' => 'BVG Tickets AB', 'parent' => 7],
        ['name' => 'BVG Pläne', 'parent' => 7],
        ['name' => 'Decken (Wolldecken, Fleecedecken)', 'parent' => 7],
        ['name' => 'Dübel', 'parent' => 7],
        ['name' => 'Eddings', 'parent' => 7],
        ['name' => 'Gebetsteppich', 'parent' => 7],
        ['name' => 'Geldspenden', 'parent' => 7],
        ['name' => 'Geldspenden für Taxis/Taxigutscheine', 'parent' => 7],
        ['name' => 'große Bauplanen mit Ösen', 'parent' => 7],
        ['name' => 'Gutscheine (Bekleidung)', 'parent' => 7],
        ['name' => 'Gutscheine (Rossmann/DM)', 'parent' => 7],
        ['name' => 'Gutscheine (Lebensmittel)', 'parent' => 7],
        ['name' => 'Haarfön', 'parent' => 7],
        ['name' => 'Isomatten', 'parent' => 7],
        ['name' => 'Kabelbinder', 'parent' => 7],
        ['name' => 'Kissen', 'parent' => 7],
        ['name' => 'Matratzen', 'parent' => 7],
        ['name' => 'Pavillons', 'parent' => 7],
        ['name' => 'Pappbecher', 'parent' => 7],
        ['name' => 'Plastikteller', 'parent' => 7],
        ['name' => 'Plastikbecher', 'parent' => 7],
        ['name' => 'Plastikbesteck', 'parent' => 7],
        ['name' => 'Regenschirme', 'parent' => 7],
        ['name' => 'Rettungsdecken', 'parent' => 7],
        ['name' => 'Rucksäcke', 'parent' => 7],
        ['name' => 'Schlafsäcke', 'parent' => 7],
        ['name' => 'Scheren', 'parent' => 7],
        ['name' => 'Schrauben', 'parent' => 7],
        ['name' => 'Schüsseln', 'parent' => 7],
        ['name' => 'Servietten', 'parent' => 7],
        ['name' => 'SIM-Karten Lebara/Lyca', 'parent' => 7],
        ['name' => 'Smartphones / Handys', 'parent' => 7],
        ['name' => 'Tapetenkleister', 'parent' => 7],
        ['name' => 'Teppiche', 'parent' => 7],
        ['name' => 'Tesafilm', 'parent' => 7],
        ['name' => 'Töpfe & Pfannen', 'parent' => 7],
        ['name' => 'Trennbänder', 'parent' => 7],
        ['name' => 'Wäscheständer', 'parent' => 7],
        ['name' => 'Wäschetrockner', 'parent' => 7],
        ['name' => 'Wasserkocher', 'parent' => 7],
        ['name' => 'Werkzeug', 'parent' => 7],
        ['name' => 'Wörterbücher Dari-Deutsch', 'parent' => 7],
        ['name' => 'Wörterbücher Farsi-Deutsch', 'parent' => 7],
        ['name' => 'Wörterbücher Urdu-Deutsch', 'parent' => 7],
        ['name' => 'Wörterbuch (Bilder / Point-It', 'parent' => 7],

        // Kosmetikartikel / Waschen (Erwachsene)
        ['name' => 'Aftershave', 'parent' => 8],
        ['name' => 'Allzwecktücher (feucht)', 'parent' => 8],
        ['name' => 'Binden', 'parent' => 8],
        ['name' => 'Bodylotion oder andere Cremes', 'parent' => 8],
        ['name' => 'Brustwarzencreme', 'parent' => 8],
        ['name' => 'Conditioner', 'parent' => 8],
        ['name' => 'Cool Packs (aktivierbar)', 'parent' => 8],
        ['name' => 'Deo (Roller)', 'parent' => 8],
        ['name' => 'Deo (Spray)', 'parent' => 8],
        ['name' => 'Desinfektionsmittel', 'parent' => 8],
        ['name' => 'Duschgel (Reisegröße)', 'parent' => 8],
        ['name' => 'Duschgel (Männer)', 'parent' => 8],
        ['name' => 'Duschgel (Frauen)', 'parent' => 8],
        ['name' => 'Enthaarungscreme', 'parent' => 8],
        ['name' => 'Frühstücksbeutel', 'parent' => 8],
        ['name' => 'Gel-Schuheinlagen', 'parent' => 8],
        ['name' => 'Gesichtscreme', 'parent' => 8],
        ['name' => 'Gesichtscreme NIVEA (Männer)', 'parent' => 8],
        ['name' => 'Haarbürsten / Kämme', 'parent' => 8],
        ['name' => 'Haargel', 'parent' => 8],
        ['name' => 'Haarlack', 'parent' => 8],
        ['name' => 'Haarscheren', 'parent' => 8],
        ['name' => 'Haarshampoo (Männer)', 'parent' => 8],
        ['name' => 'Haarshampoo (Frauen)', 'parent' => 8],
        ['name' => 'Haarshampoo (Reisegröße)', 'parent' => 8],
        ['name' => 'Haarspangen', 'parent' => 8],
        ['name' => 'Haarspülung (Frauen)', 'parent' => 8],
        ['name' => 'Handcreme', 'parent' => 8],
        ['name' => 'Handdesinfektionsmittel', 'parent' => 8],
        ['name' => 'Hand-/Putzhandschuhe (Latexfrei)', 'parent' => 8],
        ['name' => 'Handspiegel', 'parent' => 8],
        ['name' => 'Handtücher', 'parent' => 8],
        ['name' => 'Hautcreme (Gesicht)', 'parent' => 8],
        ['name' => 'Hygienebeutel', 'parent' => 8],
        ['name' => 'Klopapier', 'parent' => 8],
        ['name' => 'Kondome', 'parent' => 8],
        ['name' => 'Küchenpapier', 'parent' => 8],
        ['name' => 'Kulturbeutel', 'parent' => 8],
        ['name' => 'Lippenpflege (Labello)', 'parent' => 8],
        ['name' => 'MakeUp / Kosmetik', 'parent' => 8],
        ['name' => 'MakeUp Entferner', 'parent' => 8],
        ['name' => 'Mundspülung', 'parent' => 8],
        ['name' => 'Nagelknipser, Nagelpfeilen', 'parent' => 8],
        ['name' => 'Nagellack', 'parent' => 8],
        ['name' => 'Nagellackentferner', 'parent' => 8],
        ['name' => 'Nagelscheren', 'parent' => 8],
        ['name' => 'Nähzeug', 'parent' => 8],
        ['name' => 'Papiertücher', 'parent' => 8],
        ['name' => 'Parfüm', 'parent' => 8],
        ['name' => 'Pflaster', 'parent' => 8],
        ['name' => 'Pinzetten', 'parent' => 8],
        ['name' => 'Putzlappen / Schwämme', 'parent' => 8],
        ['name' => 'Q-Tips', 'parent' => 8],
        ['name' => 'Rasierer (nass) auch Einwegrasierer', 'parent' => 8],
        ['name' => 'Rasierer (elektro)', 'parent' => 8],
        ['name' => 'Rasierschaum (Männer)', 'parent' => 8],
        ['name' => 'Rasierschaum (Frauen)', 'parent' => 8],
        ['name' => 'Rasierschaum (Reisegröße)', 'parent' => 8],
        ['name' => 'Rasiergel', 'parent' => 8],
        ['name' => 'Reinigungstücher (Gesicht)', 'parent' => 8],
        ['name' => 'Reisewaschmittel/Rei (klein)', 'parent' => 8],
        ['name' => 'Sackkarre', 'parent' => 8],
        ['name' => 'Schwangerschafttests', 'parent' => 8],
        ['name' => 'Seife (fest/flüssig)', 'parent' => 8],
        ['name' => 'Tampons', 'parent' => 8],
        ['name' => 'Taschentücher', 'parent' => 8],
        ['name' => 'Wärmeflaschen', 'parent' => 8],
        ['name' => 'Wäschetrolleys', 'parent' => 8],
        ['name' => 'Waschlappen', 'parent' => 8],
        ['name' => 'Wattepads', 'parent' => 8],
        ['name' => 'Waschpulver', 'parent' => 8],
        ['name' => 'Zahnbürsten', 'parent' => 8],
        ['name' => 'Zahnpasta', 'parent' => 8],

        // Büro / Unterricht
        ['name' => 'Batterien', 'parent' => 9],
        ['name' => 'Boxen zum Verschließen (klein)', 'parent' => 9],
        ['name' => 'Gummibänder', 'parent' => 9],
        ['name' => 'Gürteltaschen', 'parent' => 9],
        ['name' => 'Handwagen (\"Hackenporsche\")', 'parent' => 9],
        ['name' => 'Folienstifte', 'parent' => 9],
        ['name' => 'Kartons (klein)', 'parent' => 9],
        ['name' => 'Koffer (u.a. Rollkoffer)', 'parent' => 9],
        ['name' => 'Kreppband / Malerkreppband', 'parent' => 9],
        ['name' => 'Kugelschreiber', 'parent' => 9],
        ['name' => 'Kühlschrank (klein)', 'parent' => 9],
        ['name' => 'Karteikarten (A4, A5, A6)', 'parent' => 9],
        ['name' => 'Müllsackständer stabil (für 120L)', 'parent' => 9],
        ['name' => 'Mülltüten (80L)', 'parent' => 9],
        ['name' => 'Müllsäcke (120L stabil)', 'parent' => 9],
        ['name' => 'Müllgreifer / Greifzange', 'parent' => 9],
        ['name' => 'Lieferscheintaschen', 'parent' => 9],
        ['name' => 'Paketklebeband', 'parent' => 9],
        ['name' => 'Regale groß', 'parent' => 9],
        ['name' => 'Regale klein', 'parent' => 9],
        ['name' => 'Ringbuchblöcke', 'parent' => 9],
        ['name' => 'Rollschränke', 'parent' => 9],
        ['name' => 'Schulhefte', 'parent' => 9],
        ['name' => 'stabile Kleiderständer', 'parent' => 9],
        ['name' => 'Stifte', 'parent' => 9],
        ['name' => 'Taschen / Tragetaschen / Reisetaschen', 'parent' => 9],
        ['name' => 'Umzugskartons', 'parent' => 9],
        ['name' => 'Waschmaschine', 'parent' => 9],

        // Helfer
        ['name' => 'Internisten', 'parent' => 10],
        ['name' => 'Kinderärzte', 'parent' => 10],
        ['name' => 'Sprachmittler (Farsi, arab., urdu, kurdisch...)', 'parent' => 10],
        ['name' => 'Spendenverteiler', 'parent' => 10],
        ['name' => 'Essensausgabe', 'parent' => 10],
        ['name' => 'Sonstige Helfer', 'parent' => 10],
        ['name' => 'Kinderbetreuung', 'parent' => 10],

        // Medizinischer Bedarf / Krankenstation
        ['name' => 'Augentropfen', 'parent' => 11],
        ['name' => 'Blindenstock', 'parent' => 11],
        ['name' => 'Blutdruckmanschetten', 'parent' => 11],
        ['name' => 'Brillen', 'parent' => 11],
        ['name' => 'Desinfektionsmittel (Sakrotan)', 'parent' => 11],
        ['name' => 'Einmalauflagen / Arztauflagen für Liegen', 'parent' => 11],
        ['name' => 'elastische Binden', 'parent' => 11],
        ['name' => 'Hustensaft', 'parent' => 11],
        ['name' => 'Ibu / Aspirin / ACC', 'parent' => 11],
        ['name' => 'Kompressen', 'parent' => 11],
        ['name' => 'Krücken / Gehstöcke', 'parent' => 11],
        ['name' => 'Lappen für Ohrenuntersuchung', 'parent' => 11],
        ['name' => 'Lutschtabletten', 'parent' => 11],
        ['name' => 'Nasenspray', 'parent' => 11],
        ['name' => 'Ohrthermometer', 'parent' => 11],
        ['name' => 'Paracetamol', 'parent' => 11],
        ['name' => 'Pulotin zum Einreiben', 'parent' => 11],
        ['name' => 'Rollstühle', 'parent' => 11],
        ['name' => 'Stulpa (Verband)', 'parent' => 11],
        ['name' => 'Thrombosestrümpfe', 'parent' => 11],
        ['name' => 'Zäpfchen (für Babys)', 'parent' => 11],

        // Spielzeug / Sport / Freizeit
        ['name' => 'Autos / Schiffe / Flugzeuge', 'parent' => 12],
        ['name' => 'Armbanduhren', 'parent' => 12],
        ['name' => 'Ballpumpe', 'parent' => 12],
        ['name' => 'Bälle', 'parent' => 12],
        ['name' => 'Basketball', 'parent' => 12],
        ['name' => 'Bobycars', 'parent' => 12],
        ['name' => 'Bügelperlen', 'parent' => 12],
        ['name' => 'Buntstifte', 'parent' => 12],
        ['name' => 'DVD Player', 'parent' => 12],
        ['name' => 'DVDs', 'parent' => 12],
        ['name' => 'Dreiräder', 'parent' => 12],
        ['name' => 'Fahrräder', 'parent' => 12],
        ['name' => 'Fahrradbedarf (alles)', 'parent' => 12],
        ['name' => 'Fahrradschlösser', 'parent' => 12],
        ['name' => 'Federball', 'parent' => 12],
        ['name' => 'Frisbees', 'parent' => 12],
        ['name' => 'Fernseher', 'parent' => 12],
        ['name' => 'Gesellschaftsspiele für Erwachsene', 'parent' => 12],
        ['name' => 'Gitarre', 'parent' => 12],
        ['name' => 'Inline-Skates', 'parent' => 12],
        ['name' => 'Kartenspiele', 'parent' => 12],
        ['name' => 'Kopfhörer', 'parent' => 12],
        ['name' => 'Kreide (zum Malen)', 'parent' => 12],
        ['name' => 'Lego Duplo (große Steine)', 'parent' => 12],
        ['name' => 'Loombands / Loombänder', 'parent' => 12],
        ['name' => 'Seifenblasen', 'parent' => 12],
    ];

    public function insert_empty_stocklist_entries($stock_list_id)
    {
        $stock_list_id = (int) $stock_list_id;
        $date = date('Y-m-d H:i:s');

        $rows = [];
        foreach ($this->template as $row) {
            $rows[] = "($stock_list_id, {$row['parent']}, '0', '{$row['name']}', '$date')";
        }

        $sql = '
          INSERT INTO stock_list_entry
            (`StockList`, `Category`, `demand`, `name`, `created_at`)
          VALUES ' . implode(', ', $rows) . ';';

        $this->db->query($sql);

        return $this->db->insert_id();
    }
}