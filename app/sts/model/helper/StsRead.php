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

    /*** @var array $values - armazena os valores que foram modificados no parseString*/
    private array $values = [];

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
     * metodo para fazer a leitura no banco de dados com o asterisco
     * @param string $table - nome da tabela que deve ser lida
     * @param mixed $terms - termos da query
     * @param string $parseString - string para ser executada no banco de dados
     */
    public function execRead(string $table, string|null $terms = null , string|null $parseString = null){
  
        /**
         * 1° passo - faz a leitura no banco com a query select.
         * teste para verificar se a função está recebendo o nome da tabela quando for instanciada
         *  var_dump($table);
         * var_dump ($terms);
         * var_dump($parseString);
         */
         

         
       
         /**
          * @var mixed $this->select - armazena a query que deve ser executada no banco de dados
            * @var string $table - nome da tabela que deve ser lida
            * @var mixed $terms - termos da query
          */

          /**
           * parse_str - transforma uma string em um array
           * nesse caso a string $parseString vai ser transformada em um array e armazenada na variavel $this->values
           */
          if(!empty($parseString)){
              parse_str($parseString, $this->values); //transforma a string em um array
              var_dump($this->values); // teste para verificar se a string foi transformada em um array
         }

          $this->select = "SELECT * FROM {$table} {$terms} "; //query montada

        /**
         * teste para verificar se a query está sendo montada corretamente
            * var_dump($this->select);
         */
        var_dump($this->select);
        /**
         *7° vai chamar o metodo execQuery para executar a query
         */
         $this->execQuery();
          
    }

    public function fullRead(string $query, string|null $parseString = null ){

        $this->select = $query;
        //var_dump($this->select);

        /**
           * parse_str - transforma uma string em um array
           * nesse caso a string $parseString vai ser transformada em um array e armazenada na variavel $this->values
           */
          if(!empty($parseString)){
            parse_str($parseString, $this->values); //transforma a string em um array
         //   var_dump($this->values); // teste para verificar se a string foi transformada em um array
       }
         /**
          * 7° vai chamar o metodo execQuery para executar a query*/
           $this->execQuery();
    }

    /**
     * metodo para executar a query. vai chamar o metodo connect para conectar com o banco de dados, onde o metodo connect tem a query preparada.
     */
    private function execQuery(){
        
        
        $this->connect();//5° passo - chama o metodo connect para conectar com o banco de dados e preparar a 
        
       

        /**
         * 6° passo - executa a query e armazena o resultado na variavel $this->result, usando o metodo fetchAll para retornar todos os dados da tabela
         */

         
       
        try{
            $this->execParams(); //executa os parametros da query

           // var_dump($this->query); //vai mostrar a query que foi preparada - teste
            $this->query->execute(); 
           // var_dump($this->query); //vai mostrar a query que foi executada - teste

            $this->result = $this->query->fetchAll(); //array associativo - saida do Ststread.
            //var_dump($this->result); //vai mostrar o resultado da query - teste

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

    /**
     * metodo para  substituir os valores da query com os valores que foram modificados no parseString e bindValue
     */
    private function execParams(){
        /**
         * verifica se a variavel $this->values não está vazia
         */
        if($this->values){
 
         //   var_dump($this->values); //teste para verificar se a variavel $this->values está recebendo os valores do parseString
            /**
             * foreach - percorre o array $this->values
             */
            foreach($this->values as $link => $value){
              // var_dump($link); //teste
               // var_dump($value); //teste
                if($link == 'limit' || $link == 'offset' || $link == 'id'){
                    $value = (int)$value;
                }

                /**
                 * bindValue - substitui os valores da query
                 * @var string $link - nome do campo que deve ser substituido
                 * @var string $value - valor que deve ser substituido
                 * @var int $value - tipo de dado que deve ser substituido
                 * PDO::PARAM_INT - tipo de dado inteiro
                 * PDO::PARAM_STR - tipo de dado string
                 */

                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));


                }
                
        }
    }



}


?>