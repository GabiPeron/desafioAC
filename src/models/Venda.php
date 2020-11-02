<?php

include '../database/Conexao.php';

class Venda {
    function __construct($produto, $quantidade, $valorUnitario) {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->valorUnitario = $valorUnitario;
        $this->valorTotal = $this->quantidade * $this->valorUnitario;
    }

    public function save() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        INSERT INTO vendas (produto_id, quantidade, valor_unitario, valor_total)
        VALUES ("'.$this->produto.'", '.$this->quantidade.', '.$this->valorUnitario.', '.$this->valorTotal.');
        ';

        $queryUltimaVenda = 
        '
        UPDATE produtos
        SET ultima_venda = CURDATE()
        WHERE id = '.$this->produto.';
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $conexao->query($queryUltimaVenda);

        $conexao->closeConexao();

        return true;
    }

    public static function all() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        SELECT vendas.id,
               produtos.descricao,
               vendas.quantidade,
               vendas.valor_unitario,
               vendas.valor_total
          FROM vendas
          JOIN produtos
            ON vendas.produto_id = produtos.id;
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $vendas = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $vendas;
    }

    public static function updateValor($id, $valor) {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 
        '
        UPDATE produtos
        SET valor = '.$valor.'
        WHERE id = '.$id.';
        ';

        $conexao->setConexao();

        $conexao->query($query);

        $conexao->closeConexao();

        return true;
    }

    public static function count() {
        $conexao = new Conexao('desafioac', 'localhost', 'root', 'root');

        $query = 'SELECT COUNT(id) FROM vendas';

        $conexao->setConexao();

        $conexao->query($query);

        $vendas = $conexao->getArrayResults();

        $conexao->closeConexao();

        return $vendas;
    }
}

?>