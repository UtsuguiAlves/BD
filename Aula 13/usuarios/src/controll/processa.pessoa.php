<?php
    require("../domain/pessoa.php");

    $pessoas = [];

    $pessoa = new Pessoa();
    $pessoa-> setIdPessoa(1);
    $pessoa-> setNome("Matheus Sousa");
    $pessoa-> setTelefone("19 99634-7502");
    $pessoas[0] = $pessoa;

    $pessoa = new Pessoa();
    $pessoa-> setIdPessoa(2);
    $pessoa-> setNome("Maria Fernandes");
    $pessoa-> setTelefone("19 9932-7802");
    $pessoas[1] = $pessoa;

    $pessoa = new Pessoa();
    $pessoa-> setIdPessoa(3);
    $pessoa-> setNome("Pualinho Lanches");
    $pessoa-> setTelefone("19 99790-3512");
    $pessoas[2] = $pessoa;

    echo json_encode($pessoas);
    /*$p1 = new Pessoa();
    $p1->setIdPessoa(1);
    $p1->setNome("André Silva");
    $p1->setTelefone("19 99877-8787");

    echo $pessoa->getIdPessoa()."<br>";
    echo $pessoa->getNome()."<br>";
    echo $pessoa->getTelefone()."<br>";*/