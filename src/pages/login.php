<!--php-kode starter-->
<?php
session_start();
#require_once("setup_database.php");
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1);

if(isset($_SESSION["brukerID"])){
    header("Location:../pages/main.php");
    exit(); // Ensure script stops after redirection
}

/*Sjekker om submit-knappen er trykket*/
if (isset($_POST['submit'])) { 
    
    /*Lager en tilkobling til databasen*/
    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');

    if (!$tilkobling) {
        die("Database connection failed: " . $tilkobling->lastErrorMsg());
    }

    /*Henter brukernavnet og passord fra databasen basert på brukernavnet som er skrevet inn*/
    $sql = sprintf("SELECT * FROM bruker WHERE brukernavn='%s'",
            $tilkobling->escapeString($_POST["user"])
                );
    $datasett = $tilkobling->query($sql); 

    if (!$datasett) {
        die("Query failed: " . $tilkobling->lastErrorMsg());
    }

    /* Henter datasettet */
    if($datasett->numColumns() > 0){
        if ($rad = $datasett->fetchArray(SQLITE3_ASSOC)) { 
            /*Sjekker om passord matcher det i databasen*/
            if (password_verify($_POST["pass"], $rad["passord"])) {
                /*Hvis det stemmer skjer dette*/
                /*legger medlemsid og navn i hver sin session-variabel slik at jeg kan bruke dem på andre sider*/
                $_SESSION["brukerID"] = $rad["brukerID"];
                $_SESSION["fornavn"] = $rad["fornavn"]; 
                $_SESSION["etternavn"] = $rad["etternavn"]; 

                header("Location:../pages/main.php");
                exit(); // Ensure script stops after redirection
            } else { 
                echo "Feil passord. Vennligst prøv igjen."; 
            } 
        } else { 
            echo 'Brukernavn finnes ikke. Vennligst prøv igjen.'; 
        }
    } else { 
        echo 'Brukernavn finnes ikke. Vennligst prøv igjen.'; 
    }
}
?>
<!--PHP-kode slutter-->

<!DOCTYPE html>
<html>

<head>
    <title>Logg inn</title>
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main_style.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="login">
        <h2>Logg inn:</h2>
        <form action="" method="post">
            <label>brukernavn:</label>
            <input id="name" name="user" placeholder="brukernavn" type="text">
            <label>passord:</label>
            <input id="password" name="pass" placeholder="passord" type="password"><br><br>
            <input name="submit" type="submit" value="Login ">
        </form>
    </div>
    har du ikke bruker?  
    <a href="/pages/ny_bruker.php">Registrer deg her</a>
    
</body>

</html>