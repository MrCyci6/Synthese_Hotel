create table Classe
(
	id_classe SERIAL,
	denomination varchar(50) not null,
PRIMARY KEY(id_classe)
);


create table Categorie
(
	id_categorie SERIAL,
	denomination varchar(50) not null,
PRIMARY KEY(id_categorie)
);

create table Prix_chambre
(
	id_classe int not null,
	id_categorie int not null,
	prix numeric(7,2) not null,
PRIMARY KEY(id_classe, id_categorie),
FOREIGN KEY (id_classe) REFERENCES Classe (id_classe),
FOREIGN KEY (id_categorie) REFERENCES Categorie (id_categorie)
);


create table Hotel
(
	id_hotel SERIAL,
	nom varchar(50) not null,
	id_classe int not null,
PRIMARY KEY(id_hotel),
FOREIGN KEY (id_classe) REFERENCES Classe (id_classe)
);


create table Chambre
(
	id_chambre SERIAL,
	id_hotel int not null,
	id_categorie int not null,
	numero_chambre int not null,
PRIMARY KEY(id_chambre),
FOREIGN KEY (id_hotel) REFERENCES Hotel (id_hotel),
FOREIGN KEY (id_categorie) REFERENCES Categorie (id_categorie)
);

create table Conso
(
    id_conso SERIAL,
    denomination varchar(50) not null,
    PRIMARY KEY(id_conso)
);

create table Prix_conso
(
    id_conso int not null,
    id_hotel int not null,
    prix numeric(7,2) not null,
    PRIMARY KEY(id_conso, id_hotel),
    FOREIGN KEY (id_conso) REFERENCES Conso (id_conso),
    FOREIGN KEY (id_hotel) REFERENCES Hotel (id_hotel)
);

create extension pgcrypto;
create table Users
(
	id_user SERIAL,
	nom VARCHAR(50) NOT NULL,
	prenom VARCHAR(50) NOT NULL,
	addresse VARCHAR NOT NULL,
	email VARCHAR NOT NULL,
	hash TEXT NOT NULL,
	banned INTEGER NOT NULL,
PRIMARY KEY(id_user)
);

create table Reservation
(
	id_sejour SERIAL,
	id_chambre int not null,
	id_user INTEGER NOT NULL,
	date_debut date not null,
	date_fin date not null,
	date_arrivee date,
	paiement numeric(8,2),
PRIMARY KEY(id_sejour),
FOREIGN KEY (id_chambre) REFERENCES Chambre (id_chambre),
FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

create table Conso_client
(
    id_cc SERIAL,
    id_conso int not null,
	id_sejour int not null,
	date_conso date not null,
	nombre int not null,
PRIMARY KEY(id_cc),
FOREIGN KEY (id_conso) REFERENCES Conso (id_conso),
FOREIGN KEY (id_sejour) REFERENCES Reservation (id_sejour)
);

CREATE TABLE Perms
(
	id_perm SERIAL NOT NULL, 
	nom TEXT NOT NULL,
PRIMARY KEY(id_perm)
);

CREATE TABLE Perms_Users
(
	id_perm INTEGER NOT NULL,
	id_user INTEGER NOT NULL,
	id_hotel INTEGER NOT NULL,
PRIMARY KEY (id_perm, id_user, id_hotel),
FOREIGN KEY (id_perm) REFERENCES Perms(id_perm),
FOREIGN KEY (id_user) REFERENCES Users(id_user),
FOREIGN KEY (id_hotel) REFERENCES Hotel(id_hotel)
);

CREATE TABLE Logs
(
	id_log SERIAL NOT NULL,
	id_user INTEGER NOT NULL,
	id_hotel INTEGER NOT NULL,
	content VARCHAR NOT NULL,
	date DATE NOT NULL,
PRIMARY KEY (id_log),
FOREIGN KEY (id_hotel) REFERENCES Hotel(id_hotel),
FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

CREATE TABLE Discount
(
	id_discount SERIAL NOT NULL,
	percent NUMERIC(5,2) NOT NULL,
	max_utilisations INTEGER NOT NULL,
	utilisations INTEGER NOT NULL,
	expiration DATE NOT NULL,
PRIMARY KEY (id_discount)
);