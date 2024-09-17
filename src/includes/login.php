<!--php-kode starter-->
<?php
session_start();
error_reporting(0);


if(isset($_SESSION["brukerID"])){
    header("Location:main.php");
}
else{
    print $_SESSION["brukerID"];
    
/*Sjekker om submit-knappen er trykket*/
if (isset($_POST['submit'])) { 
    
    
    /*Lager en tilkobling til databasen*/
    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");

     /*Henter brukernavnet og passord fra databasen basert på brukernavnet som er skrevet inn*/

    $sql=sprintf("SELECT * FROM bruker WHERE brukernavn='%s'",
            $tilkobling->real_escape_string($_POST["user"])
                );
     $datasett=$tilkobling->query($sql); 

   /* Henter datasettet */
   if(mysqli_num_rows($datasett)==1){
    if ($rad =mysqli_fetch_array($datasett)) { 
        /*Sjekker om passord matcher det i databasen*/
        if (password_verify($_POST["pass"], $rad["passord"]))
        
        /*Hvis det stemmer skjer dette*/
        { 
         /*legger medlemsid og navn i hver sin session-variabel slik at jeg kan bruke dem på andre sider*/
        $_SESSION["brukerID"]=$rad["brukerID"];
        $_SESSION["fornavn"]=$rad["fornavn"]; 
        $_SESSION["etternavn"]=$rad["etternavn"]; 

        header("Location:main.php");
        } 
        
        /*Hvis det ikke stemmer skjer dette*/
        else { echo "feil passord "; } 
    }
}
else { echo 'brukernavn finnes ikke';}
}
}
/*PHP-kode slutter*/
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Login Form in PHP with Session</title>
        <link href="style.css" rel="stylesheet" type="text/css">
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
    <a href="ny_bruker.php">Registrer deg her</a>
        
    </body>

    </html>
