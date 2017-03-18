<?php
if($_SERVER["REQUEST_METHOD"]==="GET"){
    header("location: ../login.php");
}

require_once("connect_db.php");
session_start();
$login = $_POST["login"];
$p_word    = SHA1($_POST["p_word"]);

$sql = "SELECT fullname , email , type , etat FROM user WHERE login = :login AND pword = :p_word " ;

$request = $db->prepare($sql);

$request->execute([":login"=>$login , ":p_word"=>$p_word]);

$data = $request->fetch(PDO::FETCH_OBJ);
var_dump($data);
if($data){
    if($data->etat != 0){
        if($data->type==1){
            $_SESSION['fullname'] = $data->fullname ;
            $_SESSION['email'] = $data->email ;
            $_SESSION["type"] = $data->type ;
            header("location: ../admin/index_dash.php");
        }elseif($data->type==2){
            $_SESSION['fullname'] = $data->fullname ;
            $_SESSION['email'] = $data->email ;
            $_SESSION["type"] = $data->type ;
            header("location: ../admin/index_dash.php");
        }else{
            header("location: ../login.php?msg=Erreur System");
        }
    }else{
        header("location: ../login.php?msg=Compte désactivé");
    }
}else{
    header("location: ../login.php?msg=Login Ou Mot de passe invalide");
}

