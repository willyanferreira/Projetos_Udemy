<?php
namespace App\Models;
use MF\Model\Model;

class Produtos extends Model{
    
    public function getProdutos(){
        $query = "SELECT id, descricao, preco FROM tb_produtos";
        return $this->db->query($query)->fetchALL();
    }
}
?>