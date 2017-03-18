<?php
require_once("../config/session.php");
require("includes/header.php");
require_once("OtherCars.php");
$direction = new OtherCars();
$listeDirection = $direction->getAll('direction');
if(isset($_POST['add'])){

    $values = [
        "'".$_POST['direction']."'"
    ];
    $champs = [ 'label'];

        $direction->insertData('direction' , $champs , $values );
        header("location: direction.php");
}
if(isset($_GET['id'])){
    $id = $_GET["id"];
    $direction->deleteData("direction" , "id" , $id);
    header("location:direction.php");
}

    ?>
    <div class="container">
        <div class="jumbotron">
            <div class="col-md-6">
                <fieldset>
                    <legend>Ajouter / Direction</legend>
                        <form action="" method="POST" class="col-md-10 col-md-offset-1 form-group">
                            <label class="col-md-12">Direction
                                <input type="text" class="form-control" required name="direction" placeholder="Direction ...">
                            </label>
                            <hr>
                            <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
                            <button type="reset" class="btn btn-danger">Annuler</button>
                        </form>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>Liste</legend>
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Direction </th>
                            <th></th>
                        </tr>

                    <?php while($list = $listeDirection->fetch(PDO::FETCH_OBJ)){ ?>
                        <tr>
                            <td><?= $list->id ; ?></td>
                            <td><?= $list->label ; ?></td>
                            <td>
                                <a href="?id=<?= $list->id ; ?>" class="btn btn-danger"
                                   onclick="if(!confirm('Supprimer !!!')){return false ;}"> Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </table>
                </fieldset>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>