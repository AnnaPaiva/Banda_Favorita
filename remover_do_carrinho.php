<?php
session_start();

if (isset($_GET['id'])) {

    $id_remover = $_GET['id'];

    if (isset($_SESSION['carrinho'])) {

        //Percorrer os produtos para encontrar o que tem o id a remover

        foreach ($_SESSION['carrinho'] as $key => $produto) {

            if ($produto['id'] == $id_remover) {
                //remove o produto do carrinho
                unset($_SESSION['carrinho'][$key]);
                //reorgaizar índices para evitar burcaos no arrya
                $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
                break; //Sair do loop depois de remover o produto
            }
        }
    }
}

//redirecionar de volta para a página do carrinho
header('Location: carrinho.php');
exit;
