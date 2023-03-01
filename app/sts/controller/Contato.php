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
    * controller da pagina contato 
    * @package Sts\controller
    * @subpackage Contato
    * @version 1.0
    *http://localhost/logistica/app/sts/controller/ContatoController.php(caso tente acessar diretamente o arquivo)
    */ 
    
class Contato{

    /**
     * @var array $data - armazena os dados que devem ser enviados para a View
     * ele vai ser null, pois nao vai receber dados da controller para enviar
     * pode ser uma string também
     */
    private array|string|null $data; //recebe array ou string ou null
    public function index(){

        /**
         * nao recebe dados da controller para enviar
         */
        $this->data = "Mensagem enviada com sucesso";

        /**
         * @var object $loadView - recebe o objeto da classe ConfigView
         * @param object $loadView - primeiro parametro é o nome da página de View
         * @param object $loadView - segundo parametro é os dados da página de    View
         */
      $loadView = new \CORE\ConfigView("sts/view/contato/contato", $this->data);

      /**
       * depois da instancia de ConfigView, chama o metodo renderView
       * @method renderView - carrega a página de View
       */

      $loadView->renderView();

    }

}


?>