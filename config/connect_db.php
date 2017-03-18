<?php
if($_SERVER['REQUEST_METHOD']==='GET'){
    header('location: ../login.php');
}
define('DSN' , 'mysql:host=localhost;dbname=othercars;charset=utf8');
define('USER' , 'root');
define('PWORD' , '');

try{
    $db = new PDO(DSN , USER , PWORD);
}catch (PDOException $e){
    echo("<h3>Erreur ".$e->getMessage()."</h3>");
}