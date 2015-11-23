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
     * Returns entries grouped by category
     * and sorted by top
     *
     * @return array
     */
    public function get_top_demand($limit = 20)
    {
        $query = $this->db->query('
            SELECT
              sle.name AS entry,
              c.name AS category,
              SUM(sle.demand) AS demand
            FROM stock_list_entry sle
              INNER JOIN category c ON sle.Category = c.category_id
            WHERE
              demand = 1
            GROUP BY sle.name
            ORDER BY demand DESC
            LIMIT '.intval($limit).'
        ');

        // group by category
        $group = [];
        foreach ($query->result_array() as $row) {
            $group[$row['category']]['category'] = $row['category'];
            $group[$row['category']]['entries'][] = $row;
        }

        // sort by cumulated category demand
        usort($group, function($a, $b) {
            $a = array_sum(array_column($a['entries'], 'demand'));
            $b = array_sum(array_column($b['entries'], 'demand'));

            if ($a === $b) return 0;
            return $a < $b ? 1 : -1;
        });

        return $group;
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
        ['name' => 'Baby Anfangsmilch/Milchpulver', 'parent' => 1],
        ['name' => 'Babynahrung', 'parent' => 1],
        ['name' => 'Kindersäfte', 'parent' => 1],
        ['name' => 'Badelatschen / FlipFlops', 'parent' => 1],
        ['name' => 'Bodies', 'parent' => 1],
        ['name' => 'Handschuhe', 'parent' => 1],
        ['name' => 'Hosen', 'parent' => 1],
        ['name' => 'Pullover', 'parent' => 1],
        ['name' => 'Regenkleidung', 'parent' => 1],
        ['name' => 'Schlafanzüge', 'parent' => 1],
        ['name' => 'Schuhe', 'parent' => 1],
        ['name' => 'Socken', 'parent' => 1],
        ['name' => 'Strumpfhosen', 'parent' => 1],
        ['name' => 'Unterwäsche (neu)', 'parent' => 1],
        ['name' => 'Winterjacken', 'parent' => 1],
        ['name' => 'Babycreme', 'parent' => 1],
        ['name' => 'Babylotion', 'parent' => 1],
        ['name' => 'Babyöl', 'parent' => 1],
        ['name' => 'Babypuder', 'parent' => 1],
        ['name' => 'Duschgel Babys/Kinder', 'parent' => 1],
        ['name' => 'Feuchttücher', 'parent' => 1],
        ['name' => 'Shampoo Babys/Kinder', 'parent' => 1],
        ['name' => 'Sterilisator für Babyflaschen', 'parent' => 1],
        ['name' => 'Windeln 1-2', 'parent' => 1],
        ['name' => 'Windeln 3', 'parent' => 1],
        ['name' => 'Windeln 4-5', 'parent' => 1],
        ['name' => 'Wundschutzcreme', 'parent' => 1],
        ['name' => 'Zahnbürsten', 'parent' => 1],
        ['name' => 'Zahnpasta', 'parent' => 1],
        ['name' => 'Babybadewannen', 'parent' => 1],
        ['name' => 'Babybetten', 'parent' => 1],
        ['name' => 'Babyflaschen', 'parent' => 1],
        ['name' => 'Babyhaarbürsten', 'parent' => 1],
        ['name' => 'Babyreisebetten', 'parent' => 1],
        ['name' => 'Babyschlafsäcke', 'parent' => 1],
        ['name' => 'Babytragen/Bauchtragen', 'parent' => 1],
        ['name' => 'Buggy', 'parent' => 1],
        ['name' => 'Fußsack für Kinderwagen', 'parent' => 1],
        ['name' => 'Kinderwagen', 'parent' => 1],
        ['name' => 'MaxiCosi', 'parent' => 1],
        ['name' => 'Regenverdeck für Kinderwagen', 'parent' => 1],
        ['name' => 'Strumpfhosen', 'parent' => 1],
        ['name' => 'Tragetuch (für Babys)', 'parent' => 1],
        ['name' => 'Wickelauflagen', 'parent' => 1],
        ['name' => 'Badelatschen/FlipFlops', 'parent' => 2],
        ['name' => 'Jeans (146-176)', 'parent' => 2],
        ['name' => 'Jeans (80-134)', 'parent' => 2],
        ['name' => 'Jogging-/Baumwollhosen (146-176)', 'parent' => 2],
        ['name' => 'Jogging-/Baumwollhosen (80-134)', 'parent' => 2],
        ['name' => 'Kapuzenpullover (146-176)', 'parent' => 2],
        ['name' => 'Kapuzenpullover (80-134)', 'parent' => 2],
        ['name' => 'Langarmshirts/Sweatshirts (146-176)', 'parent' => 2],
        ['name' => 'Langarmshirts/Sweatshirts (80-134)', 'parent' => 2],
        ['name' => 'Leggins (146-176)', 'parent' => 2],
        ['name' => 'Leggins (80-134)', 'parent' => 2],
        ['name' => 'Mützen,Schals, Handschuhe', 'parent' => 2],
        ['name' => 'Pullover (146-176)', 'parent' => 2],
        ['name' => 'Pullover (80-134)', 'parent' => 2],
        ['name' => 'Regenponchos/Regenkleidung', 'parent' => 2],
        ['name' => 'Schlafanzüge (146-176)', 'parent' => 2],
        ['name' => 'Schlafanzüge (80-134)', 'parent' => 2],
        ['name' => 'Schuhe Sommer', 'parent' => 2],
        ['name' => 'Schuhe Winter', 'parent' => 2],
        ['name' => 'Socken neu', 'parent' => 2],
        ['name' => 'Strumpfhosen', 'parent' => 2],
        ['name' => 'T-Shirts (146-176)', 'parent' => 2],
        ['name' => 'T-Shirts (80-134)', 'parent' => 2],
        ['name' => 'Unterwäsche neu (146-176)', 'parent' => 2],
        ['name' => 'Unterwäsche neu (80-134)', 'parent' => 2],
        ['name' => 'Badelatschen/FlipFlops (<44)', 'parent' => 3],
        ['name' => 'Fleecejacken/Pullover (L/XL)', 'parent' => 3],
        ['name' => 'Fleecejacken/Pullover (S/M)', 'parent' => 3],
        ['name' => 'Gürtel', 'parent' => 3],
        ['name' => 'Hosen & Jeans (L/XL)', 'parent' => 3],
        ['name' => 'Hosen & Jeans (S/M)', 'parent' => 3],
        ['name' => 'Jacken (L/XL)', 'parent' => 3],
        ['name' => 'Jacken (S/M)', 'parent' => 3],
        ['name' => 'Jogging-/Baumwollhosen (L/XL)', 'parent' => 3],
        ['name' => 'Jogging-/Baumwollhosen (S/M)', 'parent' => 3],
        ['name' => 'Kapuzenpullover (L/XL)', 'parent' => 3],
        ['name' => 'Kapuzenpullover (S/M)', 'parent' => 3],
        ['name' => 'Langarmshirts/Sweatshirts (L/XL)', 'parent' => 3],
        ['name' => 'Langarmshirts/Sweatshirts (S/M)', 'parent' => 3],
        ['name' => 'Mützen,Schals, Handschuhe', 'parent' => 3],
        ['name' => 'Regenponchos/Regenkleidung', 'parent' => 3],
        ['name' => 'Schlafanzüge/Pyjamas (L/XL)', 'parent' => 3],
        ['name' => 'Schlafanzüge/Pyjamas (S/M)', 'parent' => 3],
        ['name' => 'Schuhe Sommer (<44)', 'parent' => 3],
        ['name' => 'Schuhe Sport (<44)', 'parent' => 3],
        ['name' => 'Schuhe Winter/Herbst (<44)', 'parent' => 3],
        ['name' => 'Socken (<44)', 'parent' => 3],
        ['name' => 'T-Shirts (L/XL)', 'parent' => 3],
        ['name' => 'T-Shirts (S/M)', 'parent' => 3],
        ['name' => 'Unterhemden (L/XL)', 'parent' => 3],
        ['name' => 'Unterhemden (S/M)', 'parent' => 3],
        ['name' => 'Unterwäsche L/XL (neu)', 'parent' => 3],
        ['name' => 'Unterwäsche S/M (neu)', 'parent' => 3],
        ['name' => 'Winterjacken (L/XL)', 'parent' => 3],
        ['name' => 'Winterjacken (S/M)', 'parent' => 3],
        ['name' => 'Badelatschen/FlipFlops', 'parent' => 4],
        ['name' => 'Gewänder', 'parent' => 4],
        ['name' => 'Gürtel', 'parent' => 4],
        ['name' => 'Hosen & Jeans (M/L)', 'parent' => 4],
        ['name' => 'Hosen & Jeans (XS/S)', 'parent' => 4],
        ['name' => 'Jogginghosen (M/L)', 'parent' => 4],
        ['name' => 'Jogginghosen (XS/S)', 'parent' => 4],
        ['name' => 'Kleider (Baum)Wolle (M/L)', 'parent' => 4],
        ['name' => 'Kleider (Baum)Wolle (XS/S)', 'parent' => 4],
        ['name' => 'Kopftücher', 'parent' => 4],
        ['name' => 'Langarmshirts/Sweatshirts (M/L)', 'parent' => 4],
        ['name' => 'Langarmshirts/Sweatshirts (XS/S)', 'parent' => 4],
        ['name' => 'Leggins (M/L)', 'parent' => 4],
        ['name' => 'Leggins (XS/S)', 'parent' => 4],
        ['name' => 'Mützen, Schals, Handschuhe', 'parent' => 4],
        ['name' => 'Pullover (M/L)', 'parent' => 4],
        ['name' => 'Pullover (XS/S)', 'parent' => 4],
        ['name' => 'Regenponchos/Regenkleidung', 'parent' => 4],
        ['name' => 'Schlafanzüge/Pyjamas (M/L)', 'parent' => 4],
        ['name' => 'Schlafanzüge/Pyjamas (XS/S)', 'parent' => 4],
        ['name' => 'Schuhe Sommer', 'parent' => 4],
        ['name' => 'Schuhe Winter ', 'parent' => 4],
        ['name' => 'Socken (neu)', 'parent' => 4],
        ['name' => 'Still-BHs', 'parent' => 4],
        ['name' => 'Strickjacken (M/L)', 'parent' => 4],
        ['name' => 'Strickjacken (XS/S)', 'parent' => 4],
        ['name' => 'Strumpfhosen (M/L)', 'parent' => 4],
        ['name' => 'Strumpfhosen (XS/S)', 'parent' => 4],
        ['name' => 'Umstandsmode (Oberteile)', 'parent' => 4],
        ['name' => 'Umstandsmode (Unterteile)', 'parent' => 4],
        ['name' => 'Unterwäsche (M/L) neu', 'parent' => 4],
        ['name' => 'Unterwäsche (XS/S) neu', 'parent' => 4],
        ['name' => 'Winterjacken/Mäntel (M/L)', 'parent' => 4],
        ['name' => 'Winterjacken/Mäntel (XS/S)', 'parent' => 4],
        ['name' => 'Aftershave', 'parent' => 5],
        ['name' => 'Binden', 'parent' => 5],
        ['name' => 'Bodylotion', 'parent' => 5],
        ['name' => 'Deo (Roller)', 'parent' => 5],
        ['name' => 'Deo (Spray)', 'parent' => 5],
        ['name' => 'Desinfektionsmittel', 'parent' => 5],
        ['name' => 'Duschgel (Frauen)', 'parent' => 5],
        ['name' => 'Duschgel (Männer)', 'parent' => 5],
        ['name' => 'Enthaarungscreme', 'parent' => 5],
        ['name' => 'Gesichtscreme (Frauen)', 'parent' => 5],
        ['name' => 'Gesichtscreme (Männer)', 'parent' => 5],
        ['name' => 'Gesichtsreinigungstücher', 'parent' => 5],
        ['name' => 'Haarbürsten/Kämme', 'parent' => 5],
        ['name' => 'Haargel', 'parent' => 5],
        ['name' => 'Haarlack', 'parent' => 5],
        ['name' => 'Haarscheren', 'parent' => 5],
        ['name' => 'Haarshampoo (Frauen)', 'parent' => 5],
        ['name' => 'Haarshampoo (Männer)', 'parent' => 5],
        ['name' => 'Haarspangen', 'parent' => 5],
        ['name' => 'Haarspülung (Frauen)', 'parent' => 5],
        ['name' => 'Haarspülung (Männer)', 'parent' => 5],
        ['name' => 'Handcreme', 'parent' => 5],
        ['name' => 'Handspiegel', 'parent' => 5],
        ['name' => 'Klopapier', 'parent' => 5],
        ['name' => 'Kondome', 'parent' => 5],
        ['name' => 'Kulturbeutel', 'parent' => 5],
        ['name' => 'Lippenpflege', 'parent' => 5],
        ['name' => 'MakeUp Entferner', 'parent' => 5],
        ['name' => 'MakeUp/Kosmetik', 'parent' => 5],
        ['name' => 'Mundspülung', 'parent' => 5],
        ['name' => 'Nagelknipser', 'parent' => 5],
        ['name' => 'Nagellack', 'parent' => 5],
        ['name' => 'Nagellackentferner', 'parent' => 5],
        ['name' => 'Nagelpfeilen', 'parent' => 5],
        ['name' => 'Nagelscheren', 'parent' => 5],
        ['name' => 'Parfüm', 'parent' => 5],
        ['name' => 'Pflaster', 'parent' => 5],
        ['name' => 'Pinzetten', 'parent' => 5],
        ['name' => 'Q-Tips / Wattestäbchen', 'parent' => 5],
        ['name' => 'Rasierer (nass)', 'parent' => 5],
        ['name' => 'Rasiergel', 'parent' => 5],
        ['name' => 'Rasierschaum (Frauen)', 'parent' => 5],
        ['name' => 'Rasierschaum (Männer)', 'parent' => 5],
        ['name' => 'Reinigungstücher (Gesicht)', 'parent' => 5],
        ['name' => 'Schwangerschafttests', 'parent' => 5],
        ['name' => 'Seife (fest/flüssig)', 'parent' => 5],
        ['name' => 'Stilleinlagen', 'parent' => 5],
        ['name' => 'Tampons', 'parent' => 5],
        ['name' => 'Taschentücher', 'parent' => 5],
        ['name' => 'Tücher (feucht)', 'parent' => 5],
        ['name' => 'Tücher (trocken)', 'parent' => 5],
        ['name' => 'Waschlappen', 'parent' => 5],
        ['name' => 'Wattepads', 'parent' => 5],
        ['name' => 'Zahnbürsten', 'parent' => 5],
        ['name' => 'Zahnpasta', 'parent' => 5],
        ['name' => 'Citronensäure', 'parent' => 6],
        ['name' => 'Entkalker', 'parent' => 6],
        ['name' => 'Fleckenspray', 'parent' => 6],
        ['name' => 'Flüssigwaschmittel', 'parent' => 6],
        ['name' => 'Frühstücksbeutel', 'parent' => 6],
        ['name' => 'Geschirrspülmittel', 'parent' => 6],
        ['name' => 'Glasreiniger', 'parent' => 6],
        ['name' => 'Gummibänder', 'parent' => 6],
        ['name' => 'Handdesinfektionsmittel', 'parent' => 6],
        ['name' => 'Handschuhe (Latexfrei)', 'parent' => 6],
        ['name' => 'Hygienebeutel', 'parent' => 6],
        ['name' => 'Hygienespüler', 'parent' => 6],
        ['name' => 'Küchenpapier', 'parent' => 6],
        ['name' => 'Müllgreifer / Greifzange', 'parent' => 6],
        ['name' => 'Müllsäcke (120L stabil)', 'parent' => 6],
        ['name' => 'Müllsackständer (120L stabil)', 'parent' => 6],
        ['name' => 'Mülltüten (<80L)', 'parent' => 6],
        ['name' => 'Mülltüten (>80L)', 'parent' => 6],
        ['name' => 'Papiertücher', 'parent' => 6],
        ['name' => 'Putzlappen/Schwämme', 'parent' => 6],
        ['name' => 'Scheuermilch', 'parent' => 6],
        ['name' => 'Waschpulver', 'parent' => 6],
        ['name' => 'WC-Reiniger', 'parent' => 6],
        ['name' => 'Akkuschrauber', 'parent' => 7],
        ['name' => 'Armbanduhren', 'parent' => 7],
        ['name' => 'DVD Player', 'parent' => 7],
        ['name' => 'Fernseher', 'parent' => 7],
        ['name' => 'Haarfön', 'parent' => 7],
        ['name' => 'Kopfhörer', 'parent' => 7],
        ['name' => 'Kühlschrank (klein)', 'parent' => 7],
        ['name' => 'Laptop', 'parent' => 7],
        ['name' => 'Mp3-Player', 'parent' => 7],
        ['name' => 'Rasierer (elektro)', 'parent' => 7],
        ['name' => 'Smartphones/Handys', 'parent' => 7],
        ['name' => 'Waschmaschine', 'parent' => 7],
        ['name' => 'Wasserkocher', 'parent' => 7],
        ['name' => 'Bettlaken', 'parent' => 8],
        ['name' => 'Bettvorleger', 'parent' => 8],
        ['name' => 'Bettwäsche', 'parent' => 8],
        ['name' => 'Decken (dick)', 'parent' => 8],
        ['name' => 'Decken (dünn)', 'parent' => 8],
        ['name' => 'Gebetsteppich', 'parent' => 8],
        ['name' => 'Gürteltaschen', 'parent' => 8],
        ['name' => 'Handtücher (groß)', 'parent' => 8],
        ['name' => 'Handtücher (klein)', 'parent' => 8],
        ['name' => 'Handwagen ("Hackenporsche")', 'parent' => 8],
        ['name' => 'Isomatten', 'parent' => 8],
        ['name' => 'Kissen', 'parent' => 8],
        ['name' => 'Kleiderständer', 'parent' => 8],
        ['name' => 'Koffer', 'parent' => 8],
        ['name' => 'Matratzen (<140 cm)', 'parent' => 8],
        ['name' => 'Matratzen (>140 cm)', 'parent' => 8],
        ['name' => 'Messer', 'parent' => 8],
        ['name' => 'Nähzeug', 'parent' => 8],
        ['name' => 'Pfannen', 'parent' => 8],
        ['name' => 'Plastik(Papp)becher', 'parent' => 8],
        ['name' => 'Plastikbesteck', 'parent' => 8],
        ['name' => 'Plastikteller', 'parent' => 8],
        ['name' => 'Regenschirme', 'parent' => 8],
        ['name' => 'Rettungsdecken', 'parent' => 8],
        ['name' => 'Rucksäcke', 'parent' => 8],
        ['name' => 'Scheren', 'parent' => 8],
        ['name' => 'Schlafsäcke', 'parent' => 8],
        ['name' => 'Schrauben, Dübel, Nägel', 'parent' => 8],
        ['name' => 'Schüsseln', 'parent' => 8],
        ['name' => 'Taschen', 'parent' => 8],
        ['name' => 'Teppiche', 'parent' => 8],
        ['name' => 'Töpfe', 'parent' => 8],
        ['name' => 'Wäscheklammern', 'parent' => 8],
        ['name' => 'Wäschekorb', 'parent' => 8],
        ['name' => 'Wäschesäcke', 'parent' => 8],
        ['name' => 'Wäscheständer', 'parent' => 8],
        ['name' => 'Werkzeug', 'parent' => 8],
        ['name' => 'Autos/Schiffe/Eisenbahn', 'parent' => 9],
        ['name' => 'Bälle', 'parent' => 9],
        ['name' => 'Bobycars', 'parent' => 9],
        ['name' => 'Buntstifte', 'parent' => 9],
        ['name' => 'Dreiräder', 'parent' => 9],
        ['name' => 'DVDs', 'parent' => 9],
        ['name' => 'Fahrradbedarf', 'parent' => 9],
        ['name' => 'Fahrräder', 'parent' => 9],
        ['name' => 'Fahrradschlösser', 'parent' => 9],
        ['name' => 'Frisbees', 'parent' => 9],
        ['name' => 'Gesellschaftsspiele für Erwachsene', 'parent' => 9],
        ['name' => 'Gitarre', 'parent' => 9],
        ['name' => 'Inline-Skates', 'parent' => 9],
        ['name' => 'Karten', 'parent' => 9],
        ['name' => 'Kinderbücher', 'parent' => 9],
        ['name' => 'Kreide', 'parent' => 9],
        ['name' => 'Lego ', 'parent' => 9],
        ['name' => 'Seifenblasen', 'parent' => 9],
        ['name' => 'Augentropfen', 'parent' => 10],
        ['name' => 'Blindenstock', 'parent' => 10],
        ['name' => 'Blutdruckmanschetten', 'parent' => 10],
        ['name' => 'Brillen', 'parent' => 10],
        ['name' => 'Desinfektionsmittel', 'parent' => 10],
        ['name' => 'Einmalauflagen/Arztauflagen für Liegen', 'parent' => 10],
        ['name' => 'elastische Binden', 'parent' => 10],
        ['name' => 'Hustensaft', 'parent' => 10],
        ['name' => 'Ibu / Aspirin / ACC', 'parent' => 10],
        ['name' => 'Kompressen', 'parent' => 10],
        ['name' => 'Krücken / Gehstöcke', 'parent' => 10],
        ['name' => 'Lappen für Ohrenuntersuchung', 'parent' => 10],
        ['name' => 'Lutschtabletten', 'parent' => 10],
        ['name' => 'Nasenspray', 'parent' => 10],
        ['name' => 'Ohrthermometer', 'parent' => 10],
        ['name' => 'Paracetamol', 'parent' => 10],
        ['name' => 'Pulotin zum Einreiben', 'parent' => 10],
        ['name' => 'Rollstühle', 'parent' => 10],
        ['name' => 'Stulpa (Verband)', 'parent' => 10],
        ['name' => 'Thrombosestrümpfe', 'parent' => 10],
        ['name' => 'Zäpfchen (für Babys)', 'parent' => 10],
        ['name' => 'Brot', 'parent' => 11],
        ['name' => 'Fisch', 'parent' => 11],
        ['name' => 'Fleisch', 'parent' => 11],
        ['name' => 'Frische Milch', 'parent' => 11],
        ['name' => 'Gemüse', 'parent' => 11],
        ['name' => 'Milchprodukte', 'parent' => 11],
        ['name' => 'Obst', 'parent' => 11],
        ['name' => 'Salat', 'parent' => 11],
        ['name' => 'Bonbons', 'parent' => 12],
        ['name' => 'Cornflakes', 'parent' => 12],
        ['name' => 'Cracker', 'parent' => 12],
        ['name' => 'Fertiggerichte/-suppen', 'parent' => 12],
        ['name' => 'Gewürze', 'parent' => 12],
        ['name' => 'Kaffee', 'parent' => 12],
        ['name' => 'Kakao', 'parent' => 12],
        ['name' => 'Kekse', 'parent' => 12],
        ['name' => 'Margarine', 'parent' => 12],
        ['name' => 'Mich (H-Milch)', 'parent' => 12],
        ['name' => 'Müsliriegel', 'parent' => 12],
        ['name' => 'Nussnugatcreme', 'parent' => 12],
        ['name' => 'Saft', 'parent' => 12],
        ['name' => 'Salz & Pfeffer', 'parent' => 12],
        ['name' => 'Schokolade', 'parent' => 12],
        ['name' => 'Stilles Wasser', 'parent' => 12],
        ['name' => 'Studentenfutter', 'parent' => 12],
        ['name' => 'Süßigkeiten', 'parent' => 12],
        ['name' => 'Tee', 'parent' => 12],
        ['name' => 'Verpackte Snacks', 'parent' => 12],
        ['name' => 'Zucker/Würfelzucker', 'parent' => 12],
        ['name' => 'Batterien', 'parent' => 13],
        ['name' => 'Eddings', 'parent' => 13],
        ['name' => 'Karteikarten', 'parent' => 13],
        ['name' => 'Kreppband', 'parent' => 13],
        ['name' => 'Kugelschreiber', 'parent' => 13],
        ['name' => 'Paketklebeband', 'parent' => 13],
        ['name' => 'Schulhefte', 'parent' => 13],
        ['name' => 'Tesafilm', 'parent' => 13],
        ['name' => 'Umzugskartons (groß)', 'parent' => 13],
        ['name' => 'Umzugskartons (klein)', 'parent' => 13],
        ['name' => 'Wörterbuch (Bilder/Point-It)', 'parent' => 13],
        ['name' => 'Wörterbücher Dari-Deutsch', 'parent' => 13],
        ['name' => 'Wörterbücher Farsi-Deutsch', 'parent' => 13],
        ['name' => 'Wörterbücher Urdu-Deutsch', 'parent' => 13],
        ['name' => 'BVG Tickets (AB)', 'parent' => 14],
        ['name' => 'Geldspenden', 'parent' => 14],
        ['name' => 'Gutscheine Bekleidung', 'parent' => 14],
        ['name' => 'Gutscheine Lebensmittel', 'parent' => 14],
        ['name' => 'Gutscheine Rossmann/DM', 'parent' => 14],
        ['name' => 'Gutscheine Taxi', 'parent' => 14],
        ['name' => 'SIM-Karten Lebara/Lyca', 'parent' => 14],
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