<?php
//TODO: вынести класс, добавить для него интерфейс

//get database connection
$pdo = (new \App\ConnectDB())->connect();

// Get users data as array
$part = '';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $part = (string)strip_tags(trim($_POST['part']));
//    echo $part;
    $sql = "SELECT user_id, first_name, last_name, phone, email FROM user 
                WHERE first_name LIKE '%{$part}%' 
                OR last_name LIKE '%{$part}%'";
} else {
    $sql = 'SELECT user_id, first_name, last_name, phone, email FROM user';
}
$users = (($pdo->query($sql))->fetchAll(PDO::FETCH_ASSOC));

//search
?>
<div id="search">
<h3>Search User</h3>
    <form method="post" class="form">
        <label>Insert part of user name <br/>
            <input type="text" size="20" name="part" value="<?=$part?>" />
        </label>
        <input type="submit" value="search" class="btn-success">
    </form>
</div>

<hr>

<div id="table">
<?php
//show users
function table($users)
{
    echo "<table class='table table-dark table-striped'>";
    echo "<tr>
                <th></th><th>First Name</th><th>Last Name</th><th>Phone</th><th>Email</th><th></th
            </tr>";
    foreach ($users as $user)
    {

        echo "<tr>";
        foreach ($user as $item)
        {
            echo "<td>$item</td>";
        }
        echo "<td><a href='user.php?id={$user['user_id']}'>Show posts</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
table($users);
//TODO: вынести функцию в класс?
?>
</div>
