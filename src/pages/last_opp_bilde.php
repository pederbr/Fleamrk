<?php 
    error_reporting(0);
    include("top_navbar.php");

    $itemID=$_SESSION["itemID"];   
            
    $tilkobling=mysqli_connect ("localhost","root","", "fleamrk");
    $sql = sprintf("SELECT item.*, merke_navn FROM item, merke WHERE item.merkeID=merke.merkeID AND  itemID = %s", 
    $tilkobling->real_escape_string($itemID));    
    $datasett = $tilkobling->query($sql);
    
    //print $sql;

    //$slettID="";
    $msg = "";
    
    // If upload button is clicked ...
    if (isset($_POST['upload'])) {
        
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $filename = $_FILES["uploadfile"]["name"];
        $newname = generateRandomString() . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        $tempname = $_FILES["uploadfile"]["tmp_name"];	
            $folder = "bilder_gjenstander/". $newname;
            //print $folder;
            //print $filename;
            //print $tempname;
            
        $db = mysqli_connect("localhost", "root", "", "fleamrk");
    
            // Get all the submitted data from the form
            $sql2 = "INSERT INTO `fleamrk`.`bilder` (`bildenavn`, `gjenstandID`) VALUES ('$newname', '$itemID')";
            //print $sql2;
    
            // Execute query
            mysqli_query($db, $sql2);
            
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
                //header("Location:main.php");
                print $msg;


            }else{
                $msg = "Failed to upload image";
                print $msg;
                $sql3 = sprintf("DELETE FROM `fleamrk`.`bilder` WHERE (`gjenstandID` = '$itemID')"); 
                $datasett3 = $tilkobling->query($sql3);
                //print $sql3;


        }
        //print $msg;
    }
    $result = mysqli_query($db, "SELECT * FROM bilder");


    if (isset($_GET["slettID"])) { 
        $sql3 = sprintf("DELETE FROM `bilder` WHERE `gjenstandID` = %s",
         $tilkobling->real_escape_string($_GET["slettID"]),
        
        ); 
        $datasett3 = $tilkobling->query($sql3);
        unlink($_GET["folder"]);
        //print $sql3;
        header( "refresh:5;url=last_opp_bilde.php" );
        }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        #content {
            width: 50%;
            margin: 20px auto;
            border: 1px solid #cbcbcb;
            display: flex;
        }

        form {
            width: 100%;
            margin: 20px auto;
        }


        #review {
            width: 100%;
        }

        #button_upload {
            display: inline-block;
            box-sizing: border-box;
            width: 50%;
            background-color: #735B46;
            color: white;
            padding: 14px 20px;
            margin: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        #button_upload:hover {
            background-color: #402E24;
        }

        #column {
            display: flex;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>last_opp_bilde</title>
</head>

<body>
    <div id="display_large">
        <?php while ($rad =mysqli_fetch_array($datasett)) { ?>
        <h2>Legg inn bilde for: <?php echo $rad["navn_item"]; ?> </h2>
        <?php } ?>
    </div>

    <div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <input id="upload" type="file" name="uploadfile" value="" />
            <input id="submitbutton" type="submit" name="upload" value="upload" style="display:none;">
            <img id="review" src="<?php echo isset($folder) ? $folder : '';?>" alt="<?php echo $folder;?>">
            <div id="column">
            <a id="button_upload" href="main.php">legg inn bilde</a>
            <a id="button_upload" href="?slettID=<?php echo $itemID;?>&folder=<?php echo $folder;?>">velg et nytt
                bilde</a>
                </div>
        </form>
    </div>
    <?php include("footer.html")?>
    <script>
        document.getElementById("upload").onchange = function () {
            document.getElementById("submitbutton").click();
        }

        document.cookie = "cookieName=cookieValue";
    </script>
</body>

</html>