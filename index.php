<?php
	$pdo = new PDO('mysql:host=localhost;dbname=aula', 'root', '');

	if(isset($_GET['delete'])){
		$id = (int)$_GET['delete'];
		$pdo->exec("DELETE FROM alunos WHERE id=$id");
		echo '<script>alert("Aluno com o id '.$id.' deletado com sucesso!");</script>';
	}

	if(isset($_POST['nome'])){
		$sql = $pdo->prepare("INSERT INTO alunos VALUES (null, ?, ?, ?)");
		$sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['telefone']));
		echo "<script>alert('Aluno: ".$_POST['nome']."! Foi matriculado com sucesso! :)')</script>";
	}

?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body>
        <h2>Matricula de Alunos de SI</h2>
        <form method="post">
            <input type="text" name="nome" placeholder="Digite o nome...">
            <input type="numeric" name="cpf" placeholder="Digite o CPF...">
            <input type="numeric" name="telefone" placeholder="Digite o telefone...">
            <input type="submit" value="Enviar">
        </form>

        <?php
            $sql = $pdo->prepare("SELECT * FROM alunos");
            $sql->execute();

            $fetchUsuarios = $sql->fetchAll();

            echo '<h2>Alunos Matriculados - '.count($fetchUsuarios).'</h2>';

            if($fetchUsuarios){
                foreach ($fetchUsuarios as $key => $value) {
                    echo '<a class="btnDelete" href="?delete='.$value['id'].'">(DELETAR) </a>
                          <a class="btnUpdate" href="update.php?id='.$value['id'].'">(ATUALIZAR) </a>
                                NOME: '.$value['nome'].' | CPF: '.$value['cpf'].' | TELEFONE: '.$value['telefone'].'';
                    echo '<hr>';  
                }
            }else{
                echo '<p class="aviso">Sem alunos matriculados :(</p>';
            }
        ?>
        <?php
            include "./gerando_xml.php";

            echo "<p class='alert-xml'>XML está sendo gerado automaticamente :)</p>"
        ?>
    </body>
</html>