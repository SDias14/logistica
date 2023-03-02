<?php

namespace Sts\controller; //onde está o arquivo. o autoload que esta no index.php vai procurar a classe Home dentro da pasta controller


/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
    header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
   //  die("Erro 404 - Página não encontrada");

}

/**
    * controller da pagina Home
    * @package Sts\controller
    * @subpackage Home
    * @version 1.0
    *http://localhost/logistica/app/sts/controller/Home.php(caso tente acessar diretamente o arquivo)
    */ 
 


class Home{

    /**
     * @var array $data - armazena os dados que devem ser enviados para a View
     * pode ser um array ou uma string ou null
     */
    private array|string|null $data;
    public function index(){
      
        /**
       * @var object $home - recebe o objeto da classe StsHome
       * ponto de entrada do model StsHome
       */
        $home = new \Sts\model\StsHome();
        $this->data = $home->index(); // instancia o metodo index da classe StsHome e armazena o retorno na variavel $this->data que tem um array de dados que vai ser enviado para a View. Ponto de saida
         


        /**
         * @var object $loadView - recebe o objeto da classe ConfigView
         * @param object $loadView - primeiro parametro é o nome da página de View
         * @param object $loadView - segundo parametro é os dados da página de    View
         */
     $loadView = new \CORE\ConfigView("sts/view/home/home", $this->data); //ponto de saida para a view

      /**
       * depois da instancia de ConfigView, chama o metodo renderView
       * @method renderView - carrega a página de View
       */

     $loadView->renderView();

    }

}


?>