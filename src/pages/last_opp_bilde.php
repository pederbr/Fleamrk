<?php 
    error_reporting(0);

    session_start();
    $itemID = $_SESSION["itemID"];   
            
    $tilkobling = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');
    $stmt = $tilkobling->prepare(
        "SELECT item.*, merke_navn FROM item, merke WHERE item.merkeID=merke.merkeID AND itemID=:itemID"
    );
    $stmt->bindValue(':itemID', $itemID, SQLITE3_TEXT);
    $datasett = $stmt->execute();
    
    //print $stmt;

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
        $folder = __DIR__ . '/../resources/image_items/' . $newname;        
        //print $folder;
        //print $filename;
        //print $tempname;
            
        $db = new SQLite3(__DIR__ . '/../resources/db/fleamrk.db');
    
        // Get all the submitted data from the form
        $stmt2 = $db->prepare(
            "INSERT INTO bilder (bildenavn, gjenstandID) VALUES (:bildenavn, :gjenstandID)"
        );
        $stmt2->bindValue(':bildenavn', $newname, SQLITE3_TEXT);
        $stmt2->bindValue(':gjenstandID', $itemID, SQLITE3_TEXT);
        //print $stmt2;

        // Execute the query
        if ($stmt2->execute()) {
            // Now let's move the uploaded file into the folder
            if (move_uploaded_file($tempname, $folder)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
        } else {
            $msg = "Failed to insert image data into database";
        }
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
    <link rel="stylesheet" type="text/css" media="screen" href="/styles/main_style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>last_opp_bilde</title>
</head>

<body>
    <div id="display_large">
        <?php while ($rad = $datasett->fetchArray(SQLITE3_ASSOC)) { ?>
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
    <script>
        document.getElementById("upload").onchange = function () {
            document.getElementById("submitbutton").click();
        }

        document.cookie = "cookieName=cookieValue";
    </script>
</body>

</html>