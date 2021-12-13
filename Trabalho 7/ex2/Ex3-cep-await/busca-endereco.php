<?php
  require "../conexaoMysql.php";

  class Endereco{
    public $rua;
    public $bairro;
    public $cidade;
  
    function __construct($rua, $bairro, $cidade)
    {
      $this->rua = $rua;
      $this->bairro = $bairro;
      $this->cidade = $cidade;
    }
  }

  function getEndereco($cep){
    if($cep == '')
      return new Endereco('', '', '');
    
    $sql = <<<SQL
      SELECT rua, bairro, cidade
      FROM trab7_endereco WHERE cep = ?
    SQL;
    
    try{
      $pdo = mysqlConnect();
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$cep]);

      $row = $stmt->fetch();
      if($row)
        return new Endereco($row['rua'], $row['bairro'], $row['cidade']);

      return new Endereco('', '', '');

    }catch(Exception $e){
      return new Endereco('', '', '');
    }
  }
  
  $cep = $_GET['cep'] ?? '';
  $endereco = getEndereco($cep);
    
  echo json_encode($endereco);

?>