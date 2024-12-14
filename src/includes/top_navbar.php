<?php
session_start();
error_reporting(0);

class SQLiteSessionHandler extends SQLite3 implements SessionHandlerInterface {
    public function __construct($dbFile) {
        $this->open($dbFile);
    }

    public function open($savePath, $sessionName) {
        return true;
    }

    public function close() {
        return $this->close();
    }

    public function read($id) {
        $result = $this->querySingle("SELECT data FROM sessions WHERE id = '$id'");
        return $result ? $result : '';
    }

    public function write($id, $data) {
        $this->exec("REPLACE INTO sessions (id, data) VALUES ('$id', '$data')");
        return true;
    }

    public function destroy($id) {
        $this->exec("DELETE FROM sessions WHERE id = '$id'");
        return true;
    }

    public function gc($maxlifetime) {
        $this->exec("DELETE FROM sessions WHERE strftime('%s', 'now') - strftime('%s', timestamp) > $maxlifetime");
        return true;
    }
}

$handler = new SQLiteSessionHandler('sessions.db');
session_set_save_handler($handler, true);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main_style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>

<body>
    <nav>
        <div id="float_left">
            <a href="main.php"><img src="website_pictures\fleamrk XS.png" alt="fleamrk"></a>
            <?php if(isset($_SESSION["brukerID"])){echo "<a href='ny_gjenstand.php'>legg ut</a>";}?>
            <a href="om_oss.php">om oss</a>
            <?php if($_SESSION["brukerID"]==14){echo "<a href='admin.php'>admin</a>";} ?>
        </div>
        <div id="float_right">
            <?php if(isset($_SESSION["brukerID"])){echo 
            "<a href='min_bruker.php'> hei " . $_SESSION['fornavn']. "</a>";}
           else{echo "<a href='index.php'>logg inn</a>"; }?>
        </div>
    </nav>

</body>

</html>