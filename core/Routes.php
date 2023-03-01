<?php

namespace CORE;

/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
  header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
 //  die("Erro 404 - Página não encontrada");

 // teste : http://localhost/logistica/app/core/Routes.php(caso tente acessar diretamente o arquivo)

}




/**
 * Routes - classe responsavel por gerenciar as rotas do sistema. Ela extende a classe Config */
class Routes extends Config
{


    //variaveis da classe.

    /** 
     * var url - vai receber a url passada via get do .htaccess */
    private string $url;
    
    /**
     * var urlArray - vai receber a url em forma de array para fazer um explode */
    private array $urlArray;

    /**
     * var controller - vai receber o nome do controller */

    private string $urlController;

    /**
     * var parameter - vai receber o nome do método*/

    private string $urlParameter;

    /**
     * var slug */

    private string $urlSlugController;

    /**
     * array format - vai receber o formato.*/

    private array $format;




    /**
     * função construtora
     * objetivo : verificar se existe a url passada via get. se existir, atribui a variável url. se não existir, atribui a variável url o valor home.
     * 
     */


    

    public function __construct(){
 
      $this->config();

        /**
         * teste de carregamento da classe no arquivo index.php
         * echo "Classe Routes carregada com sucesso!";
         */

        /**
        * verificação de passagem de informações via get. se houver, atribui a variável url.
        */

         if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
            
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            /**
             * var_dump($this->url) teste de recebimento da url.
             */

             $this->clearUrl();

        /////////////////////////////////////////////////////////////////    
             
        
            /**
             * explode da url para transformar em array
             */

            $this->urlArray = explode('/', $this->url);

            /**
             * var_dump($this->urlArray) teste de recebimento da url em forma de array.
             */


             /*
                * verificação se existe o controller passado pela url. se existir o controller, atribui a variável controller. se não existir, eu quero que o usuario acessa a home.
            */

             if(isset($this->urlArray[0])){
                //vai receber o retono da função slugController
                $this->urlController = $this->slugController($this->urlArray[0]);
                }else{
                    $this->urlController = $this->slugController(CONTROLLERERROR); //se nao existir o controller, vai para a pagina de erro.
                }
  //fim da primeira verificação. 
            }else{
              /**
               * teste de recebimento da url. Caso exista, vai aparecer a url. Caso nao exista, vai aparecer a mensagem "Nenhuma URL informada"
               * echo "Nenhuma URL informada";
               */
                $this->urlController = $this->slugController(CONTROLLER);//se nao existir a url, vai para a home.
         }

         /**
          * teste de recebimento do controller. Caso exista, vai aparecer o nome do controller. Caso nao exista, vai aparecer a mensagem "Nenhuma URL informada e a variavel home."
          *echo "Controller: {$this->urlController}";
          */

         

         
          

      
        
        
    }

    
    
    /**
     * 1° função fora do construtor
     * objetivo da função: limpar a url de caracteres especiais e espaços em branco.
     * 
     */

    private function clearUrl(){
        //eliminando tags. 
        $this->url = strip_tags($this->url);
        //eliminar espaços em branco
        $this->url = trim($this->url);
        //eliminar a barra no final da url
        $this->url = rtrim($this->url, '/');
        //eliminar alguns caracteres 
        
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        //old pattern

        /**
         * essa função strtr() substitui os caracteres especiais por caracteres normais.
         * utf8_decode() - decodifica a string para o formato utf8
         * utf8_encode() - codifica a string para o formato utf8
         * padrao antigo : 
         * $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
        
         */

         //padrao novo'
         $this->url = strtr(mb_convert_encoding($this->url, 'ISO-8859-1', 'UTF-8'), mb_convert_encoding($this->format['a'], 'ISO-8859-1', 'UTF-8'), $this->format['b']);

/**
 * teste para ver se o array esta recebendo os caracteres nas duas posições.
 * var_dump($this->format);
 */

        
    } // fim da função clearUrl()




    /**
     * 2° função fora do construtor
     
     * função slugController(lida com tratamentos de caracteres.)
     * o parametro $slugController vai receber o nome do controller e converter para minuscula.]
     * o parametro $slugController vai receber o nome do controller e retirar os espaços em branco.
     * o parametro $slugController vai receber o nome do controller e converter a primeira letra de cada palavra para maiuscula.
     * vai retornar o nome do controller tratado.
     */
     
     private function slugController($slugController){
        
        //converter primeira para minuscula
        $this->urlSlugController = strtolower($slugController);

        //converter - para espaço em branco
        $this->urlSlugController = str_replace('-', ' ', $this->urlSlugController);

        //converter a primeira letra de cada palavra para maiuscula
        $this->urlSlugController = ucwords($this->urlSlugController);

        //retirar os espaços em branco
        $this->urlSlugController = str_replace(' ', '', $this->urlSlugController);

       return $this->urlSlugController;
     }

     /**
      * 3° função fora do construtor
        * função para carregar o controller
      */

      public function loadPage(){
        
        /**
         * teste de carregamento da função loadPage()
         * echo "Carregando a página/controller<br>";
         */
        
        
  
        /**
         * a variavel $classLoad vai receber o nome do controller e concatenar com o namespace.
         */
        $classLoad = "\\Sts\\controller\\" . $this->urlController;

        /**
         * a variavel $classPage é um objeto da classe $classLoad que vai receber o nome do controller.
         */
        $classPage = new $classLoad();
        /**
         * a variavel $classPage vai receber o método index() do controller.
         * o método index() vai ser responsável por carregar a view.
         */
        $classPage->index(); // vai mostrar o que tem dentro do método index() do controller.
      }

      
    
}


?>