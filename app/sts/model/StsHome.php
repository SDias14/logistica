<?php


namespace Sts\model;
use Sts\model\helper\StsConn;

/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
    header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
   //  die("Erro 404 - Página não encontrada");

}

/**
 * model da pagina Home
 * @package model
 
 * @version 1.0
 *http://localhost/logistica/app/sts/model/StsHome.php(caso tente acessar diretamente o arquivo)
 */

class StsHome{

    /**@var array $data - armazena os dados que devem ser enviados para o controller. Esses dados vem do banco de dados.*/
    private array $data;

    /**
     * var  $connection - armazena a conexao com o banco de dados.*/
    private object $connection;

/**
 
 * objetivo : carregar os dados do banco de dados
 * @return array
 */
    public function index(){
        /**
         * esse array recebe duas posições, uma com o titulo da página e outra com a descrição do serviço.
         */
      
         /* $this->data = [
            'title' => 'Home',
            'description' => 'Home'
            ];*/ 

        $connect = new StsConn();  // criando um objeto da classe StsConn
        
        $this->connection = $connect->connectDb(); //instanciando o metodo connectDb() da classe StsConn e atribuindo o valor retornado para a variavel $this->connection

        /**
         * teste : var_dump($this->connection); //imprimindo o valor da variavel $this->connection para verificar se a conexao com o banco de dados foi realizada com sucesso. e esta retornando o valor da conexao.
         */

        /***@var string $queryHomeTop - recebe a query que vai ser executada no banco de dados*/

        $queryHomeTop= "SELECT id, titleTop, descriptionTop, linkBtnTop, txtBtn, imageTop FROM home_top 
        LIMIT 1";
        
        /***@var object $resultHomeTop - recebe o objeto da classe PDOStatement que vai preparar a query que está na variavel $queryHomeTop*/
        $resultHomeTop = $this->connection->prepare($queryHomeTop);
        
        /***@var object $resultHomeTop - vai instanciar o metodo execute() da classe PDOStatement que vai executar a query que está na variavel $queryHomeTop*/
        $resultHomeTop->execute();

        /** @var $this->data - vai receber um array com os dados executados da query que está na variavel $queryHomeTop 
         * @method fetch() - vai retornar um array com os dados da query
         * @method fetchAll() - vai retornar um array com os dados da query
        */

         $this->data = $resultHomeTop->fetch(); // vai retornar um array com os dados da query

         /** teste - var_dump( $this->data); // vai retornar um array com os dados da query*/

         /**return - vai retornar um array com os dados da query e vai enviar para o controller*/

       return $this->data;

       
    }

}


?>