<?php

if(!defined('M7E3L8K9E5')){
        header("Location:http://localhost/logistica/erro"); //redirecionamento para a pagina de erro. 
        //  die("Erro 404 - Página não encontrada");
        
        // teste : http://localhost/logistica/app/sts/view/home.php
}else{
        
        
        /**
        * teste para verificar se o array $this->dataView esta recebendo os dados do controller Home
        * var_dump($this->dataView);
        */
        
        
        
        /**
        * extract - extrai os dados do array $this->dataView e cria variaveis com o nome das chaves do array.
        */
        extract($this->dataView); 
        
        echo "<h1> Bem vindos à nossa Loja </h1>";
        
        /**
        * 1°echo - imprime o titulo da pagina
        * @var $titleTop - é o nome da chave do array $this->dataView
        */
        echo "<h1> $titleTop </h1>";
        /**
        * 2°echo - imprime a descrição da pagina
        * @var $descriptionTop - é o nome da chave do array $this->dataView
        */
        echo "<p> $descriptionTop </p>";
        
        /**
        * 3°echo - imprime um botao que leva para a pagina de contato
        * @var $linkBtnTop - é o nome da chave do array $this->dataView
        * @var $txtBtn - é o nome da chave do array $this->dataView
        */
        echo "<button><a href='$linkBtnTop'>$txtBtn</a></button>";
        
        /**
        * 4°echo - imprime a imagem
        * @var $imageTop - é o nome da chave do array $this->dataView
        */
        echo "<img src='".URL."assets/img/home/$imageTop' alt='img'>";
        
}



?>