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
  $sql = "DELETE FROM contato 
          WHERE id = $id";

  // Executa no BD
  $retorno = $conexao->query($sql);

  // Executou?
  if ($retorno == true) {

    echo "<script>
            alert('Deletado com Sucesso!');
            location.href='listar.php';
          </script>";

  } else {

    echo "<script>
            alert('Erro ao Deletar!');
          </script>";

    // Exibe do erro que o banco retorna
    echo $conexao->error;

  }

?> 