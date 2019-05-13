<?php include_once "../topo.php"; ?>

<h1>Listar Contatos</h1>

<table class="table table-bordered table-striped">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Telefone</th>
    <th>Ver</th>
    <th>Editar</th>
    <th>Apagar</th>
  </tr>
  <?php

    // Remove mensagem de alerta
    error_reporting(1);

    include_once "../conexao_bd.php";

    // ID do usuário logado
    $id_usuario = $_SESSION["id_usuario"];

    // Cria comando SQl
    $sql = "SELECT * 
            FROM contato 
            WHERE cod_usuario = $id_usuario";

    // Executa no BD
    $retorno = $conexao->query($sql);

    // Deu erro?
    if ($retorno == false) {
      echo $conexao->error;
    }

    while ($registro = $retorno->fetch_array()) {
      
      $id = $registro["id"];
      $nome = $registro["nome"];
      $telefone = $registro["telefone"];

      echo "<tr>
              <td>$id</td>
              <td>$nome</td>
              <td>$telefone</td>
              <td><a class='btn btn-info' href='ver.php?id=$id'><i class='fas fa-eye'></i></a></td>
              <td><a class='btn btn-warning' href='editar.php?id=$id'><i class='fas fa-edit'></i></a></td>
              <td><a onclick=\"return confirm('Deseja Apagar?');\" class='btn btn-danger' href='apagar.php?id=$id'><i class='fas fa-trash-alt'></i></a></td>
            </tr>";

    }

  ?>
  
</table>      

<?php include_once "../rodape.php"; ?>