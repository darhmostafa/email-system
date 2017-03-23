<?php
include ("config.php");
class student_mail{
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
    public function add($studentid,$username,$password,$forward,$usercreate,$future){
        $this->connection->query("INSERT INTO `email`(`username`, `password`, `forward`, `user_create`, `student_id`,`future`) VALUES ('$username','$password','$forward','$usercreate','$studentid','$future')");
        if($this->connection->affected_rows >0){
            return true;
        }
        return false;
    }

    /**
     * @return array|null
     */
    public function getemail(){
        $result = $this->connection->query("SELECT * FROM email ORDER BY id_mail DESC LIMIT 1");
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


    public function geteall(){
        $result = $this->connection->query("SELECT * FROM email");
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

    // select to cron jops
    public function selectemail(){
        $result = $this->connection->query("SELECT * FROM email ORDER BY id_mail ASC LIMIT 1");
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


    public function delete($id){
        $this->connection->query("DELETE FROM `email` WHERE `id` = '$id'");
        if($this->connection->affected_rows >0){
            return true;
        }
        return false;
    }


    /**
     * close database
     */
    function __destruct()
    {
        $this->connection->close();
    }

}
