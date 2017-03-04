<?php

    class databaseHandler
    {
        private $server = "localhost";
        private $user = "root";
        private $pass = "1BexWWL1Mh";
        private $database = "snaps";
        private $connection;

        function __construct() 
        {
            $this->connection = mysqli_connect($this->server, $this->user, $this->pass, $this->database);
            if (!$this->connection) 
            {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
            mysqli_set_charset($this->connection, "utf8");
        }
        function __destruct()
        {
            echo $this->connection->error;
            mysqli_close($this->connection);
        }
        function query($sql)
        {
            return $this->connection->query($sql);
        }
        function multi_query($sql)
        {
            $array = [];
            $this->connection->multi_query($sql) or trigger_error($this->connection->error);
            do 
            {
                if ($result = $this->connection->store_result()) 
                {
                    while ($row = $result->fetch_row()) 
                    {
                        $array[] = $row;
                    }
                }
            } while ($this->connection->more_results() && $this->connection->next_result());

            if(!$this->connection->connect_errno)
                return $array;
            return false;
        }
        function toArray($result)
        {
            $array = [];
            while($row =mysqli_fetch_assoc($result))
                $array[] = $row;
            return $array;
        }
        function fetch_assoc($query)
        {
            return mysqli_fetch_assoc($query);
        }
        function insert_id()
        {
            return mysqli_insert_id($this->connection);
        }
        function isEmpty($result)
        {
            if($result->num_rows === 0)
                return true;
            return false;
        }
    }

?>