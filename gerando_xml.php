<?php

    $pdo = new PDO('mysql:host=localhost;dbname=aula', 'root', '');

    $sql = $pdo->query("SELECT * FROM alunos");

    $xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
    $xml .= "<alunos>\n";
 
    while($reg = $sql->fetchObject()){
        $xml .= "\t<aluno>\n";
        $xml .= "\t\t<id>$reg->id</id>\n";
        $xml .= "\t\t<nome>$reg->nome</nome>\n";
        $xml .= "\t\t<cpf>$reg->cpf</cpf>\n";
        $xml .= "\t\t<telefone>$reg->telefone</telefone>\n";
        $xml .= "\t</aluno>\n";
    }
    $xml .= "</alunos>";

    $ponteiro = fopen('backup.xml', 'w');
    fwrite($ponteiro, $xml);

    $ponteiro = fclose($ponteiro);

?>