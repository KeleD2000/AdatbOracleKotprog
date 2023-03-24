<?php 

define('HOST','localhost/xe');
define('USERNAME','SYSTEM');
define('PASSWORD','oracle');

try {
    $con = oci_connect(USERNAME, PASSWORD, HOST);
} catch (Exception $e) {
    die($e->getMessage());
}