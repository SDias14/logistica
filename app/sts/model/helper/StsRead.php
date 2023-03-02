<?php

namespace Sts\model\helper;
use PDO;

/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
    header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
   //  die("Erro 404 - Página não encontrada");

}


/**
 * Helper para ler dados do banco de dados
 * @package model
 * @author samuel <samueld2014@gmail.com>
 * @version 1.0
 * extends model StsConn
 *http://localhost/logistica/app/sts/model/StsHome.php(caso tente acessar diretamente o arquivo)
 */

class StsRead extends StsConn{//ponto de entrada do stsConnect


    /*** @var string $select - armazena a query que deve ser executada no banco de dados*/
    private string $select;
    
    /*** @var array $result - armazena o resultado da query*/
    private array|null $result = [];

    /**
     * @var object $query - armazena a query preparada. */
    private object $query;

    /*** @var object $connection - armazena a conexao com o banco de dados.*/

    private object $connection;

    /**
     * funcao para retornar o resultado da query preparada e executada
     */
    public function getResult(){
        return $this->result; //saida no model. este metodo que deve ser instanciando.
    }

    /**
     * metodo para fazer a leitura no banco de dados
     * @param string $table - nome da tabela que deve ser lida
     * @param mixed $terms - termos da query
     * @param string $parseString - string para ser executada no banco de dados
     */
    public function execRead(string $table, $terms = null, $parseString = null){
  
        /**
         * 1° passo - faz a leitura no banco com a query select.
         * teste para verificar se a função está recebendo o nome da tabela quando for instanciada
         *  var_dump($table);
         */
       
         /**
          * @var mixed $this->select - armazena a query que deve ser executada no banco de dados
          */
          $this->select = "SELECT * FROM {$table}";

        /**
         * teste para verificar se a query está sendo montada corretamente
            * var_dump($this->select);
         */

        /**
         *7° vai chamar o metodo execQuery para executar a query
         */
         $this->execQuery();
          
    }

    /**
     * metodo para executar a query. vai chamar o metodo connect para conectar com o banco de dados, onde o metodo connect tem a query preparada.
     */
    private function execQuery(){
        
        
        $this->connect();//5° passo - chama o metodo connect para conectar com o banco de dados e preparar a query

        /**
         * 6° passo - executa a query e armazena o resultado na variavel $this->result, usando o metodo fetchAll para retornar todos os dados da tabela
         */
        try{
            $this->query->execute();
            $this->result = $this->query->fetchAll(); //array associativo

        }catch (\Exception $e){//tratamento de erro
            $this->result = null;
            echo "Erro ao ler dados do banco de dados.";
        }
        

    }

    /**
     * metodo para conectar com o banco de dados
     */
    private function connect(){


    /**
     * 2° passo -estancia a classe StsConn para conectar com o banco de dados
     * @var object $this->connection - armazena a conexao com o banco de dados.
     */
    $this->connection = $this->connectDb();

    /**
     * 3° passo - prepara a query que está em $this->select e depois atribuo para o @var object $this->query
     * @var object $this->connection->prepare - prepara a query que está em $this->select e depois atribuo para o @var object $this->query*/
    
     $this->query = $this->connection->prepare($this->select);

    /**
     * 4° seta o modo de leitura dos dados
      *  $this->query->setFetchMode(PDO::FETCH_ASSOC) - o metodo setFetchMode indica a maneira  como os dados serao lidos. Fetch assoc vai retornar dados em um array associativo. 
      *
      */
     $this->query->setFetchMode(PDO::FETCH_ASSOC);

    }



}


?>