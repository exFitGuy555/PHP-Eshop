<?php
/*
   * PDO Database Class
   * Connect to database
   * Create prepared statements
   * Bind values
   * Return rows and results
   * Database class wil get use in the models
   */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;


    private $dbh; //whenever we prapred our stmt we going to use dbh
    private $stmt; // statement
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true, //increase profermence by checking if there is any connection that set with the database
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Elegent way to handle errors
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $err) {
            $this->error = $err->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    //a method to run queries 
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                    //will check if the value is an intager
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                    //will check if the value is an Boolean
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                    //will check if the value is an Null
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                    //default value as a string
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        //after figure out what the type is
        //now well bind the values that will go into the stmt
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    //in cases well fetch more than one row
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ); // PDO:FETCH_OBJ will turn the result that recived to an obj
    }

    // Get single record as object
    //Get a single row
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    //rowCount is a PDO based in method
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
