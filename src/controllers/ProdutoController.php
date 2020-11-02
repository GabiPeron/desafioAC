<?php

include '../models/Produto.php';

session_start();

$controller = new ProdutoController();

if (isset($_POST)) {
    if (isset($_POST['method'])) {
        if ($_POST['method'] == 'PATCH') {
            $controller->validate();

            return $controller->update();
        }

        if ($_POST['method'] == 'DELETE') {
            return $controller->delete($_GET['produto']);
        }

        if ($_POST['method'] == 'RESTORE') {
            return $controller->restore($_GET['produto']);
        }
    }

    $controller->validate();

    return $controller->create();
}

class ProdutoController {
    public function validate() {
        $obrigatorios = [];

        if (!$_REQUEST['descricao']) {
            array_push($obrigatorios, 'Descrição');
        }

        if (!$_REQUEST['estoque']) {
            array_push($obrigatorios, 'Estoque');
        }

        if (!$_REQUEST['codigo']) {
            array_push($obrigatorios, 'Código de barras');
        }

        if (!$_REQUEST['valor']) {
            array_push($obrigatorios, 'Valor unitário');
        }

        if (!empty($obrigatorios)) {
            header("Location: {$_SERVER['HTTP_REFERER']}");

            exit;
        }

        return true;
    }

    public function index() {
        $produtos = Produto::all();

        return $produtos;
    }

    public function create() {
        $produto = new Produto(
            $_POST['descricao'],
            $_POST['estoque'],
            $_POST['codigo'],
            $_POST['valor']
        );

        $produto->save();

        $_SESSION['success'] = true;

        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    public function update() {
        $produto = new Produto(
            $_POST['descricao'],
            $_POST['estoque'],
            $_POST['codigo'],
            $_POST['valor']
        );

        $produto->update($_GET['produto']);

        $_SESSION['success'] = true;

        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    public function delete($id) {
        Produto::delete($id);

        $_SESSION['success'] = true;

        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    public function restore($id) {
        Produto::restore($id);

        $_SESSION['success'] = true;

        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}

?>