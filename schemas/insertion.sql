insert into Classe(denomination) values ('Standard'), ('Confort'), ('Luxe');

insert into Categorie(denomination) values ('Simple'), ('Double'), ('Double avec salle de bain');

insert into Prix_chambre(id_classe, id_categorie, prix) values
(1, 1, 39), (1, 2, 59), (1, 3, 69),
(2, 1, 59), (2, 2, 89), (2, 3, 99),
(3, 1, 69), (3, 2, 99), (3, 3, 109);

insert into Hotel(nom, id_classe, localisation) values
('Hotel de Caen', 1, '123 rue de Caen'),
('Hotel de Brest', 1, '123 rue de Brest'),
('Hotel de Paris', 2, '123 rue de Paris'),
('Hotel de Nantes', 2, '123 rue de Nantes');

insert into Conso(denomination)
values ('Petit déjeuner'),
       ('Soda'),
       ('Eau minérale'),
       ('Pression'),
       ('Plat du jour');


insert into Prix_conso(id_hotel, id_conso, prix) values 
(1, 1, 5.99),
(1, 2, 2.99),
(1, 3, 1.99),
(1, 4, 3.50),
(1, 5, 9.99),
(2, 1, 6.99),
(2, 2, 3.99),
(2, 3, 2.99),
(2, 4, 4.50),
(2, 5, 10.99),
(3, 1, 7.99),
(3, 2, 4.99),
(3, 3, 3.99),
(3, 4, 5.50),
(3, 5, 11.99),
(4, 1, 8),
(4, 2, 4),
(4, 5, 15.99);

INSERT INTO Chambre (id_hotel, id_categorie, numero_chambre) VALUES
(1, 3, 1), (1, 3, 2), (1, 3, 3), (1, 3, 4),
(1, 2, 5), (1, 2, 6), (1, 2, 7), (1, 2, 8), (1, 2, 9),
(1, 1, 101), (1, 1, 102), (1, 1, 103), (1, 1, 104), (1, 1, 105), (1, 1, 106), (1, 1, 107), (1, 1, 108),
(2, 3, 1), (2, 3, 2),
(2, 2, 3), (2, 2, 4),
(2, 1, 5), (2, 1, 6), (2, 1, 7), (2, 1, 8), (2, 1, 9);


INSERT INTO Users (nom, prenom, addresse, email, hash, banned) VALUES
('Super', 'Admin', '', 'admin@hotel.fr', crypt('isen', gen_salt('bf')), 0),
('LENOIR', 'Cyriac', '', 'cyriac@hotel.fr', crypt('isen', gen_salt('bf')), 0),
('Dupont', 'Jean', '10 Rue de Paris, Paris', 'jean.dupont@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Martin', 'Marie', '5 Avenue des Champs, Lyon', 'marie.martin@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Bernard', 'Luc', '12 Boulevard Saint-Michel, Marseille', 'luc.bernard@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Thomas', 'Julie', '20 Rue du Soleil, Toulouse', 'julie.thomas@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Robert', 'Sophie', '8 Avenue de la Mer, Nice', 'sophie.robert@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Richard', 'Paul', '15 Rue des Fleurs, Nantes', 'paul.richard@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Petit', 'Emma', '22 Place de la République, Lille', 'emma.petit@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Durand', 'Alice', '30 Rue de l Église, Bordeaux', 'alice.durand@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Lemoine', 'Louis', '18 Boulevard Haussmann, Paris', 'louis.lemoine@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Moreau', 'Clara', '24 Rue Lafayette, Lyon', 'clara.moreau@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Dubois', 'Nicolas', '45 Chemin des Prés, Grenoble', 'nicolas.dubois@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Fontaine', 'Isabelle', '28 Rue Nationale, Rennes', 'isabelle.fontaine@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Blanc', 'Antoine', '16 Avenue Victor Hugo, Dijon', 'antoine.blanc@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Gauthier', 'Charlotte', '50 Boulevard Gambetta, Nancy', 'charlotte.gauthier@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Perrin', 'Hugo', '14 Rue de Strasbourg, Metz', 'hugo.perrin@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Moulin', 'Laura', '36 Avenue Alsace Lorraine, Orléans', 'laura.moulin@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Lemoine', 'Victor', '60 Rue du Faubourg, Tours', 'victor.lemoine@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Roux', 'Camille', '40 Boulevard des États-Unis, Reims', 'camille.roux@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Morel', 'Anna', '25 Rue de la Paix, Clermont-Ferrand', 'anna.morel@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Barbier', 'Lucas', '38 Rue des Lilas, Limoges', 'lucas.barbier@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Chevalier', 'Léa', '12 Avenue de Verdun, Brest', 'lea.chevalier@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Benoit', 'Adrien', '33 Rue des Acacias, Amiens', 'adrien.benoit@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Arnaud', 'Clémence', '9 Rue de la Gare, Besançon', 'clemence.arnaud@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Schneider', 'Maxime', '27 Boulevard Carnot, Mulhouse', 'maxime.schneider@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Marchand', 'Inès', '18 Rue des Cerisiers, Rouen', 'ines.marchand@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Girard', 'Émile', '15 Rue des Tulipes, Angers', 'emile.girard@hotmail.com', crypt('isen', gen_salt('bf')), 0),
('Renaud', 'Lucie', '8 Place Saint-Pierre, Avignon', 'lucie.renaud@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Noël', 'Gabriel', '31 Rue des Jonquilles, Perpignan', 'gabriel.noel@yahoo.fr', crypt('isen', gen_salt('bf')), 0),
('Dufour', 'Eva', '22 Rue des Violettes, Caen', 'eva.dufour@gmail.com', crypt('isen', gen_salt('bf')), 0),
('Lopez', 'Théo', '17 Boulevard de la Liberté, Saint-Étienne', 'theo.lopez@hotmail.com', crypt('isen', gen_salt('bf')), 0);

