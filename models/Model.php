<?php

abstract class Model
{
 private static $_bdd;


 private static function setBdd()
 {
     self::$_bdd = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8','root','');
     self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
 }

 protected function getBdd()
 {
     if(self::$_bdd == null ){
         self::setBdd();
         return self::$_bdd;
     }
 }

 protected function getAll($table, $obj)
 {
    $var = [];
    $request= $this->getBdd()->prepare('SELECT * FROM ' .$table. ' ORDER BY idannonce desc');
    $request->execute();

    while($data = $request->fetch(PDO::FETCH_ASSOC))
    {
        $var[]= new $obj($data);
    }
    return $var;
    $request->closeCursor();
 }

} 