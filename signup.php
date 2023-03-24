<?php 
require_once('connect.php');
session_start();

if(isset($_POST["signup"])){
    var_dump($_POST);
    $stmt_check_username = oci_parse($con, 'SELECT * FROM felhasznalo WHERE felhasznalonev = :username');

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
        $stmt = oci_parse($con, 'INSERT INTO felhasznalo(kernev, veznev, szulido, felhasznalonev, email, jelszo) VALUES(:kernev, :veznev, :szulido, :username, :email, :password)');
        oci_bind_by_name($stmt,":kernev", $_POST["kernev"]);
        oci_bind_by_name($stmt,":veznev", $_POST["veznev"]);
        oci_bind_by_name($stmt,":szulido", date("y-M-d", strtotime($_POST["szulido"])));
        oci_bind_by_name($stmt,":username", $_POST["username"]);
        oci_bind_by_name($stmt,":email", $_POST["email"]);
        oci_bind_by_name($stmt,":password",$_POST["password"]);
        if(oci_execute($stmt)){
            header("location: index.php?success=Sikeres regisztráció");
        }else{
            //oci_error($con);
            header("location: index.php?signup_error=Sikertelen regisztráció");
        }
    }
}