INSERT INTO Reservation (id_chambre, date_debut, date_fin, date_arrivee, id_user, paiement, due) VALUES
(1, '2022-02-01', '2022-02-12', '2022-02-01', 2, 759, 759),
(1, '2022-02-12', '2022-02-13', '2022-02-12', 2, 69, 69),
(1, '2022-02-15', '2022-02-21', NULL, 2, 414, 414),
(1, '2022-02-25', '2022-02-26', NULL, 2, 69, 69),
(1, '2022-02-27', '2022-02-28', NULL, 2, 69, 69),
(2, '2022-02-15', '2022-02-18', NULL, 2, 207, 207),
(2, '2022-02-20', '2022-02-25', NULL, 2, 345, 345),
(2, '2022-02-25', '2022-02-28', NULL, 2, 207, 207),
(3, '2022-02-20', '2022-02-27', NULL, 2, 483, 483),
(4, '2022-02-15', '2022-02-16', NULL, 2, 69, 69),
(4, '2022-02-16', '2022-02-22', NULL, 2, 414, 414),
(4, '2022-02-27', '2022-02-28', NULL, 2, 69, 69),
(5, '2022-02-16', '2022-02-18', NULL, 2, 118, 118),
(5, '2022-02-19', '2022-02-21', NULL, 2, 118, 118),
(5, '2022-02-22', '2022-02-23', NULL, 2, 59, 59),
(5, '2022-02-27', '2022-02-28', NULL, 2, 59, 59),
(6, '2022-02-05', '2022-02-15', '2022-02-05', 2, 590, 590),
(6, '2022-02-16', '2022-02-22', NULL, 2, 354, 354),
(6, '2022-02-24', '2022-02-26', NULL, 2, 118, 118),
(6, '2022-02-27', '2022-02-28', NULL, 2, 59, 59),
(7, '2022-02-15', '2022-02-20', NULL, 2, 295, 295),
(8, '2022-02-01', '2022-02-12', '2022-02-01', 2, 649, 649),
(8, '2022-02-16', '2025-01-31', '2022-02-16', 2, 0, 63720),
(1, '2025-04-01', '2025-04-05', '2025-04-01', 2, 276, 276),
(2, '2025-04-10', '2025-04-15', NULL, 2, 345, 345),
(5, '2025-04-20', '2025-04-27', '2025-04-20', 2, 413, 413);

INSERT INTO Conso_client (id_sejour, id_conso, date_conso, nombre) VALUES
(1, 1, '2022-02-02', 2),
(1, 2, '2022-02-02', 1),
(1, 4, '2022-02-02', 1),
(1, 3, '2022-02-02', 1),
(1, 3, '2022-02-02', 1),
(1, 3, '2022-02-02', 1),
(1, 1, '2022-02-03', 2),
(1, 5, '2022-02-03', 2),
(1, 1, '2022-02-04', 1),
(1, 5, '2022-02-04', 1),
(1, 1, '2022-02-05', 2),
(1, 4, '2022-02-05', 3),
(1, 5, '2022-02-05', 2),
(1, 1, '2022-02-06', 2),
(22, 1, '2022-02-02', 2),
(22, 2, '2022-02-02', 1),
(22, 4, '2022-02-02', 1),
(22, 3, '2022-02-02', 1),
(22, 3, '2022-02-02', 1),
(22, 1, '2022-02-03', 2),
(22, 5, '2022-02-03', 2),
(22, 1, '2022-02-04', 1),
(22, 5, '2022-02-04', 1),
(22, 1, '2022-02-05', 2),
(22, 4, '2022-02-05', 3),
(22, 5, '2022-02-05', 2),
(22, 1, '2022-02-06', 2),
(24, 1, '2025-04-02', 2),
(24, 2, '2025-04-02', 1),
(25, 5, '2025-04-11', 1),
(25, 3, '2025-04-11', 2),
(26, 1, '2025-04-21', 2),
(26, 4, '2025-04-21', 1),
(26, 5, '2025-04-21', 1);

INSERT INTO Perms (nom) VALUES
('Admin'), ('Module     chambre'), ('Module conso'), ('Prix chambres'), ('Prix conso'), ('Promotions'), ('Logs');

INSERT INTO Perms_Users (id_user, id_perm, id_hotel) VALUES
(2, 1, 1), (2, 1, 2), (2, 2, 2), (2, 2, 3), (2, 3, 3),
(1, 1, 1), (1, 1, 2), (1, 1, 3), (1, 1, 4);

INSERT INTO Logs (id_user, id_hotel, content, date) VALUES
(2, 1, 'Connexion: 127.0.0.1', NOW());

INSERT INTO Services (id_service, nom, description, image_url) VALUES (1, 'Gastronomie Raffinée', 'Découvrez une cuisine exquise préparée par nos chefs étoilés, avec des ingrédients frais et locaux.', 'assets/images/chef-2585791_1280.jpg');
INSERT INTO Services (id_service, nom, description, image_url) VALUES (2, 'Restaurant Élégant', 'Profitez d’une ambiance luxueuse avec un service haut de gamme, idéal pour des dîners romantiques ou des repas d’affaires.', 'assets/images/restaurant-449952_1280.jpg');
INSERT INTO Services (id_service, nom, description, image_url) VALUES (3, 'Petit-Déjeuner Gourmet', 'Commencez votre journée avec un petit-déjeuner varié : viennoiseries, fruits frais, et options healthy.', 'assets/images/cafe-2265254_1280.jpg');