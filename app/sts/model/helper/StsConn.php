<?php

namespace Sts\model\helper;
use PDOException;


/**
 * este if  vai verificar se a constante M7E3L8K9E5 foi definida
 * se não foi definida ele vai redirecionar para a pagina de erro
 */
if(!defined('M7E3L8K9E5')){
    header("Location:http://localhost/logistica/erro");//redirecionamento para a pagina de erro. 
   //  die("Erro 404 - Página não encontrada");

}

/**
 * classe responsavel por fazer a conexao com o banco de dados. classe abstrata.Somente filhas podem ser instanciadas.
 * @package model
 * @subpackage helper
 * @author : samuel 
 */

class StsConn{

    /*** @var string $host - armazena o nome do host do banco de dados*/
    private string $host = HOST;
    /***@var string $user - armazena o nome do usuario do banco de dados*/
    private string $user = USER;
    
    /*** @var string $pass - armazena senha do usuario do banco de dados*/
    private string $pass = PASS;

    /*** @var string $dbname -armazena o nome do banco de dados*/
    private string $dbname = DBNAME;

    /*** @var string $port -armazena a porta do banco de dados. aceita string ou inteiro*/
    private int|string $port = PORT;

    /*** @var object $conn - armazena a conexao com o banco de dados*/
    private object $conn;

    /**
     * metodo responsavel por criar a conexao com o banco de dados
     * @return object
     */

  public function connectDb(){
        try{
            $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbname;port=$this->port", $this->user, $this->pass);
            //echo "Conexão realizada com sucesso";
            return $this->conn;

        }catch(PDOException $e){
            die("Erro: Conexão com o banco não realizada. Contate o administrador do site: " . EMAILADM); // caso ocorra um erro na conexão com o banco de dados, será exibido uma mensagem de erro.
        }
    }


}









?>