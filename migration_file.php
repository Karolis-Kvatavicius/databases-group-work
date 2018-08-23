<?php


function generateName() {

    $nameLength = rand(5, 7);
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomName = '';
    

    for ($i = 0; $i < $nameLength; $i++) {
        $randomName .= $characters[rand(0, $charactersLength - 1)];
    }  

    return ucfirst($randomName);
}

function generateSurname() {
    $surnameLength = rand(7, 12);
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomSurname = '';

    for ($i = 0; $i < $surnameLength; $i++) {
        $randomSurname .= $characters[rand(0, $charactersLength - 1)];
    }

    return ucfirst($randomSurname);
}

function generateBudget() {
    return rand(1000, 100000);
}

    //Prisijungimai
    $servername = "localhost";
    $username = "root";
    $password = "123";

    //connect to server
    $conn = mysqli_connect($servername, $username, $password);

    //select database
    $db_selected = mysqli_select_db($conn, 'projektai');

    // If can't connect, then create database
    if (!$db_selected) {
        $sql = 'CREATE DATABASE projektai';
        mysqli_query($conn, $sql);
        unset($sql);
        unset($conn);
        $conn = mysqli_connect($servername, $username, $password, 'projektai'); 
        
    } else {
        unset($conn);
        $conn = mysqli_connect($servername, $username, $password, 'projektai'); 
    }

    // delete tables if exist
    $sql = "DROP TABLE IF EXISTS users";
    mysqli_query($conn, $sql);
    unset($sql);

    $sql = "DROP TABLE IF EXISTS projektu_sarasas";
    mysqli_query($conn, $sql);
    unset($sql);

    $sql = "DROP TABLE IF EXISTS destytoju_sarasas";
    mysqli_query($conn, $sql);
    unset($sql);

    $sql = "DROP TABLE IF EXISTS connections";
    mysqli_query($conn, $sql);
    unset($sql);
  
    //create users table
    $sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Vardas VARCHAR(30) NOT NULL,
    slaptazodis VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
    )";
    mysqli_query($conn, $sql);
    unset($sql);

    //fill users table    
    $sql = "INSERT INTO users (Vardas, slaptazodis)
    VALUES ('Jonas', '123')";
    mysqli_query($conn, $sql);
    unset($sql);
    
    $sql = "INSERT INTO users (Vardas, slaptazodis)
    VALUES ('Donata', '123')";
    mysqli_query($conn, $sql);
    unset($sql);
    
    $sql = "INSERT INTO users (Vardas, slaptazodis)
    VALUES ('Marius', '123')";
    mysqli_query($conn, $sql);
    unset($sql);
    
    $sql = "INSERT INTO users (Vardas, slaptazodis)
    VALUES ('Karolis', '123')";
    mysqli_query($conn, $sql);
    unset($sql);    

    //create projects table
    $sql = "CREATE TABLE projektu_sarasas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Pavadinimas VARCHAR(30) NOT NULL,
    Biudzetas INT(15) NOT NULL,
    DestytojoID VARCHAR(30) NULL,
    reg_date TIMESTAMP
    )";
    mysqli_query($conn, $sql);
    unset($sql);

    //fill projects table
    for ($i = 0; $i < 100; $i++) { 
        $sql = "INSERT INTO projektu_sarasas (Pavadinimas, Biudzetas)
        VALUES ('".generateName()."', '".generateBudget()."')";
        mysqli_query($conn, $sql);
        unset($sql);  
    }

    //create teachers table
    $sql = "CREATE TABLE destytoju_sarasas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Vardas VARCHAR(30) NOT NULL,
    Pavarde VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
    )";
    mysqli_query($conn, $sql);
    unset($sql);

    //fill teachers table
    for ($i= 0; $i < 50; $i++) { 
        $sql = "INSERT INTO destytoju_sarasas (Vardas, Pavarde)
        VALUES ('".generateName()."', '".generateSurname()."')";
        mysqli_query($conn, $sql);
        unset($sql); 
    }

     //create connections table
     $sql = "CREATE TABLE connections (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ProjektoID VARCHAR(30) NOT NULL UNIQUE,
        DestytojoID VARCHAR(30) NOT NULL,
        reg_date TIMESTAMP
        )";
        mysqli_query($conn, $sql);
        unset($sql);
        

        // $sql = "SELECT id FROM projektu_sarasas";
        // $result = mysqli_query($conn, $sql);
        // if (mysqli_num_rows($result) > 0) {
        //     while($row = mysqli_fetch_assoc($result)) {
        //         $sql2 = "INSERT INTO connections (ProjektoID) VALUES ('".$row['id']."')";
        //         mysqli_query($conn, $sql2);
        //         unset($sql2);
        //     }
        // }
        // unset($sql);