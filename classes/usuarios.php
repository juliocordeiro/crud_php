<?php

require_once 'crud.php';

class usuarios extends crud{
    
    protected $table ='usuario';
    private $nome_usuario;
    private $email_usuario;
    
    public function setNome($nome_usuario){
        $this->nome_usuario = $nome_usuario;
        
    }
    
    public function getNome(){
        return $this->nome_usuario;
    }
    
    public function setEmail($email_usuario){
        $this->email_usuario = $email_usuario;
        
    }
    
    public function insert() {
        $sql  = "insert into $this->table(nome_usuario, email_usuario) values (:nome_usuario, :email_usuario)";
        $stmt = db::prepare($sql);
        $stmt->bindParam(':nome_usuario', $this->nome_usuario);
        $stmt->bindParam(':email_usuario', $this->email_usuario);
        return $stmt->execute();
    }
    
    public function update($id_usuario) {
        
        $sql = "update $this->table set nome_usuario = :nome_usuario, email_usuario = :email_usuario where id_usuario = :id_usuario";
        $stmt = db::prepare($sql);
        $stmt->bindParam(':nome_usuario', $this->nome_usuario);
        $stmt->bindParam(':email_usuario', $this->email_usuario);
        $stmt->bindParam('id_usuario', $id_usuario);
        return $stmt->execute();
    }
}
