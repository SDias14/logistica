<?php

namespace Core;

class Routes{

    /** 
     * var url - vai receber a url passada via get
     */
    private string $url;
    
    /**
     * var urlArray - vai receber a url em forma de array para fazer um explode
     */
    private array $urlArray;

    /**
     * var controller - vai receber o nome do controller
     */

    private string $urlController;

    /**
     * var parameter - vai receber o nome do método
     */

    private string $urlParameter;

    /**
     * var slug 
     */

    private string $urlSlugController;

    /**
     * array format - vai receber o formato.
     */

    private array $format;





    

    public function __construct(){
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
                $this->urlController = $this->urlArray[0];
                }else{
                    $this->urlController = 'Home';
                }
  //fim da primeira verificação. 
            }else{
                echo "Nenhuma URL informada";
                $this->urlController = 'Home';
         }

         /**
          * teste de recebimento do controller. Caso exista, vai aparecer o nome do controller. Caso nao exista, vai aparecer a mensagem "Nenhuma URL informada e a variavel home."
          */
         echo "Controller: " . $this->urlController . "<br>";

      
        
        
    }

    private function clearUrl(){
        //eliminando tags. 
        $this->url = strip_tags($this->url);
        //eliminar espaços em branco
        $this->url = trim($this->url);
        //eliminar a barra no final da url
        $this->url = rtrim($this->url, '/');
        //eliminar alguns caracteres 
        $this->format['a'] = '';
    }
    
}


?>