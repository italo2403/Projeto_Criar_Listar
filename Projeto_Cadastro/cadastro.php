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