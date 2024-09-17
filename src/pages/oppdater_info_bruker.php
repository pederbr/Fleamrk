<?php
    include("top_navbar.php");
    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");

    $sql=sprintf("SELECT * From bruker WHERE brukerID=%s",
    $tilkobling->real_escape_string($_GET["oppdaterID"]));
    $datasett=$tilkobling->query($sql);
    
    if (isset($_POST["submit"])){
        while ($rad=mysqli_fetch_array($datasett)) {
            if ($_POST["txtBrukernavn"]!= $rad["brukernavn"]) {
                //echo "unequal";
                $sql = sprintf("SELECT brukerID FROM bruker WHERE brukernavn = '%s'", 
                $tilkobling->real_escape_string($_POST["txtBrukernavn"]));
                $brukersjekk = $tilkobling->query($sql);
                //sjekker om brukernavn er tatt
    
        if(mysqli_num_rows($brukersjekk)==1){
            echo 'Dette brukernavnet er tatt!';
        }else{
            $sql=sprintf("UPDATE bruker SET brukernavn='%s', email='%s', fornavn='%s', etternavn='%s', telefonnummer='%s' WHERE brukerID= %s",
                    $tilkobling->real_escape_string($_POST["txtBrukernavn"]),
                    $tilkobling->real_escape_string($_POST["txtMail"]),
                    $tilkobling->real_escape_string($_POST["txtFornavn"]),
                    $tilkobling->real_escape_string($_POST["txtEtternavn"]),
                    $tilkobling->real_escape_string($_POST["txtTelefonnummer"]),
                    $tilkobling->real_escape_string($_GET["oppdaterID"])
                    );
            $tilkobling->query($sql);
            print $sql;
            $_SESSION["fornavn"]=$_POST["txtFornavn"];
            $_SESSION["etternavn"]=$_POST["txtEtternavn"]; 

            header("Location:main.php");
        }
        }else{
            $sql=sprintf("UPDATE bruker SET brukernavn='%s', email='%s', fornavn='%s', etternavn='%s', telefonnummer='%s' WHERE brukerID= %s",
                    $tilkobling->real_escape_string($_POST["txtBrukernavn"]),
                    $tilkobling->real_escape_string($_POST["txtMail"]),
                    $tilkobling->real_escape_string($_POST["txtFornavn"]),
                    $tilkobling->real_escape_string($_POST["txtEtternavn"]),
                    $tilkobling->real_escape_string($_POST["txtTelefonnummer"]),
                    $tilkobling->real_escape_string($_GET["oppdaterID"])
                    );
            $tilkobling->query($sql);
            print $sql;
            $_SESSION["fornavn"]=$_POST["txtFornavn"];
            $_SESSION["etternavn"]=$_POST["txtEtternavn"]; 

            header("Location:main.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href=" main_style.css" />
    <title>oppdater_info</title>
</head>

<body>
    <main>
    <form method="post">
            <?php if($rad=mysqli_fetch_array($datasett)) { ?>
            <br>
            <label for="txtBrukernavn"> Brukernavn:</label>
            <input type="text" name="txtBrukernavn" value="<?php echo $rad["brukernavn"];?>" />
            <br>
            <label for="txtMail">E-post adresse:</label>
            <input type="email" name="txtMail" value="<?php echo $rad["email"];?>"/>
            <br>
            <label for="txtFornavn">Fullt navn:</label>
            <div id="name_input">
                <input type="text" name="txtFornavn" value="<?php echo $rad["fornavn"];?>" />
                <input type="text" name="txtEtternavn" value="<?php echo $rad["etternavn"];?>"/>
            </div>
            <br>
            <label for="txtTelefonnummer">telefonnummer:</label>
            <input type="tel" name="txtTelefonnummer" value="<?php echo $rad["telefonnummer"];?>" />
            <br>
            <input type="submit" name="submit" value="oppdater bruker">
            <?php } ?>
        </form>
    </main>
    <?php include("footer.html")?>

</body>

</html>