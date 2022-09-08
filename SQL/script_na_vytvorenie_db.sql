/*DDL = Data Definition Language*/

CREATE TABLE osoba (
	id int(4) not null,
	meno varchar(50) not null,
	priezvisko varchar(50) not null,
	datum_narodenia date not null, 
	rodne_cislo varchar(11) not null,
	Primary KEY (id)
);

ALTER TABLE osoba ADD bydlisko varchar(35) not null;
ALTER TABLE osoba ADD plat varchar(10) not null;

CREATE TABLE osoba1 (
	id int(4) not null,
	meno varchar(50) not null,
	priezvisko varchar(50) not null,
	datum_narodenia date not null, 
	rodne_cislo varchar(11) not null,
	Primary KEY (id)
);

CREATE TABLE oddelenie
(
	id_oddelenia int(4) not null,
	PRIMARY KEY (id_oddelenia),
	nazov_oddelenia varchar(30) not null,
	skratka_oddelenia varchar(3) not null
);

DROP TABLE osoba1;




/*DML = Data manipulating language*/

/**
 * INSERT
 * UPDATE
 * DELETE
 * SELECT ......*/

INSERT INTO osoba_1 (meno,priezvisko,datum_narodenia,rodne_cislo,bydlisko)
VALUES("Jozef","Petrzlen","1111-11-11","111111/1111","Trnava");

UPDATE osoba_1 
SET oddelenie = 7, plat=350
WHERE id =11 AND 12 AND 13 AND 14 AND 15;

DELETE FROM osoba_1 WHERE id=11;

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Robotnici","RBS");

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Ekonomka","EKO");

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Zvaraci","ZVR");

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Tvarnici","TVR");

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Upratovacky","UPR");

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Vratnik","VRT");

INSERT INTO oddelenie (nazov_oddelenia,skratka_oddelenia)
VALUES("Architekt","ARC");



<<<<<<< Updated upstream




/*Získavanie teploty zo SQL*/
SELECT Max(id_merania),value,timestamp,eo.názov,ej.jednotka  FROM filip_soc.tbl_teplota tt INNER JOIN filip_soc.enum_obce eo ON tt.miesto_merania = eo.kod  INNER JOIN  filip_soc.enum_jednotky ej ON tt.jednotka = ej.id; 






