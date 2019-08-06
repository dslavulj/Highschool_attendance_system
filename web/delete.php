<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["category"]=="Ucenici"){
            header("location: index.php");
            exit;
    }
    require_once "config.php";
    $sql = "DELETE FROM Dolasci WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_POST["id"]);
        if(mysqli_stmt_execute($stmt)){
            header("location: page.php");
            exit();
        } else{
            echo "Nešto je pošlo po zlu. Molimo pokušajte ponovo kasnije.";
        }
    }
     
    mysqli_stmt_close($stmt);
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
    <title>Brisanje</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Izbriši zapis</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Jeste li sigurni da želite izbrisati taj zapis?</p><br>
                            <p>
                                <input type="submit" value="Da" class="btn btn-danger">
                                <a href="page.php" class="btn btn-default">Ne</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>