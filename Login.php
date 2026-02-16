<?php

session_start();
include 'dbconnect_lo.php';


if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];



    $stmt = $conn->prepare("SELECT id,full_name,password_hash from users where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();


    if($stmt->num_rows ===1)
    {
        $stmt ->bind_result($id,$full_name,$password_hash);
        $stmt->fetch();


            if(password_verify($password,$password_hash))
            {
                $_SESSION['userid']=$id;
                $_SESSION['username']=$full_name;
                header('location:  dashboard.php');
                exit();
            }
            else{
                echo "Invalid password";
            }
    }
    else{
        echo "no accvount found with that email.";
    }


    $stmt->close();
    $conn->close();

    
}

?>