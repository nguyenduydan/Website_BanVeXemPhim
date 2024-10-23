<?php
    require 'dbcon.php';
    session_start();
    
    function validate($inpData){
        global $conn;
        return mysqli_real_escape_string($conn, $inpData);
    }
    function redirect($url, $status){
        $_SESSION['status'] = $status;
        header('Location: '.$url);
        exit(0);
    }
    function alertMessage(){
        if(isset($_SESSION['status'])){
            echo '<div class="alert alert-success">
                <h4>'.$_SESSION['status'].'</h4>
            </div>';
            unset($_SESSION['status']);
        }
    }
?>