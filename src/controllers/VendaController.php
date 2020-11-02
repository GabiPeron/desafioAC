<?php

include '../models/Venda.php';

session_start();

$controller = new VendaController();

if (isset($_POST)) {
    $controller->validate();

    return $controller->create();
}

class VendaController {
    public function validate() {
        $obrigatorios = [];

        if (!$_REQUEST['produto']) {
            array_push($obrigatorios, 'Produto');
        }

        if (!$_REQUEST['quantidade']) {
            array_push($obrigatorios, 'Quantidade');
        }

        if (!$_REQUEST['valorUnitario']) {
            array_push($obrigatorios, 'Valor unitário');
        }

        if (!empty($obrigatorios)) {
            header("Location: {$_SERVER['HTTP_REFERER']}");

            exit;
        }

        return true;
    }

    public function create() {
        $venda = new Venda(
            $_POST['produto'],
            $_POST['quantidade'],
            $_POST['valorUnitario']
        );

        if (isset($_POST['atualizar'])) {
            Venda::updateValor($_POST['produto'], $_POST['valorUnitario']);
        }

        $venda->save();

        $_SESSION['success'] = true;

        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}

?>