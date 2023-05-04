CREATE DATABASE IF NOT EXISTS bdboutique DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE bdboutique;

DROP TABLE IF EXISTS membres;
CREATE TABLE membres (
  idm int(11) PRIMARY KEY AUTO_INCREMENT,
  prenom varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  nom varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  courriel varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  sexe varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  datedenaissance date COLLATE utf8_unicode_ci DEFAULT NULL,
  photo varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS connexion;
CREATE TABLE connexion (
  idm int(11) NOT NULL,
  courriel varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  motdepass varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  role varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  statut varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  CONSTRAINT connexion_idm_FK FOREIGN KEY(idm) REFERENCES membres(idm)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS produits;
CREATE TABLE produits (
  idp int(11) PRIMARY KEY AUTO_INCREMENT,
  pochette varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  titre varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  categorie varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  description varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  prix decimal(11,2) NOT NULL,
  quantite int(11) NOT NULL,
  date datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS paniers;
CREATE TABLE paniers (
  idm int(11) NOT NULL,
  idp int(11) NOT NULL,
  quantiteChoisie int(11) NOT NULL,
  CONSTRAINT paniers_idm_FK FOREIGN KEY(idm) REFERENCES membres(idm),
  CONSTRAINT paniers_idp_FK FOREIGN KEY(idp) REFERENCES produits(idp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;