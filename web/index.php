<?php
session_start();
 
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Unesite korisničko ime.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Unesite svoju zaporku.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, lozinka FROM Ucenici WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["category"] = "Ucenici";
                            header("location: page.php");
                        } else{
                            $password_err = "Zaporka koju ste unijeli nije valjana.";
                        }
                    }
                } else{
                    $sql = "SELECT id, username, lozinka FROM Ucitelji WHERE username = ?";
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        $param_username = $username;
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) == 1){                    
                                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                                if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($password, $hashed_password)){
                                        session_start();
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;                            
                                        $_SESSION["category"] = "Ucitelji";
                                        header("location: page.php");
                                    } else{
                                        $password_err = "Zaporka koju ste unijeli nije valjana.";
                                    }
                                }
                            }else{
                                $username_err = "Nije pronađen korisnički račun s tim korisničkim imenom.";
                            }
                        }
                    }
                }
            } else{
                echo "Nešto je pošlo po zlu. Molimo pokušajte ponovo kasnije.";
            }
        }
        
        mysqli_stmt_close($stmt);
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
    <title>Prijava</title>
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
    <main class="login-form">
        <div class="cotainer">
            <div class="justify-content-center">
                <div class="card">
                    <div class="card-header">Prijava</div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">
                            <div class="form-group row <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> required">
                                <label class="control-label requiredField col-form-label text-md-right">Korisničko ime</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" autofocus>
                                <span class="help-block"><?php echo $username_err; ?></span>
                            </div>

                            <div class="form-group row <?php echo (!empty($password_err)) ? 'has-error' : ''; ?> required">
                                <label class="control-label requiredField col-form-label text-md-right">Lozinka</label>
                                <input type="password" name="password" class="form-control">
                                <span class="help-block"><?php echo $password_err; ?></span>
                            </div>

                            <div class="controls">
                                <input type="submit" class="btn btn btn-primary" value="Prijavi se">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </main>  
</body>
</html>