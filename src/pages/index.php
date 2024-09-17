<?php session_start();
error_reporting(0);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="main_style.css" />
    <title>fleamrk</title>
</head>
<body>
    <header>
        <h1>Velkommen til fleamrk</h1>
        <h2>Kjøp bruktklær online!</h2>
    </header>
    <nav></nav>
    <main>
<div class="include">
    <?php include("login.php") ?>
    </div>
    </main>
    <?php include("footer.html")?>

</body>
</html>

