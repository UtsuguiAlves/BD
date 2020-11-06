<?php
    require("../domain/pessoa.php");
	header("Content-type: application/json");
	$pd = new PessoaDAO();

	//Criados os vetores PUT e DELETE que não existiam.
	$_DELETE = array();
	$_PUT = array();
	if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
		parse_str(file_get_contents('php://input'), $_DELETE);
	}
	if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
		parse_str(file_get_contents('php://input'), $_PUT);
	}

	if(!empty($_GET)){
		if($_GET["id"]=="0") {
			echo json_encode($pd->readAll());
		} else {
			echo json_encode($pd->read($_GET["id"]));
		}
	}
	
	if(!empty($_POST)){
		$pessoa = new Pessoa();
		$pessoa->setNome($_POST["nome"]);
		$pessoa->setTelefone($_POST["telefone"]);
		echo json_encode($pd->create($pessoa));
	}
	if(!empty($_PUT)){
		$pessoa = new Pessoa();
		$pessoa->setIdPessoa($_PUT["id"]);
		$pessoa->setNome($_PUT["nome"]);
		$pessoa->setTelefone($_PUT["telefone"]);
		echo json_encode($pd->update($pessoa));
	}
	if(!empty($_DELETE)){
		$pessoa = new Pessoa();
		$pessoa->setIdPessoa($_DELETE["id"]);
		$pessoa->setNome($_DELETE["nome"]);
		$pessoa->setTelefone($_DELETE["telefone"]);
		echo json_encode($pd->DELETE($pessoa));
	}
?>
	

