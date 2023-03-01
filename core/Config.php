<?php

/**
 * Essa é uma classe de configuração
 * objetivo: carregar as configurações do sistema
 * configurações constantes do sistema
 */

 namespace CORE;

 
/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
    header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
   //  die("Erro 404 - Página não encontrada");

   // teste : http://localhost/logistica/app/core/Config.php(caso tente acessar diretamente o arquivo)

}

 abstract class Config{
    public function config(){

        /**
         * teste de carregamento da classe no arquivo Routes.php
         * echo "Classe Config carregada com sucesso!";
         * FUNÇÃO instanciado somente no arquivo Routes.php
         */
        

        /**
         * 1° define : a url do site. Essa url deve ser a url do site. Exemplo: http://localhost/logistica/
         */
        define('URL', 'localhost/logistica');

        /**
         * 2° define : administração do site. Essa url deve ser a url do site. Exemplo: http://localhost/logistica/adm/
         */
        define('URLADM', 'http://localhost/logistica/adm');

        /**
         * 3° define : controller padrão do site. Essa url deve ser a url do site. Exemplo: http://localhost/logistica/home
         */
        define('CONTROLLER', 'Home');

        /**
         * 4° define : controller da página de erro. Essa url deve ser a url do site. Exemplo: http://localhost/logistica/erro
         */
        define('CONTROLLERERROR', 'Erro');

        //credenciais do banco de dados

        /**
         * 5° define : email do administrador do site. 
         */

        define('EMAILADM', 'samueld2014@gmail.com');

    }
 }





?>