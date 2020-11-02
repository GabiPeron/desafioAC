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
        SELECT produtos.id,
               produtos.descricao,
               produtos.valor,
               produtos.estoque,
               produtos.ultima_venda,
               SUM(vendas.valor_total) 
          FROM produtos
     LEFT JOIN vendas
            ON vendas.produto_id = produtos.id 
         WHERE deleted IS FALSE
      GROUP BY produtos.id;
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $produtos = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $produtos;
    }

    public static function deleted() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        SELECT * FROM produtos WHERE deleted IS TRUE;
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

    public static function count() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 'SELECT COUNT(id) FROM produtos';

        $conexao->setConexao();

        $conexao->query($query);

        $produto = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $produto;
    }

    public static function countVendas() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 'SELECT COUNT(id) FROM vendas';

        $conexao->setConexao();

        $conexao->query($query);

        $vendas = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $vendas;
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

    public static function delete($id) {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        UPDATE produtos
        SET deleted = true
        WHERE id = '.$id.';
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $conexao->closeConexao();

        return true;
    }

    public static function restore($id) {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        UPDATE produtos
        SET deleted = false
        WHERE id = '.$id.';
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $conexao->closeConexao();

        return true;
    }
}

?>