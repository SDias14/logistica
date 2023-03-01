<?php

namespace CORE;

/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
    header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
   //  die("Erro 404 - Página não encontrada");

   // teste : http://localhost/logistica/app/core/ConfigView.php(caso tente acessar diretamente o arquivo)

}


/**
 * Classe responsável por carregar as páginas de View
 * @author samuel <samueld2014@gmail.com>*/
class ConfigView{

    /**
* @var string $nome armazena o nome da página de View*/
   // private string $nome;
    /**
*  @var array $dados armazena os dados da página de View*/
   // private array $dados;

    /**
     * Método responsável por carregar a página de View
     * @param string $nome - recebe o nome da página de View
     * @param array $dados - recebe os dados da página de View
     * @return void - não retorna nada
     * no php 8.0 é possível usar o atributo privado no construtor
     * metodo a ser carregado nos controllers
     */
    public function __construct(private string $nameView, private array|string|null $dataView)
    {
    /**
     * teste para ver se o arquivo existe e se funciona
     * var_dump($this->nameView);
     * var_dump($this->dataView);
     */
  
    }

    public function renderView() {
        /**
         * @var string $file - armazena o caminho da página de View
         * @example $file = 'app/' . $this->nameView . '.php';
         * obs: $this->nameView é o nome da página de View
         * obs: $this->dataView são os dados da página de View
         * se o arquivo existir, ele vai carregar a página de View
         */
         
        if(file_exists('app/' . $this->nameView . '.php')){

            /**
             * include - inclue o head da página de View
             */
            include 'app/sts/view/include/header.php';


            /**
             * include - inclue o footer da página de View
             */
            include 'app/sts/view/include/footer.php';

            
            
            /**
             * teste para ver se o arquivo existe e se funciona
             *  echo "arquivo existe"; */

             /**
              * include - inclue o arquivo da página de View para carregar a página
              */

             include 'app/' . $this->nameView . '.php';

        }else{
            /**
             * @example die("Erro: A página de View não existe. Contate o administrador do site: " . EMAILADM);
             * obs: EMAILADM é uma constante definida no arquivo Config.php
             
             */


        die("Erro: A página de View não existe. Contate o administrador do site: " . EMAILADM);
        }
}


        

}






?>
