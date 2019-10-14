<?php

class ProdutoCRUD {

    // Classe que conecta com o DB e mantém a conexão
    private $Connection;

    // Ao iniciar a classe já conecta com o DB
    function __construct ($host, $databasename, $username, $password) {
        try {
            $this -> Connection = new PDO ('mysql:host='.$host.';dbname='.$databasename, $username, $password);
            $this -> Connection -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // não tenho ctz pra que que é
            $this -> Connection -> exec ('set names utf8');                                    // não tenho ctz pra que que é
        }
        catch(PDOException $Erro) {
            echo "Erro de Conexão: " . $Erro -> getMessage() . "\n";
        }
    }

    // Ao encerrar o objeto deleta a classe da conexao com o DB
    function __destruct () {
        unset($this -> Connection);
    }

    // Insere um item no banco de dados
    public function create ($tipo, $valor, $descricao, $imagem) {
        try {
            $produto = array('tipo' => $tipo,'valor' => $valor,'descricao' => $descricao, 'imagem' => $imagem);
            $create = $this -> Connection -> prepare('INSERT INTO produtos_eletronicos (tipo,valor,descricao,imagem) VALUES (:tipo,:valor,:descricao,:imagem)');
            $create -> execute($produto);
            return $create;
        }
        catch (PDOException $Erro) {
            echo "Erro de Conexão: " . $Erro -> getMessage() . "\n";
            return;
        }
    }

    // Lê todos os itens do banco de dados
    public function read () {
        try {
            $read = $this -> Connection -> prepare('SELECT * FROM produtos_eletronicos ORDER BY id_eletronico DESC');
            $read -> execute();
            return $read -> fetchAll();
        }
        catch (PDOException $Erro) {
            echo "Erro de Conexão: " . $Erro -> getMessage() . "\n";
            return;
        }
    }

    // Atualiza um item no banco de dados
    public function update ($id, $tipo, $valor, $descricao, $imagem) {
        try {
            $produto = array(':id' => $id, ':tipo'=> $tipo, ':valor'=> $valor, ':descricao'=> $descricao, ':imagem' => $imagem);
            $update = $this -> Connection -> prepare('UPDATE produtos_eletronicos SET tipo = :tipo, valor = :valor, descricao = :descricao, imagem = :imagem WHERE id_eletronico = :id');
            $update -> execute($produto);
            return $update;
        }
        catch (PDOException $Erro) {
            echo "Erro de Conexão: " . $Erro -> getMessage() . "\n";
            return;
        }
    }

    // Remove um item no banco de dados
    public function delete ($id) {
        try {
            $produto = array('id' => $id);
            $delete = $this -> Connection -> prepare('DELETE FROM produtos_eletronicos WHERE id_eletronico = :id');
            $delete -> execute($produto);
            return $delete;
        }
        catch (PDOException $Erro) {
            echo "Erro de Conexão: " . $Erro -> getMessage() . "\n";
            return;
        }
    }

}

?>
