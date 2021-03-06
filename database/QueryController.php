<?php

namespace database;


use Dotenv\Dotenv;

class QueryController
{
    public $link;
    public $error;


    public function __construct()
    {
        $this->connectDB();
    }


    private function connectDB()
    {
        Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();

        $this->link = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);

        if (!$this->link) {

            $this->error = "connection fail" . $this->link->connect_error;
            return false;
        }
    }

    // Select or Rread Data From Database

    public function select($query)
    {
        $result = $this->link->query($query) or die ($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    // Create Data in to the database

    public function insert($query)
    {
        $insert_row = $this->link->query($query) or die ($this->link->error . __LINE__);
        if ($insert_row) {
            return true;
        } else {
            die("Error: (" . $this->link->erron . ")" . $this->link->error);

        }

    }

    /// Update Data in to the database

    public function update($query)
    {
        $update_row = $this->link->query($query) or die ($this->link->error . __LINE__);
        if ($update_row) {
            return true;
        } else {
            die("Error: (" . $this->link->erron . ")" . $this->link->error);

        }

    }


/// Delete Data in to the database

    public function delete($query)
    {
        $delete_row = $this->link->query($query) or die ($this->link->error . __LINE__);
        if ($delete_row) {
            return true;
        } else {
            die("Error: (" . $this->link->erron . ")" . $this->link->error);

        }

    }


}