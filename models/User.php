<?php


class User 
{
    
    private $db;

    //__construct method that runs when object is initialized
    public function __construct()
    {
        $this->db = new Database();
    }


    function view($view, $data = [])
    {

        // Check if the file we set as $view exists
        if (file_exists($view . '.php')) {
            //if that exists, require it
            require_once 'models/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }

    public function addUser($data)
    {
        //Prepare query
        $this->db->query('INSERT INTO users (first_name,last_name,email) VALUES (:first_name, :last_name, :email)');

        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);

        

        if ($this->db->execute()) {
            return true;

        } else {
            return false;
        }
    }

    public function findUserByEmail($email)
    {
        //Prepare query
        $this->db->query("SELECT * FROM users WHERE email = :email");

        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        };
    }


    public function getCustomers()
    {
        //Prepare query
        $this->db->query('SELECT * FROM customers ORDER BY created_at DESC');

        $result = $this->db->resultset();

        return $result;
    }
}
