<?php


class OtherCars{
    private $host = "mysql:host=localhost;dbname=othercars";
    private $user = "root";
    private $pword = "";
    public $db ;

    public function __construct(){
        try{
            $this->db = new PDO($this->host,$this->user,$this->pword);
        }catch(PDOException $e){
            echo "Echec : " . $e->getMessage();
        }
    }

    public function getDetail($table , $condition){
        $sql = "SELECT * FROM ".$table." WHERE ".$condition;
        $request = $this->db->query($sql);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        return $data ;
    }
    public function getAll($table){
        $sql = "SELECT * FROM ".$table."";
        $request = $this->db->query($sql);
        return $request ;
    }
    public function deleteData($table , $champ , $value){
        $sql = "DELETE FROM ".$table." WHERE ".$champ." = ".$value."";
        $request = $this->db->query($sql);
    }

    public function insertData($table , $arrayChamps , $arrayValues){
        $champs = implode(',' , $arrayChamps);
        $values = implode(',' , $arrayValues);
        $sql = "INSERT INTO ".$table." ( " . $champs ." ) VALUES ( ". $values .") ;" ;
        $request = $this->db->query($sql);

        /*if($request){
            return true ;
        }else{
            return false
        }*/
    }

    public function updateData($table , $arrayChamps , $condition){
        $sql = "UPDATE ".$table ." SET " ;
        foreach ($arrayChamps as $key => $value) {
            $sql.= $key ." = '".$value."' , ";
        }
        $sql = substr($sql , 0 , strlen($sql)-2);
        $sql .= " WHERE ". $condition ;
        //var_dump($sql);
        $request = $this->db->query($sql);

    }
}



