<?php 
require_once('connect.php');
session_start();

if(isset($_POST["signup"])){
    var_dump($_POST);
    $stmt_check_username = oci_parse($con, 'SELECT * FROM users WHERE username = :username');

    oci_bind_by_name($stmt_check_username, ":username",$_POST["username"]);
    oci_execute($stmt_check_username);

    $usernameCheck = oci_fetch($stmt_check_username);

    if($usernameCheck){
        //létezik ez a felhasználó
        header("location: index.php?signup_error=Van fiók ezzel a felhasználónévvel");
    }else{
        if($_POST["password"] != $_POST["confirm-password"]){
            header("location: index.php?signup_error=A két jelszó nem egyezik");
        }
        $stmt = oci_parse($con, 'INSERT INTO users(username,password) VALUES(:username,:password)');
        oci_bind_by_name($stmt,":username", $_POST["username"]);
        oci_bind_by_name($stmt,":password",$_POST["password"]);
        if(oci_execute($stmt)){
            header("location: index.php?success=Sikeres regisztráció");
        }else{
           // oci_error($con);
            header("location: index.php?signup_error=Sikertelen regisztráció");
        }
    }
}