<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once 'src/autoload.php';

//get database connection
$pdo = (new \App\ConnectDB())->connect();

//check if DB is empty
if (empty(($pdo->query('SHOW TABLES'))->fetchAll(PDO::FETCH_NUM)))
{
    // create tables and fill them with data
    (new \App\FillInDB())->fill($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div id="header">
        <?php
        include_once 'src/inc/header.inc.php';
        ?>
    </div>
    <hr>

    <div id="content">
    <?php
    if (!isset($_GET['id'])) {
        include_once 'src/inc/main.inc.php';
    } else {
        include_once 'src/inc/user.inc.php';
    }
    ?>
    </div>

    <hr>
    <div id="footer">
        <?php
        include_once 'src/inc/footer.inc.php';
        ?>
    </div>
</>

</body>
</html>





