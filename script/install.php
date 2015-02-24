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

echo "ok database \n";


echo "Ok new user \n";

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



// seed tables
//$link->query("
//        INSERT INTO `users` (`username`,`email`, `password`, `role`,`salt`,`token`) VALUES 
//        ('admin','admin@yahoo.fr,admin, 'membre','seldelavie','jeton' )
//        ")or die("pb insert data users");

$link->query("INSERT INTO `frenchhub2`.`users` (`id`, `username`, `password`, `email`, `salt`, `token`, `date_created`, `date_modif`, `isActif`, `role`) 
    VALUES (NULL, 'admin', SHA1('admin'), 'admin@yahoo.fr', SHA1('seldelavie'), SHA1('jeton'), '2015-02-22 00:00:00', '2015-02-22 00:00:00', '1', 'membre');
         ")or die("pb insert data users");

mysqli_close($link);

echo "ok tout est bon";