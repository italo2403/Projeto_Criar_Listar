<?php
session_start();

include_once './conexao.php'


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/consulta.css">
    <title>Pesquisar Usuários</title>
</head>
<body>

    <h3 class="pes">Pesquisar Usuários</h3>
    <hr>
    <a href="index.html">Página Inicial</a>
        <!--
            Busando os dados diretamente do Banco
        -->
        <?php
       $dados=  filter_input_array(INPUT_POST, FILTER_DEFAULT);
       

    ?>

<div class="container">
<div class="content">
<form method="post" class="d-flex justify-content-center">
    <?php

    $texto_pesquisar = "";
if (isset($dados['pesquisar'])) {
    $texto_pesquisar = $dados['pesquisar'];
}
    ?>

<label for="" class="d-flex justify-content-center">Pesquisar Pelo Nome: </label>
<input type="text" name="pesquisar" placeholder="Insira uma letra ou Nome do Usuário" value="<?php echo $texto_pesquisar;?>">
<input type="submit" class="buscar" value="Pesquisar" name="BuscarUsuario">

</form>
<?php

$nome = "";

    if (!empty($dados['BuscarUsuario']) && !empty($dados['pesquisar'])) {
        $nome = "%" . $dados['pesquisar'] . "%";
    }
$query_usuarios = "SELECT * FROM (
                       SELECT usr.id, usr.nome, usr.idade, usr.nascimento, usr.endereco, usr.cpf, usr.sexo, usr.identidade, usr.est_civi,
                       perf.pai, perf.mae, perf.formacao, perf.expe1, perf.expe2, perf.just
                       FROM usuarios usr
                       LEFT JOIN perfil perf ON perf.id = usr.id
                       WHERE usr.nome LIKE :nome
                       UNION
                       SELECT usr.id, usr.nome, usr.idade, usr.nascimento, usr.endereco, usr.cpf, usr.sexo, usr.identidade, usr.est_civi,
                       perf.pai, perf.mae, perf.formacao, perf.expe1, perf.expe2, perf.just
                       FROM usuarios usr
                       RIGHT JOIN perfil perf ON perf.id = usr.id
                       WHERE usr.nome LIKE :nome
                   ) AS temp
                   ORDER BY id ASC";

$resultado_usuarios = $conn->prepare($query_usuarios);
$resultado_usuarios->bindParam(':nome', $nome);
$resultado_usuarios->execute();
if ($resultado_usuarios->rowCount() > 0) {
while ($row_usuarios = $resultado_usuarios->fetch(PDO::FETCH_ASSOC)) {
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
   
}
}
else {
    echo "Nenhum resultado encontrado.";
}

?>
<button class="imprimir" onclick="window.print()">Imprimir</button>

        

</div>
</div>

    

</body>
</html>