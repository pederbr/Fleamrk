<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles/main_style.css" />
    <title>main</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>

<body>
<div class="wrapper">
        <?php include(__DIR__ . "/../includes/top_navbar.php");?>
        <main>
            <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'search';
                $allowed_pages = ['admin', 'item', 'kjøp', 'last_opp_bilde', 'login', 'main', 'min_bruker', 'ny_bruker', 'ny_gjenstand', 'nytt_merke', 'om_oss', 'oppdater_info_bruker', 'search'];
                
                if (in_array($page, $allowed_pages)) {
                    include(__DIR__ . "/$page.php");
                } else {
                    include(__DIR__ . "/not_found.php");
                }
            ?>
        </main>
        <?php include(__DIR__ . "/../includes/footer.html")?>
    </div>
</body>

</html>