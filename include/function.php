<?php
/**
 * to check username 
 * @return bool
 */
function check(){
    return (isset($_SESSION['user']))? true :false;
}