<?php
/**
 * classe que cuidará do controller de contato
 */

namespace Sts\controller; //onde está o arquivo. o autoload que esta no index.php vai procurar a classe Contato dentro da pasta controller
 

 class Contato{
    
    /**
     * função index
     * objetivo: carregar a página de contato
     * esse metodo deve ser instanciado no arquivo index.php
     */
         public function index(){
             echo "Pagina de contato carregada com sucesso!";
         }
    }



?>