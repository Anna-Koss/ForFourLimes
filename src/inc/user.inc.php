<?php
//get database connection
$pdo = (new \App\ConnectDB())->connect();

//get user name
$id =(int)strip_tags(trim($_GET['id']));
$sql = "SELECT first_name, last_name FROM user WHERE user_id={$id}";
$userData = (($pdo->query($sql))->fetch(PDO::FETCH_ASSOC));
echo '<h2>'.$userData['first_name'].' '.$userData['last_name'].'</h2>';

//get posts
if (isset($_GET['show_all'])){
    $sql = "SELECT title, body FROM post WHERE user_id=$id";
    $buttonVisibility = 'hidden';

} else {
    $sql = "SELECT title, body FROM post WHERE user_id=$id LIMIT 5";
    $buttonVisibility = 'visible';
}

//show posts
$userPosts = (($pdo->query($sql))->fetchAll(PDO::FETCH_ASSOC));
?>
<div class="row row-cols-1 row-cols-md-3 g-4">

    <?php foreach ($userPosts as $userPost) { ?>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?= $userPost['title'] ?></h5>
                    <hr>
                    <!-- cut post-->
                    <p class="card-text"><?= substr($userPost['body'], 0, 80) ?>...</p>
                </div>
            </div>
        </div>
    <?php } ?>

<!--button ShowMore-->
    <div class="col" style="visibility:<?=$buttonVisibility?>">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title text-center"><a class="btn" href="user.inc.php?id=<?= $id ?>&show_all=1">Show more -></a></h5>
            </div>
        </div>
    </div>

</div>
<br>
<a href="/" class="btn btn-success">Main</a>
