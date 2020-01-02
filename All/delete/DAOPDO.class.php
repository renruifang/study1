<?php
require_once 'i_DAOPDO.interface.php';
class DAOPDO implements i_DAOPDO{
    private $host;
    private $dbname;
    private $port;
    private $charset;
    private $user;
    private $pass;
    private $pdo;
    private static $instance;

    private function __clone(){

    }
    private function __construct($options){
        $this->host=isset($options['host'])?$options['host']:'localhost';
        $this->dbname=isset($options['dbname'])?$options['dbname']:'test';
        $this->port=isset($options['port'])?$options['port']:'3306';
        $this->charset=isset($options['charset'])?$options['charset']:'utf8';
        $this->user=isset($options['user'])?$options['user']:'root';
        $this->pass=isset($options['pass'])?$options['pass']:'root';

        $dsn="mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=$this->charset";
        $user=$this->user;
        $pass=$this->pass;
        try{
            $this->pdo=new PDO($dsn,$user,$pass);
        }catch(PDOException $e){
            echo '连接错误'.$e->getMessage();
            die();
        }
    }
    public static function getSingleton($options){
        if(!self::$instance instanceof self){
            self::$instance=new self($options);
        }
        return self::$instance;
    }
    public function fetchAll($sql){
        $pdo_statement=$this->pdo->query($sql);
        if($pdo_statement==false){
            echo 'sql语句错误'.$this->pdo->errorInfo()[2];
        }
        $arr=$pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }
    public function fetchRow($sql){
        $pdo_statement=$this->pdo->query($sql);
        if($pdo_statement==false){
            echo 'sql语句错误'.$this->pdo->errorInfo()[2];
        }
        $arr=$pdo_statement->fetch(PDO::FETCH_ASSOC);
        return $arr;
    }
    //    查询某个字段
    public function fetchOne($sql){
        $pdo_statement=$this->pdo->query($sql);
        if($pdo_statement==false){
            echo 'sql语句有问题'.$this->pdo->errorInfo()[2];
        }
        return $pdo_statement->fetchColumn();//查询某个字段
    }
//    增删改
    public function query($sql){
        $affect_rows=$this->pdo->exec($sql);
        if($affect_rows==false){
            echo 'sql语句有问题'.$this->pdo->errorInfo()[2];
        }
        if($affect_rows>0){
            return true;
        }else{
            return false;
        }
    }

}