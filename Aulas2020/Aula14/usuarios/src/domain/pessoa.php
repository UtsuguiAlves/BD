<?php
	require("conexao.php");
	class Pessoa{
		//Atributos
		var $idPessoa;
		var $nome;
		var $telefone;
		
		//Métodos GETs && SETs
		function getIdPessoa(){
			return $this->idPessoa;
		}
		function setIdPessoa($idPessoa){
			$this->idPessoa = $idPessoa;
		}
		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome = $nome;
		}
		function getTelefone(){
			return $this->telefone;
		}
		function setTelefone($telefone){
			$this->telefone = $telefone;
		}
	}
	
	class PessoaDAO{
		function create($pessoa){
			$resultado = array();
            $query = "INSERT INTO pessoas VALUES (default,'".$pessoa->getNome()."')";
            try{
                $con = new Conexao();
                if(Conexao::getInstancia()->exec($query) >= 1){
                    $resultado["id"] = Conexao::getInstancia()->lastInsertId();
                    $resultado["nome"] = $pessoa->getNome();
                    if($pessoa->getTelefone()!=null){
                        $resultado["telefone"] = $pessoa->getTelefone();
                        $query = "INSERT INTO telefones VALUES (".$resultado["id"].",'".$resultado["telefone"]."')";
                        Conexao::getInstancia()->exec($query);
                    }
                }
                $con = null;
            } catch (PDOException $e) {
                $resultado["erro"] = "Erro ao conectar ao BD";
            }
            return $resultado;
		}
		function readAll(){
			$pessoas = [];
			$query = "SELECT * FROM vw_pessoas";
			try{
				$con = new Conexao();
				$resultSet = Conexao::getInstancia()->query($query);
				while($linha = $resultSet->fetchObject()){
					$pessoa = new Pessoa();
					$pessoa->setIdPessoa($linha->id_pessoa);
					$pessoa->setNome($linha->nome);
					$pessoa->setTelefone($linha->telefone);
					$pessoas[] = $pessoa;
				}
				$con = null;
			}catch(PDOException $e){
				$pessoas["erro"] = "Erro de conexão com BD";
			}
			return $pessoas;
		}
		function read($id){
			$pessoas = [];
			$query = "SELECT * FROM vw_pessoas where id_pessoa = $id";
			try{
				$con = new Conexao();
				$resultSet = Conexao::getInstancia()->query($query);
				while($linha = $resultSet->fetchObject()){
					$pessoa = new Pessoa();
					$pessoa->setIdPessoa($linha->id_pessoa);
					$pessoa->setNome($linha->nome);
					$pessoa->setTelefone($linha->telefone);
					$pessoas[] = $pessoa;
				}
				$con = null;
			}catch(PDOException $e){
				$pessoas["erro"] = "Erro de conexão com BD";
			}
			return $pessoas;
		}
		function update($pessoa) {
			$resultado = [];
			$id = $pessoa->getIdPessoa();
			$nome = $pessoa->getNome();
			$telefone = $pessoa->getTelefone();
			$query = "UPDATE pessoas SET nome = '$nome' WHERE id_pessoa = $id";
			try{
				$con = new Conexao();
				$status = Conexao::getInstancia()->prepare($query);
				if($status->execute()) {
					$resultado = $pessoa;
					if($pessoa->getTelefone() != null)
					$query = "UPDATE telefones SET telefone = '$telefone' WHERE telefone = $id";
					$status = Conexao::getInstancia()->prepare($query)->execute();
				}
				$con = null;
			}catch(PDOException $e) {
				$resultado["erro"] = "Erro de conexão com o BD";
			}
			return $resultado;
		}
		function del($id) {
			$resultado = [];
			$query = "DELETE FROM pessoas WHERE id_pessoa = $id"
			try{
				$con = new Conexao();
				if(Conexao::getInstancia()->exec($query)>=1) {
					$resultado["msg"] = "Pessoa Apagada";
				}
				$con = null;
			}catch(PDOException $e) {
				$resultado["erro"] = "Erro de conexão com o BD"
			}
			return $resultado;
		}
	}
	