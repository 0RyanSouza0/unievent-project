<?php
  namespace src\Config;
    use PDO;
    use PDOException;

    class Connection{
        private $server = "localhost";
        private $username= "root";
        private $db_name= "dbunievent";
        private $password="";
        private $port='3307';
        public $conn;

        public function getConnection(){
            try{
                $this->conn=new PDO("mysql:host=$this->server:$this->port;dbname=$this->db_name",$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
                $this->conn->exec('set names utf8');
            }
            catch(PDOException $e){
                echo"ERROR: ".$e->getMessage();
            }
            return $this->conn;
        }
        
    }
?>