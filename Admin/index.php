<?php
session_start();
function CreateTable(){
    require_once("../DB/ini.php");
    $createTable = connect();
    $sqls = [ 
    "CREATE TABLE IF NOT EXISTS user_reg (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        Rid CHAR(255) NOT NULL,
        T CHAR(24) NOT NULL,
        Nickname TEXT NOT NULL,
        FirstName TEXT NOT NULL,
        LastName TEXT NOT NULL,
        Email TEXT NOT NULL UNIQUE,
        Password TEXT NOT NULL,
        Confirm TINYINT(1) NOT NULL DEFAULT 0,
        AcceptTerms TINYINT(1) NOT NULL DEFAULT 0,
        Date_Created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;",

    "CREATE TABLE IF NOT EXISTS addedfile (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_user CHAR(255) NOT NULL,
    Uniqid CHAR(255) NOT NULL,
    Private TINYINT(1) NOT NULL DEFAULT 0,
    Public TINYINT(1) NOT NULL DEFAULT 0,
    Shared TINYINT(1) NOT NULL DEFAULT 0,
    Type TEXT NOT NULL,
    FileAttach TEXT NOT NULL,
    Namefile TEXT NOT NULL,
    Title CHAR(255),
    Size VARCHAR(255) NOT NULL,
    Date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    From_device TEXT,
    FOREIGN KEY (ID_user) REFERENCES user_reg(ID) ON DELETE CASCADE
) ENGINE=InnoDB;"
    
];

    try {
        foreach($sqls as $sql){
            $createTable->exec($sql);
        }
        echo json_encode(["Status" => "success", "Message" => "Table user_reg has been create correct."]);
    } catch (PDOException $e) {
        echo json_encode(["Status" => "error", "Message" => "Error while create table: " . $e->getMessage()]);
    }
}
CreateTable();
