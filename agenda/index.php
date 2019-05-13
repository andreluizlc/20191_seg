<?php

// Não exibe mensagemde alerta
error_reporting(1);

// Clicou em enviar?
if ($_POST != NUll) {

	// Conecta ao BD
	include_once "conexao_bd.php";

	// Obtém dados do formulário
	$login = addslashes($_POST["login"]);
	$senha = addslashes($_POST["senha"]);

	// criptografa a senha com MD5
	$senha = md5($senha);

	// Cria comando SQL
	$sql = "SELECT * 
			FROM usuario 
			WHERE login = '$login' 
			AND senha = '$senha'";

	// Executa no BD
	$retorno = $conexao->query($sql);

	// Deu erro?
	if ($retorno == false) {
		echo $conexao->error;
		exit;
	}

	// Encontrou registro?
	if ($registro = $retorno->fetch_array()) {

		// Obtém dados do Usuário Logado
		$id = $registro["id"];
		$nome = $registro["nome"];

		// Inicializa da sessão
		session_start();

		// Cria variáveis na sessão
		$_SESSION["logado"] = "ok";
		$_SESSION["id_usuario"] = $id;
		$_SESSION["nome_usuario"] = $nome;

		// Vai para a página principal
		header("Location: contato/listar.php");

	} else {

        echo "<script>
                alert('Login ou Senha Inválida!');
              </script>";

	}

}

?>

<?php include_once "topo_login.php"; ?>

<h1>Acesso Restrito</h1>

<form method="post">
	
	<div class="form-group">
		<label>Login</label>
		<input type="text" name="login" class="form-control" required>
	</div>

	<div class="form-group">
		<label>Senha</label>
		<input type="password" name="senha" class="form-control" required>
	</div>

	<button type="submit" class="btn btn-primary">Entrar</button>

</form>

<?php include_once "rodape.php"; ?>