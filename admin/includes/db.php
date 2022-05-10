<?php

    class dbase
    {
        private $host = "localhost";
        private $user = "root";
        private $pwd = "";
        // private $dbname = "bincom";


        private $dbh;
        private $error;
        private $stmt;

        public function __construct($dbname)
        {
            $dsn = "mysql:host=".$this->host.";dbname=".$dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
            );
            try
            {
                $this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
            } 
            catch(PDOException $e)
            {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        public function prep($query)
        {
            $this->stmt = $this->dbh->prepare($query);
        }
        public function bindvalue($param, $value, $type)
        {
            switch($type)
            {
                case 'int': $this->stmt->bindValue($param, $value, PDO::PARAM_INT);
                break;
                case 'str': $this->stmt->bindValue($param, $value, PDO::PARAM_STR);
                break;
                case 'bool': $this->stmt->bindValue($param, $value, PDO::PARAM_BOOL);
                break;
            }
            
        }

        public function execute()
        {
            return $this->stmt->execute();
        }

        public function fetchSingle()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function fetchMultiple()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function fetchCol()
        {
            $this->execute();
            return $this->stmt->fetchColumn();
        }
    }
?>