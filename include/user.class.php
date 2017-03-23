<?php
include ("config.php");
class user{

    private $connection;

    /**
     * user constructor.
     */
    public function __construct()
    {
        $this->connection = new mysqli(server,db_user,db_pass,db_name);
    }


    /**
     * @param string $extra
     * @return array|null
     */
    public function getusers($extra = ''){
        $result = $this->connection->query("SELECT * FROM `user` $extra");
        if($result->num_rows>0)
        {
            $users = array();

            while($row = $result->fetch_assoc())
            {
                $users[] = $row;
            }

            return $users;
        }
        return null;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteuser($institute_id){
        $this->connection->query("DELETE FROM `user` WHERE `institute_id` = '$institute_id'");
        if($this->connection->affected_rows >0){
            return true;
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @return bool
     */
    public function adduser($id,$name,$username,$password,$task){
        $this->connection->query("INSERT INTO `user`(`institute_id`, `full_name`, `username`, `password`, `task`) VALUES ('$id','$name','$username','$password','$task')");
        if($this->connection->affected_rows >0 )
        {
            return true;
        }
        return false;
    }

    /**
     * to get user to chart by join
     * @return array|null
     */

    public function getuserbyinner(){
        $result = $this->connection->query("SELECT user.username, user.institute_id, email.id_mail FROM email INNER JOIN user ON email.user_create = user.institute_id");
        if ($result->num_rows >0){
            $users = array();
            while ($row = $result->fetch_row()){
                $users[] = $row;
            }
            return $users;
        }
        return null;
    }

    /**
     * @param $username
     * @param $password
     * @return mixed|null
     */
    public function login($username,$password){
        $user = $this->getusers("WHERE `username` = '$username' AND `password` ='$password'");
        if($user && count($user)>0){
            return $user[0];
        }
        return null;
    }

    /**
     * close connection
     */
    function __destruct()
    {
        $this->connection->close();
    }

}
