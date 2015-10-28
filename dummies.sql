#
# USERS (password always "test")
#
DELETE FROM users;
ALTER TABLE users AUTO_INCREMENT = 1;
INSERT INTO users (`username`, `email`, `password`, `created_at`, `is_admin`, `is_confirmed`, `is_deleted`, `confirmation_key`) VALUES
  #("username", "email", "password", "created_at", "is_admin", "is_confirmed", "is_deleted", "confirmation_key"),
  ("admin", "admin@localhost", "$2y$10$jPrKWhqYI7IJv3o0WFJ1P.PMEs0QUHxkAdmwkvQ3ok9ZD16WPm1Eu", "2015-10-25 23:01:47", 1, 1, 0, "confirmation_key"),
  ("admin_111", "admin111@localhost", "$2y$10$jPrKWhqYI7IJv3o0WFJ1P.PMEs0QUHxkAdmwkvQ3ok9ZD16WPm1Eu", "2015-10-25 23:01:47", 1, 1, 1, "confirmation_key"),
  ("user1", "user1@localhost", "$2y$10$jPrKWhqYI7IJv3o0WFJ1P.PMEs0QUHxkAdmwkvQ3ok9ZD16WPm1Eu", "2015-10-25 23:01:47", 0, 1, 0, "confirmation_key"),
  ("user2", "user2@localhost", "$2y$10$jPrKWhqYI7IJv3o0WFJ1P.PMEs0QUHxkAdmwkvQ3ok9ZD16WPm1Eu", "2015-10-25 23:01:47", 0, 1, 0, "confirmation_key"),
  ("user_011", "user011@localhost", "$2y$10$jPrKWhqYI7IJv3o0WFJ1P.PMEs0QUHxkAdmwkvQ3ok9ZD16WPm1Eu", "2015-10-25 23:01:47", 0, 1, 1, "confirmation_key"),
  ("user_001", "user001@localhost", "$2y$10$jPrKWhqYI7IJv3o0WFJ1P.PMEs0QUHxkAdmwkvQ3ok9ZD16WPm1Eu", "2015-10-25 23:01:47", 0, 0, 1, "confirmation_key")
;

#
# FACILITIES
#
DELETE FROM facility;
ALTER TABLE facility AUTO_INCREMENT = 1;
INSERT INTO facility (`User`, `name`, `association`, `organisation`, `homepage`, `email`, `phone`, `opening_hours`, `person_in_charge`, `type`, `created_at`, `address`, `zip`, `city`) VALUES
  #("User", "name", "association", "organisation", "homepage", "email", "phone", "opening_hours", "person_in_charge", "type", "created_at", "address", "zip", "city"),
  (1, "name", "association", "organisation", "homepage", "email", "phone", "opening_hours", "person_in_charge", "type", "2015-10-25 23:01:47", "address", "zip", "city"),
  (2, "name", "association", "organisation", "homepage", "email", "phone", "opening_hours", "person_in_charge", "type", "2015-10-25 23:01:47", "address", "zip", "city"),
  (3, "Die Wohnanlage am Ostpreußendamm 108", null, "Evangelischer Diakonieverein Berlin-Zehlendorf e.V.", "http://www.diakonieverein.de/diakonieverein/unterstuetzen-und-helfen/spenden/spendenprojekte/fluechtlingsbetreuung.html", "info@diakonieverein.de", "Tel: (030) 80 99 70-0", "Mo-Fr- 8-17", NULL, "WH", "2015-10-25 23:01:47", "Glockenstraße 8", "14163", "Berlin"),
  (4, "Notunterkunft für Flüchtlinge", "Willkommen in Marzan", "Christliches Jugenddorf Deutschlands e.V.:", "http://www.diakonie-portal.de/arbeitsbereiche/existenzsicherung-integration/spenden-fuer-fluechtlinge/fluechtlingsunterkunft-mitte", "info.glambeckerring@cjd-berlin.de", "T: 0176 817 875 21", NULL, NULL, "NUK", "2015-10-25 23:01:47", "??", "12679", "Berlin-Marzahn"),
  (5, "name", "association", "organisation", "homepage", "email", "phone", "opening_hours", "person_in_charge", "type", "2015-10-25 23:01:47", "address", "zip", "city"),
  (6, "name", "association", "organisation", "homepage", "email", "phone", "opening_hours", "person_in_charge", "type", "2015-10-25 23:01:47", "address", "zip", "city")
;

#
# STOCK LIST
#
DELETE FROM stock_list;
ALTER TABLE stock_list AUTO_INCREMENT = 1;
INSERT INTO stock_list (`Facility`, `created_at`) VALUES
  #("Facility", "created_at"),
  (1, "2015-10-25 23:01:47"),
  (2, "2015-10-25 23:01:47"),
  (3, "2015-10-25 23:01:47"),
  (4, "2015-10-25 23:01:47"),
  (5, "2015-10-25 23:01:47"),
  (6, "2015-10-25 23:01:47")
;

#
# CATEGORY
#
DELETE FROM category;
ALTER TABLE category AUTO_INCREMENT = 1;
INSERT INTO category (`name`, `Parent`) VALUES
  #("name", "Parent"),
  ("Nahrungsmittel", NULL),
  ("Baby/Kinder Allgemeinbedarf", NULL),
  ("Kosmetikartikel / Waschen", NULL),
  ("Spielzeug / Sport / Freizeit", NULL)
;

#
# STOCK LIST ENTRY
#
DELETE FROM stock_list_entry;
ALTER TABLE stock_list_entry AUTO_INCREMENT = 1;
INSERT INTO stock_list_entry (`StockList`, `Category`, `name`, `created_at`) VALUES
  #("StockList", "Category", "name", "created_at"),
  (3, 1, "Gurken", "2015-10-25 23:01:47"),
  (3, 1, "Kekse", "2015-10-25 23:01:47"),
  (3, 2, "Strumpfhosen", "2015-10-25 23:01:47"),
  (3, 2, "Babycreme", "2015-10-25 23:01:47"),
  (3, 3, "Aftershave", "2015-10-25 23:01:47"),
  (3, 3, "Allzwecktücher", "2015-10-25 23:01:47"),
  (3, 4, "Armbanduhren", "2015-10-25 23:01:47"),
  (3, 4, "Bälle", "2015-10-25 23:01:47"),

  (4, 1, "Gurken", "2015-10-25 23:01:47"),
  (4, 1, "Kekse", "2015-10-25 23:01:47"),
  (4, 2, "Strumpfhosen", "2015-10-25 23:01:47"),
  (4, 2, "Babycreme", "2015-10-25 23:01:47"),
  (4, 3, "Aftershave", "2015-10-25 23:01:47"),
  (4, 3, "Allzwecktücher", "2015-10-25 23:01:47"),
  (4, 4, "Armbanduhren", "2015-10-25 23:01:47"),
  (4, 4, "Bälle", "2015-10-25 23:01:47")
;