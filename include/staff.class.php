<?php

include ("config.php");
class staff{

    private $connection;

    /**
     * staff constructor.
     */
    public function __construct()
    {
        $this->connection = new mysqli(server,db_user,db_pass,db_name);
    }

    /**
     * @param $institute_id
     * @param $fname
     * @param $lname
     * @param $phone
     * @param $forward
     * @param $level
     * @return bool
     */
    public function add($institute_id,$fname,$lname,$phone,$forward,$level)
    {
        $this->connection->query("INSERT INTO `staff`(`institute_id`, `fname`, `lname`, `phone`, `email_forward`, `level`) VALUES ('$institute_id','$fname','$lname','$phone','$forward','$level')");
        if($this->connection->affected_rows >0){
            return true;
        }
        return false;
    }

    function __destruct()
    {
        $this->connection->close();
    }
    
    
    
}