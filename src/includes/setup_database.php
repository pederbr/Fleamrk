<?php

// Create (connect to) SQLite database in the project folder
$conn = new SQLite3(filename: __DIR__ . '/../resources/db/fleamrk.db');


// Create tables
$sql = "CREATE TABLE IF NOT EXISTS bruker (
    brukerID INTEGER PRIMARY KEY AUTOINCREMENT,
    brukernavn VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    passord VARCHAR(255) NOT NULL,
    fornavn VARCHAR(50),
    etternavn VARCHAR(50),
    telefonnummer VARCHAR(20),
    create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS merke (
    merkeID INTEGER PRIMARY KEY AUTOINCREMENT,
    merke_navn VARCHAR(100) NOT NULL,
    merke_info TEXT,
    merke_link VARCHAR(255)
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS item (
    itemID INTEGER PRIMARY KEY AUTOINCREMENT,
    navn_item VARCHAR(100) NOT NULL,
    beskrivelse TEXT,
    size VARCHAR(50),
    selgerID INTEGER,
    solgt BOOLEAN DEFAULT 0,
    pris DECIMAL(10, 2),
    merkeID INTEGER,
    FOREIGN KEY (selgerID) REFERENCES bruker(brukerID),
    FOREIGN KEY (merkeID) REFERENCES merke(merkeID)
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS bilder (
    bildeID INTEGER PRIMARY KEY AUTOINCREMENT,
    bildenavn VARCHAR(255) NOT NULL,
    gjenstandID INTEGER,
    FOREIGN KEY (gjenstandID) REFERENCES item(itemID)
)";
$conn->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS favoritt (
    favorittID INTEGER PRIMARY KEY AUTOINCREMENT,
    itemID INTEGER,
    brukerID INTEGER,
    FOREIGN KEY (itemID) REFERENCES item(itemID),
    FOREIGN KEY (brukerID) REFERENCES bruker(brukerID)
)";
$conn->exec($sql);

// Close connection
$conn->close();
?>