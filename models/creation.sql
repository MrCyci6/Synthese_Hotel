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


create table Reservation
(
	id_sejour SERIAL,
	id_chambre int not null,
	date_debut date not null,
	date_fin date not null,
	date_arrivee date,
	nom_client varchar(50),
	paiement numeric(8,2),
PRIMARY KEY(id_sejour),
FOREIGN KEY (id_chambre) REFERENCES Chambre (id_chambre)
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

create table Users
(
	id_user SERIAL,
	id_role INTEGER,
	nom VARCHAR(50) NOT NULL,
	prenom VARCHAR(50) NOT NULL,
	addresse VARCHAR NOT NULL,
	email VARCHAR NOT NULL,
	hash TEXT NOT NULL,
PRIMARY KEY(id_user),
FOREIGN KEY(id_role) REFERENCES Roles(id_role)
);

create table Roles
(
	id_role SERIAL,
	nom VARCHAR(50) NOT NULL
PRIMARY KEY(id_role)
);