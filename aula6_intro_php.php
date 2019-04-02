<!doctype html>
<html>
	<head>
		<title>Aula 6 - PHP</title>
		<meta charset="utf-8">
	</head>
	<body>

		<?php
			$nome = "André";
		?>

		Olá, meu nome é: <b>
		<?php echo $nome; ?></b>!


		<?php

			error_reporting(1);

			$qtd = $_GET["qtd"];

			if ($qtd == NULL) {
				echo "<br>Faltando parâmetro!";
			}

			echo "<ul>";
			for ($i=1; $i<=$qtd; $i++) {
				echo "<li>item $i</li>";
			}
			echo "</ul>";


			$alunos = array("aluno1"=>"joao", "maria", "Zé");
			array_push($alunos, "antônio");

			echo "<ul>";
			foreach ($alunos as $indice => $aluno) {
				echo "<li>$indice - $aluno</li>";
			}
			echo "</ul>";

		?>


	</body>
</html>