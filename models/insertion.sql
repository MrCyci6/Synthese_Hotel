insert into Classe(denomination) values ('*'), ('**'), ('***');

insert into Categorie(denomination) values ('Simple'), ('Double'), ('Double avec salle de bain');

insert into Prix_chambre(id_classe, id_categorie, prix) values
(1, 1, 39), (1, 2, 59), (1, 3, 69),
(2, 1, 59), (2, 2, 89), (2, 3, 99),
(3, 1, 69), (3, 2, 99), (3, 3, 109);

insert into Hotel(nom, id_classe) values
('Hotel de Caen', 1),
('Hotel de Brest', 1),
('Hotel de Paris', 2),
('Hotel de Nantes', 2);

insert into Conso(denomination)
values ('Petit déjeuner'),
       ('Soda'),
       ('Eau minérale'),
       ('Pression'),
       ('Plat du jour');


insert into Prix_conso(id_hotel, id_conso, prix)
values (1, 1, 5.99),
       (1, 2, 2.99),
       (1, 3, 1.99),
       (1, 4, 3.50),
       (1, 5, 9.99);
insert into Prix_conso(id_hotel, id_conso, prix)
SELECT 2, id_conso, prix+1 FROM Prix_conso WHERE id_hotel = 1;
insert into Prix_conso(id_hotel, id_conso, prix)
SELECT 3, id_conso, prix+2 FROM Prix_conso WHERE id_hotel = 1;
insert into Prix_conso(id_hotel, id_conso, prix)
values (4, 1, 8),
       (4, 2, 4),
       (4, 5, 15.99);

insert into Chambre(id_hotel, id_categorie, numero_chambre)
values(1, 3, 1),
      (1, 3, 2),
      (1, 3, 3),
      (1, 3, 4),
      (1, 2, 5),
      (1, 2, 6),
      (1, 2, 7),
      (1, 2, 8),
      (1, 2, 9),
      (1, 1, 101),
      (1, 1, 102),
      (1, 1, 103),
      (1, 1, 104),
      (1, 1, 105),
      (1, 1, 106),
      (1, 1, 107),
      (1, 1, 108),
      (2, 3, 1),
      (2, 3, 2),
      (2, 2, 3),
      (2, 2, 4),
      (2, 1, 5),
      (2, 1, 6),
      (2, 1, 7),
      (2, 1, 8),
      (2, 1, 9);
insert into Chambre(id_hotel, id_categorie, numero_chambre)
select id_hotel+2, id_categorie,numero_chambre from Chambre;

insert into Reservation(id_chambre, date_debut, date_fin, date_arrivee, nom_client, paiement) values
(1,'2022-02-01', '2022-02-12', '2022-02-01', 'Dupont', NULL),
(1,'2022-02-12', '2022-02-13', '2022-02-12', 'Dupond', NULL),
(1,'2022-02-15', '2022-02-21', NULL, NULL, NULL),
(1,'2022-02-25', '2022-02-26', NULL, NULL, NULL),
(1,'2022-02-27', '2022-02-28', NULL, NULL, NULL),
(2,'2022-02-15', '2022-02-18', NULL, NULL, NULL),
(2,'2022-02-20', '2022-02-25', NULL, NULL, NULL),
(2,'2022-02-25', '2022-02-28', NULL, NULL, NULL),
(3,'2022-02-20', '2022-02-27', NULL, NULL, NULL),

(4,'2022-02-15', '2022-02-16', NULL, NULL, NULL),
(4,'2022-02-16', '2022-02-22', NULL, NULL, NULL),
(4,'2022-02-27', '2022-02-28', NULL, NULL, NULL),
(5,'2022-02-16', '2022-02-18', NULL, NULL, NULL),
(5,'2022-02-19', '2022-02-21', NULL, NULL, NULL),
(5,'2022-02-22', '2022-02-23', NULL, NULL, NULL),
(5,'2022-02-27', '2022-02-28', NULL, NULL, NULL),
(6,'2022-02-05', '2022-02-15', '2022-02-05', 'Tintin', NULL),
(6,'2022-02-16', '2022-02-22', NULL, NULL, NULL),
(6,'2022-02-24', '2022-02-26', NULL, NULL, NULL),
(6,'2022-02-27', '2022-02-28', NULL, NULL, NULL),
(7,'2022-02-15', '2022-02-20', NULL, NULL, NULL),

(8,'2022-02-01', '2022-02-12', '2022-02-01', 'Haddock', NULL),
(8,'2022-02-16', '2025-01-31', '2022-02-16', 'Castafiore', NULL);

INSERT INTO Conso_client(id_sejour, id_conso, date_conso, nombre) VALUES
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
(22, 1, '2022-02-06', 2);

INSERT INTO roles(nom) VALUES ('Administrateur'), ('Client');
INSERT INTO users(id_role, nom, prenom, addresse, email, hash) VALUES (1, 'Lenoir', 'Cyriac', '60 rue d''hérouville', 'cyriac.lenoir@isen-ouest.yncrea.fr', crypt('isen', gen_salt('bf')));