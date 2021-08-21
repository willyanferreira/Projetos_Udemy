<?php
error_reporting(E_ALL &  ~E_NOTICE);

#classe dashboard
class DashBoard{
    public $data_inicio;
    public $data_fim;
    public $numeroVendas;
    public $totalVendas;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
}

#classe de conexão com o banco de dados
class Conexao{
    private $dbHost = 'localhost';
    private $dbUser = '';
    private $dbSenha = '';
    private $db = 'dashboard';

    public function conectar(){
        try{
            $conexao = new PDO(
                "mysql:host=$this->dbHost; dbname=$this->db", 
                "$this->dbUser", 
                "$this->dbSenha"
            );
            $conexao->exec('set charset utf8');
            return $conexao;
        }catch(PDOException $e){
            echo '<p>'. $e->getMessege().'</p>';
        }
    }

}

class BD{
    private $conexao;
    private $dashboard;

    public function __construct(Conexao $conexao, DashBoard $dashboard){
        $this->conexao = $conexao->conectar();
        $this->dashboard = $dashboard;
    }

    public function getNumeroVendas(){
        $query = 'SELECT COUNT(*) as numero_vendas FROM tb_vendas WHERE data_venda between :data_inicio AND :data_fim';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
        $stmt->bindValue(':data_fim', $this->dashboard->__get('data_fim'));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->numero_vendas;
    }

    public function getTotalVendas(){
        $query = 'SELECT SUM(total) as total_vendas FROM tb_vendas WHERE data_venda between :data_inicio AND :data_fim';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':data_inicio', $this->dashboard->__get('data_inicio'));
        $stmt->bindValue(':data_fim', $this->dashboard->__get('data_fim'));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->total_vendas;
    }
}

$dashboard = new DashBoard();

$conexao = new Conexao();

$competencia = explode('-', $_GET['competencia']);
$ano = $competencia[0];
$mes = $competencia[1];
$dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

$dashboard->__set('data_inicio', $ano . '-' . $mes . '-' . '01');
$dashboard->__set('data_fim', $ano . '-' . $mes . '-' . $dias_do_mes);

$bd = new BD($conexao, $dashboard);

$dashboard->__set('numeroVendas', $bd->getNumeroVendas());
$dashboard->__set('totalVendas', $bd->getTotalVendas());
echo json_encode($dashboard);


?>