<?php 
require_once("init.php");
if(isset($_POST["login"])){
    $stmt = oci_parse($con, 'SELECT * FROM felhasznalo WHERE felhasznalonev = :username');

    oci_bind_by_name($stmt, ":username",$_POST["username"]);
    oci_execute($stmt);

    $usernameCheck = oci_fetch($stmt);
    var_dump($usernameCheck);
    if($usernameCheck){
        //talált ilyen felhasználónevet
        $stmt_pw = oci_parse($con, "SELECT * FROM felhasznalo WHERE felhasznalonev = :username AND jelszo = :password");
        oci_bind_by_name($stmt_pw, ":username", $_POST["username"]);
        oci_bind_by_name($stmt_pw, ":password", $_POST["password"]);
        oci_execute($stmt_pw);
        $user = oci_fetch_object($stmt_pw);
        var_dump($user);
        if($user){
            //sikeres login
            $_SESSION["login"] = true;
            $_SESSION["id"] = $user->ID;
            $_SESSION["username"] = $user->FELHASZNALONEV;
            $_SESSION["kernev"] = $user->KERNEV;
            $_SESSION["img"] = $user->KEP;
            header("location: home.php");
        }else{
            //hibás pw
            header("location: index.php?error=Hibás jelszó");
        }
    }else{
        //header("location: index.php?error=Nincs ilyen felhasználó");
    }
}



?>