DELETE FROM category;
ALTER TABLE category AUTO_INCREMENT = 1;
INSERT INTO category (`name`, `Parent`) VALUES
  ("Nahrungsmittel", NULL),
  ("Baby / Kinder Allgemeinbedarf", NULL),
  ("Kosmetikartikel / Waschen", NULL),
  ("Teenies / Jugendliche Bekleidung",	NULL),
  ("Männer-Bekleidung",	NULL),
  ("Frauen-Bekleidung",	NULL),
  ("Allgemein",	NULL),
  ("Kosmetikartikel / Waschen (Erwachsene)",	NULL),
  ("Büro / Unterricht",	NULL),
  ("Helfer",	NULL),
  ("Medizinischer Bedarf / Krankenstation",	NULL),
  ("Spielzeug / Sport / Freizeit",	NULL)
;