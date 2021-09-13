<?php
session_start();
define('ROOT', '../');

$host     = 'localhost';
$dbname   = 'cbe_test';
$username = 'root';
$password = '';
try {
    $conn                 = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
    $_SESSION['verified'] = true;
    if (isset($_SESSION['verified'])) {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $settingSql = $conn->prepare("SELECT * FROM settings");
        $settingSql->execute();
        if ($settingSql->rowCount() == 0) {
            echo displayError("<h3 class='text-center'>Opps! The software has not been installed. Please run installer setup.</h3>");
        } else {
            $config = $settingSql->fetch(PDO::FETCH_ASSOC);

            $settingSql = $conn->prepare("SELECT active FROM ongoing_exam WHERE active='1'");
            $settingSql->execute();
            if ($settingSql->rowCount() > 0) {
                $ongoing_exam = true;
            }
        }
    } else {
        echo displayError("<h3 class='text-center'>Opps! The server coundn't verify this software.</h3>");
        exit();
    }
} catch (PDOException $e) {
    echo displayError("<h3 class='text-center'>Opps! The server coundn't connect to database.</h3>");
    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = addslashes($data);
    return $data;
}

function encrypt($string)
{
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv  = 'my_simple_secret_iv';

    $output         = false;
    $encrypt_method = "AES-256-CBC";
    $key            = hash('sha256', $secret_key);
    $iv             = substr(hash('sha256', $secret_iv), 0, 16);
    $output         = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    return $output;
}
function decrypt($string)
{
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv  = 'my_simple_secret_iv';

    $output         = false;
    $encrypt_method = "AES-256-CBC";
    $key            = hash('sha256', $secret_key);
    $iv             = substr(hash('sha256', $secret_iv), 0, 16);
    $output         = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function uploadMultiple($userfile, $file_name, $level)
{
    $all_files = "";
    for ($i = 0; $i < count($userfile['name']); $i++) {
        $filetmp   = $userfile["tmp_name"][$i];
        $filename  = $userfile["name"][$i];
        $ext       = pathinfo($filename, PATHINFO_EXTENSION);
        $filenamee = $file_name . "-" . time();
        $filetype  = $userfile["type"][$i];
        $filepath  = $filenamee . "-" . $i . "." . $ext;
        $all_files .= $filepath . ";";

        move_uploaded_file($filetmp, $level . "publications/attachments/" . $filepath);
    }
    return $all_files;
}
function displayError($message)
{
    return '<div class="msgElement alert alert-danger text-center">' . $message . '</div>';
}

function displayWarning($message)
{
    return '<div class="msgElement alert alert-warning text-center">' . $message . '</div>';
}

function displaySuccess($message)
{
    return '<div class="msgElement alert alert-success text-center">' . $message . '</div>';
}

function displayInformation($message)
{
    return '<div class="msgElement alert alert-info text-center">' . $message . '</div>';
}
function getRowCount($table, $query_string, $key)
{
    global $conn;
    $q = $conn->prepare("SELECT $query_string FROM $table WHERE $query_string='$key' ");
    $q->execute();
    return $q->rowCount();
}
function countRow($table, $query_string)
{
    global $conn;
    $q = $conn->prepare("SELECT $query_string FROM $table");
    $q->execute();
    return $q->rowCount();
}
function getValue($a, $b, $c, $d)
{
    global $conn;
    $query = $conn->prepare("SELECT $c,$d FROM $a WHERE $b='$d'");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if (($query->rowCount()) == 0) {
        return '0';
    }
    return $row[$c];
}

function uploadFile($userfile, $document_type, $page_level)
{
    $file      = '';
    $filetmp   = $userfile["tmp_name"];
    $filename  = $userfile["name"];
    $ext       = pathinfo($filename, PATHINFO_EXTENSION);
    $filenamee = $document_type . "_" . time();
    $filetype  = $userfile["type"];
    $filepath  = $filenamee . "." . $ext;
    $file .= $filepath;
    if ($page_level == 'child' || '../') {
        if (!file_exists("../uploads")) {
            mkdir("../uploads");
        }
        if (move_uploaded_file($filetmp, "../uploads/" . $filepath)) {
            return $file;
        } else {
            return '0';
        }
    } elseif ($page_level == 'grand-child' || '../../') {
        if (!file_exists("../../uploads")) {
            mkdir("../../uploads");
        }
        if (move_uploaded_file($filetmp, "../../uploads/" . $filepath)) {
            return $file;
        } else {
            return '0';
        }
    } elseif ($page_level ==  '../../../') {
        if (!file_exists("../../../uploads")) {
            mkdir("../../../uploads");
        }
        if (move_uploaded_file($filetmp, "../../../uploads/" . $filepath)) {
            return $file;
        } else {
            return '0';
        }
    } else {
        if (!file_exists("uploads")) {
            mkdir("uploads");
        }
        if (move_uploaded_file($filetmp, "uploads/" . $filepath)) {
            return $file;
        } else {
            return '0';
        }
    }
}
function uploadFile2($userfile, $document_type, $page_level)
{
    $file      = '';
    $filetmp   = $userfile["tmp_name"];
    $filename  = $userfile["name"];
    $ext       = pathinfo($filename, PATHINFO_EXTENSION);
    $filenamee = $document_type . "_" . time();
    $filetype  = $userfile["type"];
    $filepath  = $filenamee . "." . $ext;
    $file .= $filepath;
    if (!file_exists("$page_level/uploads")) {
        mkdir("$page_level/uploads");
    }
    if (move_uploaded_file($filetmp, "$page_level/uploads/" . $filepath)) {
        return $file;
    } else {
        return '0';
    }
}
