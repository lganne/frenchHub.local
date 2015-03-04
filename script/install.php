<?php

$link=mysqli_connect('localhost', 'root', '') or die("pb connexion");

// réinitialisation
$link->query("
        DROP DATABASE IF EXISTS frenchHub2;
        ") or die("drop database impossible");


$link->query(
        "CREATE DATABASE IF NOT EXISTS `frenchHub2` DEFAULT CHARACTER SET utf8 "
        . "COLLATE utf8_general_ci;"
        ) or die("pb create database blog");

echo "ok database \n  <br>";


mysqli_close($link);

$link=mysqli_connect('localhost', 'root', '', 'frenchHub2') or die("pb connexion");


// table entreprises
$link->query("
        CREATE TABLE `entreprises` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
         `name` VARCHAR(30) NOT NULL,
        `siren` INTEGER(10) ,
         `adress` VARCHAR(250) NOT NULL,
         `cp` VARCHAR(20) NOT NULL,
        `Ville`  VARCHAR(150) NOT NULL,
         `Pays`  VARCHAR(150) NOT NULL,
         `civilite` BOOLEAN,
         `contactNom` VARCHAR(150) NOT NULL,
          `contactPrenom` VARCHAR(50) NOT NULL,
        `fonction` VARCHAR(30) ,
        `emailcontact` VARCHAR(250) NOT NULL,
         `tel` VARCHAR(50),
         `activity` VARCHAR(250),  
         `NbreSalarier` integer,
         `date_created` DATETIME,
         `date_modif` DATETIME,
         PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table entreprise");

echo "ok entreprise \n <br>";

// table newsLetter
$link->query("
        CREATE TABLE `newsLetter` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
         `entreprises_id` INT UNSIGNED,
          `logement` BOOLEAN,
        `immigration` BOOLEAN,
         `competitivite` BOOLEAN,
        `fiscalite` BOOLEAN,
        `integration` BOOLEAN,
        `marque` BOOLEAN,
          PRIMARY KEY (`id`),
           CONSTRAINT `fk_newsLetter_entreprises_id` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table newsletter");

// table formule d'abonnement 
$link->query("
        CREATE TABLE `subscription` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
         `entreprises_id` INT UNSIGNED,
          `formule1` BOOLEAN,
        `formule2` BOOLEAN,
         `formule3` BOOLEAN,
        `formule4` BOOLEAN,
        `date_created` DATETIME,
        PRIMARY KEY (`id`),
         CONSTRAINT `fk_subscription _entreprises_id` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`) ON DELETE SET NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table subscription ");

echo "ok subscription  \n <br>";
//tables salariers
$link->query("
        CREATE TABLE `employee` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
        `entreprises_id` INT UNSIGNED,
        `name` VARCHAR(30) NOT NULL,
        `firstname` VARCHAR(30) NOT NULL,
         `fonction` VARCHAR(30) ,
        `email` VARCHAR(250) NOT NULL,
         PRIMARY KEY (`id`),
          FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`) 
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table users");

echo "ok employee <br>";
// table users
$link->query("
        CREATE TABLE `users` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
          `entreprises_id` INT UNSIGNED,
             `employee_id` INT UNSIGNED,
        `username` VARCHAR(30) UNIQUE,
        `password` VARCHAR(100) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `salt` VARCHAR(30) NOT NULL,
        `token` VARCHAR(50) NOT NULL,  
        `date_created` DATETIME,
         `date_modif` DATETIME,
         `isActif` BOOLEAN default true,
         `role` ENUM('administrator', 'membre','entreprise') NOT NULL DEFAULT 'membre',
        PRIMARY KEY (`id`),
          FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
          FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table users");
echo "ok users \n  <br>";

// table memberShip (adhesion)
$link->query("
        CREATE TABLE `memberShip` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
         `entreprises_id` INT UNSIGNED,
        `type` VARCHAR(30) ,
        `etat` ENUM('adherent', 'resilier', 'en attente') NOT NULL DEFAULT 'en attente',
        `lastBill` VARCHAR(50),
        `date_lastBill` DATETIME,
        `date_created` DATETIME,
         `date_modif` DATETIME,
          PRIMARY KEY (`id`),
        CONSTRAINT `fk_memberShip_entreprises_id` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`) ON DELETE SET NULL
      ) ENGINE=InnoDB  AUTO_INCREMENT=1 ;"
        ) or die("pb create table memberShip");

echo "ok memberShip \n <br>";

// table requestEstimate (demande de devis)
$link->query("
        CREATE TABLE `requestEstimate` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
        `name` VARCHAR(30) NOT NULL,
         `adress` VARCHAR(250) NOT NULL,
          `pays` VARCHAR(100) NOT NULL,
        `siren` INTEGER(10) ,
        `siret` VARCHAR(14) ,
        `Activity` VARCHAR(250),  
         `contact` VARCHAR(150) NOT NULL,
        `fonction` VARCHAR(30) ,
        `emailcontact` VARCHAR(250) NOT NULL,
         `tel` VARCHAR(50),
         `salary` INTEGER(10) ,
        `assistance` BOOL NOT NULL DEFAULT '0', 
         `optionAssistance` VARCHAR(10) ,
          `immigration` BOOL NOT NULL DEFAULT '0', 
         `optionImmigration` VARCHAR(10) ,
          `logement` BOOL NOT NULL DEFAULT '0', 
         `optionLogement` VARCHAR(10) ,
          `administration` BOOL DEFAULT '0', 
         `optionAdministration` VARCHAR(10) ,
          `Famille` BOOL NOT NULL DEFAULT '0', 
         `optionFamille` VARCHAR(10) ,
         `comment` VARCHAR(100) ,
        `date_created` DATETIME,
         `date_modif` DATETIME,
          PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  AUTO_INCREMENT=1 ;"
        ) or die("pb create table requestEstimate");

echo "ok requestEstimate \n <br>";

// table informations
$link->query("
        CREATE TABLE `informations` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
         `name` VARCHAR(30) NOT NULL,
         `contact` VARCHAR(150) NOT NULL,
        `fonction` VARCHAR(30) ,
        `emailcontact` VARCHAR(250) NOT NULL,
        `Pays`  VARCHAR(150) NOT NULL,
         `tel` VARCHAR(50),
         `date_created` DATETIME,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table information");

echo "ok information <br>";

$link->query("INSERT INTO `frenchhub2`.`entreprises` (`id`, `name`, `siren`,  `adress`, `Ville`, `Pays`, `contactNom`, `fonction`, `emailcontact`, `tel`, `activity`,  `date_created`, `date_modif`) 
    VALUES (NULL, 'samsung', NULL,  '', '', 'coree', 'admin', 'rh', 'rh@yahoo.fr', NULL, NULL,  NULL, NULL);");

$link->query("INSERT INTO `frenchhub2`.`users` (`id`, `entreprises_id`, `username`, `password`, `email`, `salt`, `token`, `date_created`, `date_modif`, `isActif`, `role`) 
        VALUES (NULL, '1', 'entreprise', '23dfe5c957cad2f7fce71d865d3db05ad3621b99','','EvGg8gCO3EtLJ7km2EMkiIVRmgmGzN', '', '2015-02-27 00:00:00', '2015-02-27 00:00:00', '1', 'entreprise');");
    
$link->query("INSERT INTO `frenchhub2`.`users` (`id`, `entreprises_id`, `username`, `password`, `email`, `salt`, `token`, `date_created`, `date_modif`, `isActif`, `role`)"
        . " VALUES (NULL, '1', 'membre', '7f347eb4972f19df2bffa50a28b36be26fb9c9c1','', 'zZSqSeYdpe1PZ0AZXYNUa8eiYXZpco',  '', '2015-02-27 00:00:00', '2015-02-27 00:00:00', '1', 'entreprise');");

$link->query("INSERT INTO `frenchhub2`.`users` (`id`, `username`, `password`, `email`, `salt`, `token`, `date_created`, `date_modif`, `isActif`, `role`) 
    VALUES (NULL, 'admin', SHA1('c354bf69b321fd4c676f4ee42054d5adminc354bf69b321fd4c676f4ee42054d5'), 'admin@yahoo.fr', SHA1('seldelavie'), SHA1('jeton'), '2015-02-22 00:00:00', '2015-02-22 00:00:00', '1', 'membre');
         ")or die("pb insert data users");

mysqli_close($link);


echo "ok tout est bon";