<?php
include ("config.php");
class student{
    private $connection;

    /**
     * user constructor.
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
     * @param $major
     * @param $grade
     */
    public function add($institute_id,$fname,$lname,$phone,$forward,$major,$grade){
        $this->connection->query("INSERT INTO `student`(`institute_id`, `f_name`, `l_name`, `phone`, `email_forward`, `major_id`, `grade_id`) VALUES ('$institute_id','$fname','$lname','$phone','$forward','$major','$grade')");
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