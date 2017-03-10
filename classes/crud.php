<?php

require_once 'db.php';

abstract class crud extends db{
    
    protected $table;
    
    abstract public function insert();
    abstract public function update($id_usuario);
    
    public function find($id_usuario){
        $sql = "select * from $this->table where id_usuario = :id_usuario";
        $stmt = db::prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        
    }
    
    public function findAll(){
       $sql = "select * from $this->table";
       $stmt = db::prepare($sql);
        $stmt->execute();
       return $stmt->fetchAll();
    }
    
    public function delete($id_usuario){
        $sql = "delete * from $this->table where id_usuario = :id_usuario";
        $stmt = db::prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
        
        
    }
}
