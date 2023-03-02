<?php


namespace Sts\model;


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
    public function index(){//ponto de saida do model
    

        /*** @var object $viewHome - armazena o objeto da classe StsRead*/
        $viewHome = new \Sts\model\helper\StsRead();
        /*** @var string $table - armazena o nome da tabela que deve ser lida e envia para a função execRead no Helper StsRead
         * ponto de entrada da stsRead
        */
        $viewHome->execRead("home_top");
        
        /*** @var array $this->data - armazena o resultado da query preparada e executada. retorna um array , por isso posso colocar no atributo data.]
        *ponto de entrada do model.
        */
        $this->data = $viewHome->getResult();



        /**
         * teste para ver se o atributo data está recebendo o retorno do metodo getResult em um array.
         *var_dump($this->data);
         */
       


      

         
       return $this->data;

       
    }

}

?>


