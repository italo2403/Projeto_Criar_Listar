<?php
session_start(); //iniciado a sessão do banco

include_once './conexao.php'

?>

<!DOCTYPE html>

<html> 
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="author" content="Ítalo Nunes">
    <link rel="stylesheet" href="./style/listar.css">
    <title>Listagem de Usuários</title><!--Essa tag é onde inserimos o título da nossa
    Página, ela será responsável por dizer ao usuário o lugar que ele acessou. -->
<head>

</head>
<body>

            <h1>Listagem de Usuários</h1>
            <a href="index.html">Página Inicial</a> 
            <hr>
            <h3>Lista em Ordem Crescente</h3>
            <div class="user-info">
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
  
    $query_usuarios = "SELECT usr.id, usr.nome, usr.idade, usr.nascimento, usr.endereco, 
    usr.cpf, usr.sexo, usr.identidade, usr.est_civi,
    perf.pai, perf.mae, perf.formacao, perf.expe1, perf.expe2, perf.just
    FROM usuarios usr
    LEFT JOIN perfil perf ON perf.id = usr.id
    UNION
    SELECT usr.id, usr.nome, usr.idade, usr.nascimento, usr.endereco, usr.cpf, usr.sexo, usr.identidade, usr.est_civi,
    perf.pai, perf.mae, perf.formacao, perf.expe1, perf.expe2, perf.just
    FROM usuarios usr
    RIGHT JOIN perfil perf ON perf.id = usr.id
    ORDER BY id ASC";


    
$resultado_usuarios=$conn->prepare($query_usuarios);

$resultado_usuarios->execute();
while ($row_usuarios = $resultado_usuarios->fetch(PDO::FETCH_ASSOC)){
    //var_dump($row_usuarios);
   
    extract($row_usuarios);
   
    echo "Id do Usuário: $id <br>";
    echo "Nome do Usuário: $nome <br>";
    echo "Idade do Usuário: $idade <br>";
    echo "Data Nascimento do Usuário: $nascimento <br>";
    echo "Endereço do Usuário: $endereco <br>";
    echo "CPF do Usuário: $cpf <br>";
    echo "Sexo do Usuário: $sexo <br>";
    echo "RG do Usuário: $identidade <br>";
    echo "Estado Civil do Usuário: $est_civi <br>";
    echo "Pai do Usuário: $pai <br>";
    echo "Mãe do Usuário: $mae <br>";
    echo "Formação do Usuário: $formacao <br>";
    echo "Experiência 1° do Usuário: $expe1 <br>";
    echo "Experiência 1° do Usuário: $expe2 <br>";
    echo "Motivo  1° do Usuário: $just <br>";
   echo "<hr>";

}
?>
<button class="imprimir" onclick="window.print()">Imprimir</button>
            </div>
<hr>


</body>
</html>