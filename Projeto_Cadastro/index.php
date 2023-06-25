<?php
include_once './conexao.php'
?>
<!DOCTYPE html>

<html> 
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="author" content="Ítalo Nunes">
    <link rel="stylesheet" href="./style/index.css">
    <title>Cadastro de Pessoas</title><!--Essa tag é onde inserimos o título da nossa
    Página, ela será responsável por dizer ao usuário o lugar que ele acessou. -->
<head>

</head>

<body>
        <h1 class="text-center"> Bem Vindo</h1>
        <!--Tags de títulos usadas no corpo do HTML são os Hs, onde 
        estão ordenados de h1 até h6 e essas tags precisam ser abertas e fechadas em suas 
    declarações. -->
            <hr> <!--Elemento novo do HTML e siginifica horizotal row, representa 
                uma quebra de linha temática entre elementos HTML. O <hr> é exibido como 
                uma linha horizontal separando os conteúdos de uma página web -->
                <a href="index.html">Página Inicial</a>
        <h3 class="text-center">Ficha de Cadastramento</h3>    <!--Mesmo Padrão do H1, mas com letras menores--> 
        
        <hr>
        <form action="" method="post">

        <!--Criando PHP dentro da própria página HTML-->

    <?php
    //O filter_input_array vai ficar responsável por buscar todos os dados dos inputs e criar um array para salvar
        $dados= filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump serve para verificar se está tudo ok, se estiver, retornará NULL
       // var_dump($dados);

        /*Contudo, podemos melhorar o código e deixar para apenas quando ele estiver solicitado mostrar os 
        dados, mudando a posição do var_dump dentro de um if*/
        if(!empty($dados['cadastrar'])){
            //var_dump($dados);
            $query_usuarios = "INSERT INTO usuarios(nome,idade, nascimento, endereco, cpf, sexo,identidade, est_civi) VALUES(:nome,:idade, :nascimento, :endereco, :cpf, :sexo,:identidade, :est_civi)";

           $add_usuarios= $conn->prepare($query_usuarios);
            $add_usuarios->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':idade', $dados['idade'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':nascimento', $dados['nascimento'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':endereco', $dados['endereco'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':sexo', $dados['sexo'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':identidade', $dados['identidade'], PDO::PARAM_STR);
            $add_usuarios->bindParam(':est_civi', $dados['est_civi'], PDO::PARAM_STR);

            $add_usuarios->execute();
            if($add_usuarios->rowCount()) {
                header("Location:index.html ");
            } else{
                header("Location:errono.php ");
            }
            $query_perfil="INSERT INTO perfil(pai, mae, formacao, expe1, expe2, just) VALUEs(:pai, :mae,:formacao,:expe1,:expe2,:just)";
   $add_perfil=$conn->prepare($query_perfil);
   $add_perfil->bindParam(':pai', $dados['pai'], PDO::PARAM_STR);
   $add_perfil->bindParam(':mae', $dados['mae'], PDO::PARAM_STR);
   $add_perfil->bindParam(':formacao', $dados['formacao'], PDO::PARAM_STR);
   $add_perfil->bindParam(':expe1', $dados['expe1'], PDO::PARAM_STR);
   $add_perfil->bindParam(':expe2', $dados['expe2'], PDO::PARAM_STR);
   $add_perfil->bindParam(':just', $dados['just'], PDO::PARAM_STR);

            $add_perfil->execute();
            if($add_perfil->rowCount()) {
                header("Location:index.html ");
            } else{
                header("Location:errono.php ");
            }
            
        }
     
    ?>
       <label>Insira seu Nome</label><!--Especifica qual o "rótulo" do input-->
        <input type="text" name="nome" placeholder="Não abrevie o nome ou coloque apelidos"><!--Especifica qual o tipo de entrada que faremos no nosso arquivo, aqui usaremos de text, onde deixamos
        claro qual o tipo de escolhemos-->
        <!--Inserindo o outros valores-->
        <label for="">Idade</label>
        <input type="text" name="idade" placeholder="34" >
        <label for="">Data Nascimento</label>
        <input type="text" name="nascimento" placeholder="34" >
        <label for="">Endereço</label>        
        <input type="text" name="endereco" placeholder="Av José dos Anjos 25">
        <label for="">CPF</label>
        <input type="text" name="cpf" placeholder="Não coloque ponto ou travessão">
        <label for="">Sexo</label>
        <input type="text" name ="sexo" placeholder="M ou F" >
        <label for="">RG</label>
        <input type="text" name="identidade" placeholder="Não coloque ponto ou vírgula" >
        <label for="">Estado Cívil</label>
        <input type="text" name="est_civi"  placeholder="est_civi" >
        <hr>
        <h3>Filiação</h3>
        <label for="">Pai</label>
        <input type="text" name="pai" placeholder="Israel Nunes">
        <label for="">Mãe</label>
        <input type="text" name="mae" placeholder="Maria José" >
        <hr>
        <h3>Escolaridade</h3>
        <label for="">Formação</label>
        <input type="text" name="formacao" >
        <hr>
        <h3>Experiência de Trabalho</h3>
        <label for="">1°</label>
        <input type="text" name="expe1">
        <label for="">2°</label>
        <input type="text" name="expe2">
        <hr>
        <h3>Motivo </h3>
        <label for="">Descrever</label>
        <textarea name="just" id="" cols="30" rows="5" placeholder="Insira de forma breve"></textarea>
        <input type="submit" name="cadastrar" value="cadastrar">
        </form>
</body>

</html>
