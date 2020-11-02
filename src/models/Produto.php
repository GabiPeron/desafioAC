<?php

include '../database/Conexao.php';

class Produto {
    function __construct($descricao, $estoque, $codigo, $valor) {
        $this->descricao = $descricao;
        $this->estoque = $estoque;
        $this->codigo = $codigo;
        $this->valor = $valor;
    }

    public function save() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        INSERT INTO produtos (descricao, estoque, codigo, valor, deleted)
        VALUES ("'.$this->descricao.'", '.$this->estoque.', '.$this->codigo.', '.$this->valor.', false);
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $conexao->closeConexao();

        return true;
    }

    public static function all() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        SELECT * FROM produtos;
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $produtos = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $produtos;
    }

    public static function find($id) {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        SELECT * FROM produtos WHERE id = '.$id.';
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $produto = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $produto;
    }

    public function update($id) {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        UPDATE produtos
        SET descricao = "'.$this->descricao.'", estoque = '.$this->estoque.', codigo = '.$this->codigo.', valor = '.$this->valor.'
        WHERE id = '.$id.';
        ';
        
        $conexao->setConexao();

        $conexao->query($query);

        $conexao->closeConexao();

        return true;
    }
}

?>