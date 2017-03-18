<?php
require_once("../config/session.php");
require("includes/header.php");
require_once("OtherCars.php");
$client = new OtherCars();
$listeClient= $client->getAll('client');


if(isset($_POST['add'])){
    $values = [
        "'".$_POST['fullname']."'",
        "'".$_POST['phone']."'",
        "'".$_POST['email']."'",
        "'".$_POST['adress']."'"
    ];
    $champs = [ 'fullname', 'phone', 'email', 'adresse'];
    $client->insertData('client' , $champs , $values );
    header("location: client.php");
}

if(isset($_POST['update'])){

        $id = $_POST["id"];
        $arrayData = [
            "fullname"=>$_POST["fullname"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "adresse"=>$_POST["adress"],
        ];
        $client->updateData('client' , $arrayData , "id = $id");
        header("location: client.php");

}
if(isset($_GET['id']) && isset($_GET['action']) && $_GET["action"]==="delete"){
    $id = $_GET["id"];
    $client->deleteData("client" , "id" , $id);
    header("location: client.php");
}

if(isset($_GET['id']) && isset($_GET['action']) && $_GET["action"]==="update"){
    $id = $_GET["id"];
    $info = $client->getDetail('client' , "id = $id");
    $view = true ;

}else{
    $view = false ;
}
?>

    <div class="container">
        <div class="jumbotron">
           <?php if(!$view){?>
           <fieldset>
               <legend>Ajouter / Client
                   <a href="javascript:void(0);"><span id="show" class="glyphicon glyphicon-menu-hamburger"></span></a>
               </legend>
               <form action="" method="POST" id="reduit" class="col-md-10 col-md-offset-1 form-group">
                   <div class="col-md-6">
                       <label class="col-md-12">Nom & Prénom
                           <input type="text" class="form-control" name="fullname">
                       </label>
                   </div>
                   <div class="col-md-6">
                       <label class="col-md-12">E-mail
                           <input type="text" class="form-control" name="email">
                       </label>
                   </div>
                   <div class="col-md-6">
                       <label class="col-md-12">Téléphone
                           <input type="tel" class="form-control" name="phone">
                       </label>
                   </div>
                   <div class="col-md-6">
                       <label class="col-md-12">Adresse
                           <textarea name="adress" class="form-control"></textarea>
                       </label>
                   </div>
                   <div class="col-md-6">
                       <button type="submit" name="add" class="btn btn-block btn-primary">Ajouter</button>
                   </div>
                   <div class="col-md-6">
                       <button type="reset" class="btn btn-block btn-danger">Annuler</button>
                   </div>
               </form>
           </fieldset>
           <?php }else{ ?>
           <fieldset>
               <legend>Modifier / Client</legend>
               <form action="" method="POST" class="col-md-10 col-md-offset-1 form-group">
                   <div class="col-md-6">
                       <label class="col-md-12">Nom & Prénom
                           <input type="hidden" name="id" value="<?= $info["id"]; ?>">
                           <input type="text" class="form-control" name="fullname" value="<?= $info["fullname"]; ?>">
                       </label>
                   </div>
                   <div class="col-md-6">
                       <label class="col-md-12">E-mail
                           <input type="text" class="form-control" name="email" value="<?= $info["email"]; ?>">
                       </label>
                   </div>
                   <div class="col-md-6">
                       <label class="col-md-12">Téléphone
                           <input type="tel" class="form-control" name="phone" value="<?= $info["phone"]; ?>">
                       </label>
                   </div>
                   <div class="col-md-6">
                       <label class="col-md-12">Adresse
                           <textarea name="adress" class="form-control"><?= $info["adresse"]; ?></textarea>
                       </label>
                   </div>
                   <div class="col-md-6">
                       <button type="submit" name="update" class="btn btn-block btn-info">Terminer</button>
                   </div>
                   <div class="col-md-6">
                       <a href="?" class="btn btn-block btn-danger">Annuler</a>
                   </div>
               </form>
           </fieldset>
           <?php } ?>
        </div>
        <div class="jumbotron">
            Liste de Clients
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nom & Prénom</th>
                    <th>N° Tel </th>
                    <th>E-mail</th>
                    <th>Adresse</th>
                    <th></th>
                </tr>
                <?php while($liste = $listeClient->fetch(PDO::FETCH_OBJ)){ ?>
                <tr>
                    <td><?= $liste->id ; ?></td>
                    <td><?= $liste->fullname ; ?></td>
                    <td><?= $liste->phone ; ?></td>
                    <td><?= $liste->email ; ?></td>
                    <td><?= $liste->adresse ; ?></td>
                    <td>
                        <a href="?id=<?= $liste->id ; ?>&action=update" class="btn btn-warning">Modifier</a>
                        <a href="?id=<?= $liste->id ; ?>&action=delete"
                           class="btn btn-danger"
                           onclick="if(!confirm('Supprimer !!!')){return false ;}">Supprimer</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

<?php include("includes/footer.php"); ?>