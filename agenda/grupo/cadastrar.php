<?php

  // Remove mensagem de alerta
  error_reporting(1);

  // Clicou em enviar? O POST Existe?
  if ($_POST != NULL) {

    include_once "../conexao_bd.php";

    // Obtem dados do POST
    $nome = $_POST["nome"];

    // Valida campos obrigatórios
    if ($nome != "") {

      // Cria o comando SQL
      $sql = "INSERT INTO grupo (nome) 
              VALUES ('$nome')";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou?
      if ($retorno == true) {

        echo "<script>
                alert('Cadastrado com Sucesso!');
                location.href='cadastrar_grupo.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Cadastrar!');
              </script>";

        // Exibe do erro que o banco retorna
        echo $conexao->error;

      }

    } else {
        echo "<script>
                alert('Preencha todos os campos!');
              </script>";
    }

  }

?>
<?php include_once "../topo.php"; ?>

<h1>Cadastrar Grupo</h1>

<form method="POST">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" maxlength="50" required class="form-control">
  </div>

  <button class="btn btn-primary" type="submit">Salvar</button>
  
</form>

<?php include_once "../rodape.php"; ?>