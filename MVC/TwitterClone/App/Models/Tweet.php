<?php
namespace App\Models;
use MF\Model\Model;

class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    //Getters and Setters mágicos
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }

    //salvar
    public function salvar(){
        $query = "INSERT INTO tweets(id_usuario, tweet) VALUES(:id_usuario, :tweet)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();

        return $this;

    }
    //recuperar
    public function getAll(){
        $query = "
            SELECT 
                t.id, t.id_usuario, u.nome, t.tweet, DATE_FORMAT(t.data, '%d/%m/%Y %H:%i:%s') as data 
            FROM 
                tweets as t
                LEFT JOIN usuarios AS u ON (t.id_usuario = u.id)
            WHERE 
                t.id_usuario = :id_usuario 
            OR 
                t.id_usuario 
            IN 
                (SELECT id_usuario_seguindo FROM usuarios_seguidores WHERE id_usuario = :id_usuario)
            ORDER BY
                t.data DESC
            ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>