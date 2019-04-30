<?php

  // Remove mensagem de alerta
  error_reporting(1);


  // Clicou em enviar? O POST Existe?
  if ($_POST != NULL) {

    include_once "../conexao_bd.php";

    // Obtém ID via GET
    $id = $_GET["id"];

    // Obtem dados do POST
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $cod_grupo = $_POST["cod_grupo"];
    $detalhes = $_POST["detalhes"];
    $foto = $_POST["foto"];

    //addslashes() <- evita SQL Injection quado for fazer um SELECT

    // Valida campos obrigatórios
    if ($nome != "" && $telefone != "" && $cod_grupo != "" ) {

      // Cria o comando SQL
      $sql = "UPDATE contato 
              SET nome = '$nome', 
                  telefone = '$telefone', 
                  email = '$email', 
                  foto = '$foto', 
                  cod_grupo = '$cod_grupo', 
                  detalhes = '$detalhes' 
              WHERE id = $id";

      // Executa no BD
      $retorno = $conexao->query($sql);

      // Executou?
      if ($retorno == true) {

        echo "<script>
                alert('Atualizado com Sucesso!');
                location.href='listar.php';
              </script>";

      } else {

        echo "<script>
                alert('Erro ao Atualizar!');
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

<h1>Editar Contato</h1>

<form method="POST">

  <div class="form-group">
    <label>Nome</label>
    <input type="text" name="nome" maxlength="100" required class="form-control" value="<?php echo $nome; ?>">
  </div>

  <div class="form-group">
    <label>Telefone</label>
    <input type="text" name="telefone" maxlength="50" required class="form-control" value="<?php echo $telefone; ?>">
  </div>

  <div class="form-group">
    <label>E-Mail</label>
    <input type="email" name="email" maxlength="100" class="form-control" value="<?php echo $email; ?>">
  </div>

  <div class="form-group">
    <label>Foto</label>
    <input type="text" name="foto" class="form-control" value="<?php echo $foto; ?>">
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

          if ($cod_grupo == $id) {
            echo "<option selected value='$id'>$nome</option>";
          }
          else {
            echo "<option value='$id'>$nome</option>";
          }

        }

      ?>

    </select>
  </div>

  <div class="form-group">
    <label>Detalhes</label>
    <textarea name="detalhes" class="form-control"><?php echo $detalhes; ?></textarea>
  </div>

  <button class="btn btn-primary" type="submit">Salvar</button>
  
</form>

  <?php include_once "../rodape.php"; ?>