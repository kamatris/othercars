<?php
require_once("../config/session.php");
require("includes/header.php");
require_once("OtherCars.php");
$vehicule = new OtherCars();
$listeVehicule = $vehicule->getAll('vehiculle');
define('PATH' , '../web/uploads/');
/***********************************************************************/

if(isset($_POST['add'])){
    $file_ext = substr($_FILES['photo']['name'], strripos($_FILES['photo']['name'], '.')); // Get File name
    $newfilename = md5(uniqid($_FILES['photo']['name'])) . $file_ext ; // Get File extension
    $uploadFile = PATH.$newfilename; // concatenate path name and file
    //Get data from $_POST
    $option = isset($_POST['option']) ? implode(',' , $_POST['option']) : "" ;
    $values = [
        "'".$_POST['model']."'",
        "'".$_POST['description']."'",
        "'".$newfilename."'",
        "'".$option."'",
        "'".$_POST['prix_p1']."'",
        "'".$_POST['prix_p2']."'",
        "'".$_POST['prix_p3']."'"
    ];
    if(move_uploaded_file($_FILES['photo']['tmp_name'] , $uploadFile)){ // uploaded file
        $champs = [ 'modele', 'description', 'photo', 'options', 'prix_periode1', 'prix_periode2', 'prix_periode3'];

       $vehicule->insertData('vehiculle' , $champs , $values );
        header("location: vehicule.php");
    }
}

if(isset($_POST['update'])){
    if(isset($_FILES) && $_FILES["photo"]["name"]==""){
        $id = $_POST["id"];
        $option = isset($_POST['option']) ? implode(',' , $_POST['option']) : "" ;
        $arrayData = [
            "modele"=>$_POST["model"],
            "description"=>$_POST["description"],
            "options"=>$option,
            "prix_periode1"=>$_POST["prix_p1"],
            "prix_periode2"=>$_POST["prix_p2"],
            "prix_periode3"=>$_POST["prix_p3"]
        ];
        $vehicule->updateData('vehiculle' , $arrayData , "id = $id");
            header("location: vehicule.php");
    }else{
        //Delete image befor update
        $info = $vehicule->getDetail("vehiculle" , "id =".$_GET['id']);
        unlink("../web/uploads/".$info["photo"]);
        /*__________________________________________________________________________________________*/
        $file_ext = substr($_FILES['photo']['name'], strripos($_FILES['photo']['name'], '.')); // Get File name
        $newfilename = md5(uniqid($_FILES['photo']['name'])) . $file_ext ; // Get File extension
        $uploadFile = PATH.$newfilename; // concatenate path name and file
        if(move_uploaded_file($_FILES['photo']['tmp_name'] , $uploadFile)){ // uploaded file
            $id = $_POST["id"];
            $option = isset($_POST['option']) ? implode(',' , $_POST['option']) : "" ;
            $arrayData = [
                "modele"=>$_POST["model"],
                "description"=>$_POST["description"],
                "photo"=>$newfilename,
                "options"=>$option,
                "prix_periode1"=>$_POST["prix_p1"],
                "prix_periode2"=>$_POST["prix_p2"],
                "prix_periode3"=>$_POST["prix_p3"]
            ];
            $vehicule->updateData('vehiculle' , $arrayData , "id = $id");
            header("location: vehicule.php");
        }
    }

}

if(isset($_GET['id']) && isset($_GET['action']) && $_GET["action"]==="delete"){
    $id = $_GET["id"];
    $info = $vehicule->getDetail('vehiculle' , "id = $id");
    unlink(PATH.$info["photo"]);
    $vehicule->deleteData("vehiculle" , "id" , $_GET["id"]);
    header("location: vehicule.php");
}

if(isset($_GET['id']) && isset($_GET['action']) && $_GET["action"]==="update"){
    $id = $_GET["id"];
    $info = $vehicule->getDetail('vehiculle' , "id = $id");
    $view = true ;

}else{
    $view = false ;
}

