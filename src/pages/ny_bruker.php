<?php
session_start();

    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");
    $sql="SELECT * FROM bruker";
    $datasett = $tilkobling->query($sql);

if(isset($_POST["submit"]))
{
    $sql = sprintf("SELECT brukerID FROM bruker WHERE brukernavn = '%s'", 
    $tilkobling->real_escape_string($_POST["txtBrukernavn"]));
    $brukersjekk = $tilkobling->query($sql);
    //sjekker om brukernavn er tatt
    
    if(mysqli_num_rows($brukersjekk)==1){
        echo 'Dette brukernavnet er tatt!';
    } else{
        $txtBrukernavn = $_POST['txtBrukernavn'];
        $txtMail = $_POST['txtMail'];
        $txtFornavn = $_POST['txtFornavn'];
        $txtEtternavn = $_POST['txtEtternavn'];
        $txtTlf = $_POST['txtTlf'];
    if (empty($txtBrukernavn) || empty($txtMail) || empty($txtFornavn) || empty($txtEtternavn) || empty($txtTlf)) {
        echo 'Fyll inn alle feltene';
    } else {
        //om brukernavnet ikke er tatt så legger den bruker inn
    $passord = password_hash($_POST["txtPassord"], PASSWORD_DEFAULT);
    $sql =sprintf("INSERT INTO bruker (brukernavn, email, passord, fornavn, etternavn, telefonnummer) 
    VALUES ('%s', '%s', '". $passord . "','%s','%s','%s')",
    $tilkobling->real_escape_string($_POST["txtBrukernavn"]),
    $tilkobling->real_escape_string($_POST["txtMail"]),
    $tilkobling->real_escape_string($_POST["txtFornavn"]),
    $tilkobling->real_escape_string($_POST["txtEtternavn"]),
    $tilkobling->real_escape_string($_POST["txtTlf"]),

         );
        $tilkobling->query($sql);


        $sql2 = sprintf("SELECT brukerID FROM bruker WHERE brukernavn = '%s'", 
        $tilkobling->real_escape_string($_POST["txtBrukernavn"]));
        $datasett = $tilkobling->query($sql2);

        if ($datasett->num_rows > 0) {
          // output data of each row
          while($row = $datasett->fetch_assoc()) {
            $id=$row["brukerID"];
          }} 

        $_SESSION["brukerID"]=$id;
        $_SESSION["fornavn"]=$_POST["txtFornavn"]; 
        $_SESSION["etternavn"]=$_POST["txtEtternavn"]; 

        //print_r($_SESSION); 

        header("Location:login.php");
            
        }
    }

}
?>

<!DOCTYPE html>
<html>
<!-- seksjon for metainfo -->

<head>
    <title> Sidetittel</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <link rel="stylesheet" type="text/css" media="print" href="utskrift.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h2, p {
            margin: 10px;
        }
        main {
            padding: 10px;
        }
    </style>

</head>
<!-- seksjon for hovedinnhold -->

<body>
    <main>
    <h2>Ny bruker:</h2>
    <div id="form_wrapper">
        <form id="add" method="post">
            <br>
            <label for="txtBrukernavn"> Brukernavn:</label>
            <input type="text" name="txtBrukernavn" placeholder="brukernavn" />
            <br>
            <label for="txtMail">E-post adresse:</label>
            <input type="email" name="txtMail" placeholder="ola.nordmann@gmail.com"/>
            <br>
            <label for="txtPassord">Lag passord:</label>
            <input type="password" name="txtPassord" placeholder="********"/>
            <br>
            <label for="txtFornavn">Fullt navn:</label>
            <div id="name_input">
                <input type="text" name="txtFornavn" placeholder="fornavn" />
                <input type="text" name="txtEtternavn" placeholder="etternavn"/>
            </div>
            <br>
            <label for="txtTlf">telefonnummer:</label>
            <input type="tel" name="txtTlf" placeholder="12345678"/>
            <br>
            <input type="submit" name="submit" value="Lag ny bruker">
        </form>
    </div>
    <p>
    har du allerede bruker?
    <a href="index.php">Logg inn her</a>
    </p>
    </main>
    <?php include("footer.html")?>
   
</body>

</html>