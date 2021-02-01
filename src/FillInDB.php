<?php


namespace App;


class FillInDB
{
    private const HOST = 'http://jsonplaceholder.typicode.com/posts';

    public function fill(\PDO $pdo)
    {
        try
        {
            $pdo->beginTransaction();
            $this->createTableUser($pdo);
            $this->createTablePost($pdo);
            $this->fillUpUser($pdo);
            $this->fillUpPost($pdo);
            $pdo->commit();
        }
        catch (\Exception $err)
        {
            $pdo->rollBack();
            echo 'Error while filling the database </br>';
            print_r($err->getMessage().'</br>');
            print_r($err->getFile().':'.$err->getLine());
            die(); // сюда ли??
        }
    }

    public function createTableUser(\PDO $pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS user (
                    user_id INT NOT NULL AUTO_INCREMENT,
                    first_name VARCHAR(100) NOT NULL ,
                    last_name VARCHAR(100) NOT NULL,
                    phone VARCHAR(20) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    PRIMARY KEY (user_id)
                    )";
        $pdo->exec($sql);
    }

    public function createTablePost(\PDO $pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS post (
                  post_id INT NOT NULL AUTO_INCREMENT,
                  user_id INT NOT NULL ,
                  title VARCHAR(255) DEFAULT '',
                  body TEXT NOT NULL,
                  PRIMARY KEY (post_id)
              )";
        $pdo->exec($sql);
    }

    public function fillUpUser($pdo)
    {
        $users = (new Fixtures())->generateUsers(10);
        foreach ($users as $user)
        {
            $sql = "INSERT IGNORE INTO user (first_name, last_name, phone, email) 
                    VALUES (
                            '{$user['first_name']}', 
                            '{$user['last_name']}', 
                            '{$user['phone']}', 
                            '{$user['email']}'
                            )";
            $pdo->exec($sql);
        }
    }
    public function fillUpPost($pdo)
    {
        $posts = (new Api())->get(self::HOST);
        foreach ($posts as $post)
        {
            $sql = "INSERT IGNORE INTO post (post_id, user_id, title, body)  
                    VALUES (
                            '{$post['id']}', 
                            '{$post['userId']}', 
                            '{$post['title']}', 
                            '{$post['body']}'
                            )";
            $pdo->exec($sql);
        }
    }
}