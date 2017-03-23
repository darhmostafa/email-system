<?php
include ("config.php");
class staff_email{
    private $connection;

    /**
     * user constructor.
     */
    public function __construct()
    {
        $this->connection = new mysqli(server,db_user,db_pass,db_name);
    }

    /**
     * @param $studentid
     * @param $username
     * @param $password
     * @param $forward
     * @param $usercreate
     * @return bool
     */
    public function add($staffid,$username,$password,$forward,$usercreate){
        $this->connection->query("INSERT INTO `staff_email`(`username`, `password`, `forward`, `user_create`, `staff_id`) VALUES ('$username','$password','$forward','$usercreate','$staffid')");
        if($this->connection->affected_rows >0){
            return true;
        }
        return false;
    }

    /**
     * @return array|null
     */
    public function getemail(){
        $result = $this->connection->query("SELECT * FROM staff_email ORDER BY id_mail DESC LIMIT 1");
        if($result->num_rows>0)
        {
            $emails = array();

            while($row = $result->fetch_assoc())
            {
                $emails[] = $row;
            }

            return $emails;
        }
        return null;
    }
    public function getall(){
        $result = $this->connection->query("SELECT * FROM staff_email");
        if($result->num_rows>0)
        {
            $emails = array();

            while($row = $result->fetch_assoc())
            {
                $emails[] = $row;
            }

            return $emails;
        }
        return null;
    }

    /**
     * close database
     */
    function __destruct()
    {
        $this->connection->close();
    }

}


