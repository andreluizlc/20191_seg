<?php

  // Remove mensagem de alerta
  error_reporting(1);

  // Clicou em enviar? O POST Existe?
  if ($_POST != NULL) {

    include_once "../conexao_bd.php";

    // Obtem dados do POST
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $cod_grupo = $_POST["cod_grupo"];
    $detalhes = $_POST["detalhes"];
    $foto = $_POST["foto"];

    // Inicializa a sessão
    session_start();

    // ID do usuário logado
    $id_usuario = $_SESSION["id_usuario"];

    // Valida campos obrigatórios
    if ($nome != "" && $telefone != "" && $cod_grupo != "" ) {

      // Cria o comando SQL
      $sql = "INSERT INTO contato (nome, telefone, email, cod_grupo, detalhes, foto, cod_usuario) 
              VALUES ('$nome', '$telefone', '$email', '$cod_grupo', '$detalhes', '$foto', '$id_usuario')";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou?
      if ($retorno == true) {

        echo "<script>
                alert('Cadastrado com Sucesso!');
                location.href='listar.php';
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

<h1>Cadastrar Contato</h1>

<form method="POST">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" maxlength="100" required class="form-control">
  </div>

  <div class="form-group">
    <label>Telefone</label>
    <input type="text" name="telefone" maxlength="50" required class="form-control">
  </div>

  <div class="form-group">
    <label>E-Mail</label>
    <input type="email" name="email" maxlength="100" class="form-control">
  </div>

  <div class="form-group">
    <label>Foto</label>
    <input type="text" name="foto" class="form-control">
  </div>

  <div class="form-group">
    <label>Grupo</label>
    <select name="cod_grupo" required class="form-control">
      <option value="">Selecione</option>

      <?php

        // Remove mensagem de alerta
        error_reporting(1);

        include_once "../conexao_bd.php";

        // Cria comando SQl
        $sql = "SELECT * 
                FROM grupo";

        // Executa no BD
        $retorno = $conexao->query($sql);

        // Deu erro?
        if ($retorno == false) {
          echo $conexao->error;
        }

        while ($registro = $retorno->fetch_array()) {
          
          $id = $registro["id"];
          $nome = $registro["nome"];

          echo "<option value='$id'>$nome</option>";

        }

      ?>

    </select>
  </div>

  <div class="form-group">
    <label>Detalhes</label>
    <textarea name="detalhes" class="form-control"></textarea>
  </div>

  <button class="btn btn-primary" type="submit">Salvar</button>
  
</form>

  <?php include_once "../rodape.php"; ?>