/***********************************************************************/
?>
    <div class="container">
        <div class="jumbotron">
            <?php if(!$view){?>
            <fieldset>
                <legend>Ajout / Véhicule
                    <a href="javascript:void(0);"><span id="show" class="glyphicon glyphicon-menu-hamburger"></span></a>
                </legend>
                <form id="reduit" action="" enctype="multipart/form-data" method="POST" class="col-md-offset-1 col-md-10 form-group">
                    <div class="col-md-6">
                        <label for="model">Model</label>
                        <input type="text" name="model" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="description">Déscription</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Option</label>
                        <div class="col-md-12 btn-group">
                            <label class="col-md-3" for="GPS">GPS <input class="checkbox-primary" type="checkbox" name="option[]" value="GPS" id="GPS"></label>
                            <label class="col-md-3" for="Climatisation">Climatisation <input type="checkbox" name="option[]" value="Climatisation" id="Climatisation"></label>
                            <label class="col-md-3" for="LecteurCD">Lecteur CD <input type="checkbox" name="option[]" value="Lecteur CD" id="LecteurCD"></label>
                            <label class="col-md-3" for="BoiteAuto">Boite Auto <input type="checkbox" name="option[]" value="Boite Auto" id="BoiteAuto"></label>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-12">
                       <label class="col-md-4">Prix Période 1<input class="form-control" type="number" name="prix_p1"></label>
                       <label class="col-md-4">Prix Période 2<input class="form-control" type="number" name="prix_p2"></label>
                       <label class="col-md-4">Prix Période 3<input class="form-control" type="number" name="prix_p3"></label>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
                        <button type="reset" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </fieldset>
    <?php }else{ ?>
                <fieldset>
                    <legend>Modifier / Véhicule</legend>
                    <form action="" enctype="multipart/form-data" method="POST" class="col-md-offset-1 col-md-10 form-group">
                        <input type="hidden" name="id" value="<?= $info["id"]; ?>">
                        <div class="col-md-6">
                            <label for="model">Model</label>
                            <input type="text" name="model" value="<?= $info["modele"]; ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="description">Déscription</label>
                            <input type="text" name="description" value="<?= $info["description"]; ?>" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Option</label>
                            <div class="col-md-12 btn-group">
                                <label class="col-md-3" for="GPS">GPS <input class="checkbox-primary" type="checkbox" name="option[]" value="GPS" id="GPS"></label>
                                <label class="col-md-3" for="Climatisation">Climatisation <input type="checkbox" name="option[]" value="Climatisation" id="Climatisation"></label>
                                <label class="col-md-3" for="LecteurCD">Lecteur CD <input type="checkbox" name="option[]" value="Lecteur CD" id="LecteurCD"></label>
                                <label class="col-md-3" for="BoiteAuto">Boite Auto <input type="checkbox" name="option[]" value="Boite Auto" id="BoiteAuto"></label>
                                <hr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-4">Prix Période 1<input class="form-control" type="number" value="<?= $info["prix_periode1"]; ?>" name="prix_p1"></label>
                            <label class="col-md-4">Prix Période 2<input class="form-control" type="number" value="<?= $info["prix_periode2"]; ?>" name="prix_p2"></label>
                            <label class="col-md-4">Prix Période 3<input class="form-control" type="number" value="<?= $info["prix_periode3"]; ?>" name="prix_p3"></label>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="update" class="btn btn-info">Modifier</button>
                            <a href="?" class="btn btn-danger">Annuler</a>
                        </div>
                    </form>
                </fieldset>
    <?php } ?>
        </div>
        <div class="jumbotron">
            <filedset>
                <legend>Liste des véhiculle</legend>
                <table class="table-back table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Modele</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Options</th>
                        <th>Prix</th>
                        <th> * * * </th>
                    </tr>
                    <?php while($d = $listeVehicule->fetch(PDO::FETCH_OBJ)){?>
                    <tr>
                        <td><?= $d->id ; ?></td>
                        <td><?= $d->modele ; ?></td>
                        <td><?= $d->description ; ?></td>
                        <td>
                            <img src="../web/uploads/<?= $d->photo ; ?>" class="image-back thumbnail">
                        </td>
                        <td>
                            <ul>
                            <?php
                        $options = explode(',' , $d->options);
                            for($i=0 ; $i< count($options) ; $i++){
                                echo "<li><strong> $options[$i] </strong></li>";
                            }
                            ?>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li><?= $d->prix_periode1 ; ?> <strong>DTT</strong></li>
                                <li><?= $d->prix_periode2 ; ?> <strong>DTT</strong></li>
                                <li><?= $d->prix_periode3 ; ?> <strong>DTT</strong></li>
                            </ul>
                        </td>
                        <td>
                            <a href="?id=<?= $d->id ; ?>&action=update" class="btn btn-warning">Modifier</a>
                            <a href="?id=<?= $d->id ; ?>&action=delete"
                               class="btn btn-danger"
                               onclick="if(!confirm('Supprimer !!!')){return false ;}">Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </filedset>
        </div>
    </div>
<?php include("includes/footer.php"); ?>