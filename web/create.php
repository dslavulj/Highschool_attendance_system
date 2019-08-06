<?php
require_once "config.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["category"]=="Ucenici"){
        header("location: index.php");
        exit;
}
$name = $surname = $subject = $date = "";
$name_err = $surname_err = $subject_err = $date_err = "";
if(isset($_POST["uname"]) && isset($_POST["uclass"]) && isset($_POST["udate"])){
    if(str_word_count ($_POST["uname"]) != 1 && $_POST["uname"]!=""){
        list($input_name, $input_surname) = explode(" ", $_POST["uname"]);
    }else{
        $name_err = $surname_err = "Pogrešno ime";
    }

    if(empty($input_name) && empty($input_surname)){
        $name_err = $surname_err = "Ime i prezime nije uneseno ili je pogrešno";
    } else{
        $name = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$input_name);
        $surname = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$input_surname);
    }

    $input_subject = trim($_POST["uclass"]);
    if(empty($input_subject)){
        $subject_err = "Predmet nije unesen";     
    }else{
        $subject = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$input_subject);
    }

    $input_date = trim($_POST["udate"]);
    if(empty($input_date)){
        $date_err = "Datum nije unesen";     
    } else{
        $date = $input_date;
    }
    if(empty($name_err) && empty($surname_err)){
        $sql = "SELECT id FROM Ucenici WHERE ime='".$name."' AND prezime='".$surname."'";
        $result = mysqli_query($link,$sql);
        if ($result){
            $value = mysqli_fetch_object($result);
            if ($value){
                $idstudent = $value->id;
            } else $name_err = $surname_err = "Učenik ne postoji";
        }
    }
    if(empty($date_err) && $date != date('Y-m-d')){
        $sql = "SELECT id FROM Dolasci WHERE datum='". $date ."'";
        $result = mysqli_query($link,$sql);
        if ($result){
            $value = mysqli_fetch_object($result);
            if ($value){
                $idstudent = $value->id;
            } else $date_err = "Nastava se nije održala na taj dan";
        }
    }
    if(empty($subject_err)){
        $sql = "SELECT id FROM Raspored WHERE naziv='$subject'";
        $result = mysqli_query($link,$sql);
        if ($result){
            $value = mysqli_fetch_object($result);
            if ($value){
                $idsubject=$value->id;
            } else $subject_err = "Predmet ne postoji";
        }
    }
    if(empty($name_err) && empty($surname_err) && empty($subject_err) && empty($date_err)){
        $sql = "SELECT id FROM Dolasci WHERE ucenikID=". $idstudent ." AND RasporedID=". $idsubject ." AND datum='". $date . "'";
        $result = mysqli_query($link,$sql);
        if ($result){
            $value = mysqli_fetch_object($result);
            if ($value){
                $name_err = "Dolazak već postoji";
            }
        }
    }

    if(empty($name_err) && empty($surname_err) && empty($subject_err) && empty($date_err)){
        
        $sql = "INSERT INTO Dolasci (ucenikID, RasporedID, datum) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_idstudent, $param_idsubject, $param_date);

            $param_idstudent = $idstudent;
            $param_idsubject = $idsubject;
            $param_date = $date;
            if(mysqli_stmt_execute($stmt)){
                echo "
                <main class='login-form'>
                    <div class='cotainer'>
                        <div class='justify-content-center'>
                            <div class='card'>
                                <div class='card-header'>Dolazak uspješno unesen :</div>
                                <div class='card-body'>".
                                    $name . " " .$surname . "<br>" .$subject . "<br>" .$date . " <br><br> <a class='btn btn-success form-control' href='page.php'>OK</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </main>";
            } else{
                echo "Nešto je pošlo po zlu. Molimo pokušajte ponovo kasnije.";
            }
        }  
        mysqli_stmt_close($stmt);
    }else{
        echo "
        <main class='login-form'>
            <div class='cotainer'>
                <div class='justify-content-center'>
                    <div class='card'>
                        <div class='card-header'>Greška</div>
                        <div class='card-body'>";
                            if ($name_err != "") echo $name_err. "<br>";
                            if ($surname_err != "") echo $surname_err. "<br>";
                            if ($date_err != "") echo $date_err. "<br>";
                        echo "    <a class='btn btn-danger form-control' href='page.php'>OK</a></div>
                    </div>
                </div>
            </div> 
        </main>";
    }
    mysqli_close($link);
}

?>
 
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Stranica napravljena za natjecanje MC2">
    <meta name="author" content="Brute Force">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Potvrda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style type="text/css">
        body{
            margin: 0;
            font-size: .9rem sans-serif;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            width: 25%;
            padding: 20px;
            margin: 0 auto;
            margin-top: 20px;
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        @media only screen and (min-width:401px) and (max-width: 961px) {
            .login-form {
                width: 40%;
            }
        }
        @media only screen and (max-width: 600px) {
            .login-form {
                width: 100%;
            }
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body>

</body>
</html>