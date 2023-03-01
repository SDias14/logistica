    <?php
    

    /**
     * 
     * @var bool M7E3L8K9E5 - define que o usuario esta acessando paginas internas atraves da pagina index.php
     */

    define('M7E3L8K9E5', true);

    /**
     * incluindo o autoload do composer para carregar as classes
     */
    
     require './vendor/autoload.php';

    /**
     * instanciando a classe Routes
     */

    $url = new \CORE\Routes();

    /**
     * usando o metodo loadPage para carregar a página de controller. 
     */

    $url->loadPage();


    




    
