<?php

  // Remove mensagem de alerta
  error_reporting(1);

  include_once "../conexao_bd.php";

  // Obtém ID via GET
  $id = $_GET["id"];

  // Esqueceu de passar o ID?
  if ($id == NULL) {
    echo "O ID não foi passado! <br>";
  }

  // Cria comando SQl
  $sql = "SELECT contato.*, grupo.nome AS nome_grupo
          FROM contato 
          INNER JOIN grupo 
          ON contato.cod_grupo = grupo.id
          WHERE contato.id = $id";

  // Executa no BD
  $retorno = $conexao->query($sql);

  // Deu erro?
  if ($retorno == false) {
    echo $conexao->error;
  }

  if ($registro = $retorno->fetch_array()) {
    
    $id = $registro["id"];
    $nome = $registro["nome"];
    $telefone = $registro["telefone"];
    $email = $registro["email"];
    $cod_grupo = $registro["cod_grupo"];
    $detalhes = $registro["detalhes"];
    $nome_grupo = $registro["nome_grupo"];
    $foto = $registro["foto"];

    if ($foto == "") {
      $foto = "http://www.tribunadeituverava.com.br/wp-content/uploads/2018/02/sem-foto.jpg";
    }

  } else {
    echo "Este ID não existe! <br>";
  }

?>  

<?php include_once "../topo.php"; ?>

<h1>Ver Contato</h1>

<a class="btn btn-primary" href="listar.php">Voltar</a>
<br><br>

<table class="table table-bordered table-striped">
  <tr>
    <td><b>ID:</b></td>
    <td><?php echo $id; ?></td>
  </tr>
  <tr>
    <td><b>Nome:</b></td>
    <td><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td><b>Telefone:</b></td>
    <td><?php echo $telefone; ?></td>
  </tr>
  <tr>
    <td><b>E-Mail:</b></td>
    <td><?php echo $email; ?></td>
  </tr>
  <tr>
    <td><b>Grupo:</b></td>
    <td><?php echo $nome_grupo; ?></td>
  </tr>
  <tr>
    <td><b>Detalhes:</b></td>
    <td><?php echo $detalhes; ?></td>
  </tr>
  <tr>
    <td><b>Foto:</b></td>
    <td><img width="150px" src='<?php echo $foto; ?>'></td>
  </tr>
</table>      

<?php include_once "../rodape.php"; ?>