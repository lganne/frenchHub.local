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

// table users
$link->query("
        CREATE TABLE `users` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
        `username` VARCHAR(30) NOT NULL,
        `password` VARCHAR(100) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `salt` VARCHAR(30) NOT NULL,
        `token` VARCHAR(50) NOT NULL,  
        `date_created` DATETIME,
         `date_modif` DATETIME,
         `isActif` BOOLEAN,
         `role` ENUM('administrator', 'editor', 'membre') NOT NULL DEFAULT 'membre',
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table users");
echo "ok users \n  <br>";

// table entreprises
$link->query("
        CREATE TABLE `entreprises` (
        `id` INT(10) UNSIGNED AUTO_INCREMENT,
         `name` VARCHAR(30) NOT NULL,
        `siren` INTEGER(10) ,
        `siret` VARCHAR(14) ,
        `adress` VARCHAR(100) NOT NULL,
        `contact` VARCHAR(150) NOT NULL,
        `fonction` VARCHAR(30) ,
        `emailcontact` VARCHAR(250) NOT NULL,
         `tel` VARCHAR(50),
         `description` VARCHAR(250),  
         `juridique` VARCHAR(100) ,
        `date_created` DATETIME,
         `date_modif` DATETIME,
         PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 ;
 " )or die("pb create table entreprise");

echo "ok entreprise \n <br>";

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
         `entreprises_id` INT UNSIGNED,
        `type` VARCHAR(30) ,
        `date_created` DATETIME,
         `date_modif` DATETIME,
          PRIMARY KEY (`id`),
        FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`) 
      ) ENGINE=InnoDB  AUTO_INCREMENT=1 ;"
        ) or die("pb create table requestEstimate");

echo "ok requestEstimate \n <br>";

$link->query("INSERT INTO `frenchhub2`.`users` (`id`, `username`, `password`, `email`, `salt`, `token`, `date_created`, `date_modif`, `isActif`, `role`) 
    VALUES (NULL, 'admin', SHA1('admin'), 'admin@yahoo.fr', SHA1('seldelavie'), SHA1('jeton'), '2015-02-22 00:00:00', '2015-02-22 00:00:00', '1', 'membre');
         ")or die("pb insert data users");

mysqli_close($link);

echo "ok tout est bon";