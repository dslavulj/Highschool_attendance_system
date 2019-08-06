<?php
    require_once "config.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Stranica napravljena za natjecanje MC2">
    <meta name="author" content="Brute Force">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Evidencija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; background-color:#f2f2f2; }
        .forma{padding: 10px;margin: 0 auto;margin-left:10px }
		.table{width: 70%; margin:20px auto;}
        button{float:right;}
        @media only screen and (max-width: 600px) {
            .table {
                width: 100%;
            }
            button {
                float:left;
            }
            .forma{
                margin-top:50px;
            }
        }
    </style>
</head>
<body>
        <?php   
            $sql2 = "SELECT ime,prezime FROM ". $_SESSION["category"] ." WHERE id=" . $_SESSION["id"];
            $result2 = mysqli_query($link,$sql2);
            $value = mysqli_fetch_object($result2);
            echo "<div class='jumbotron' style='padding-top: 32px'><h2 style='float:left' class='display-6'>Dobrodošli ". $value->ime . " " . $value->prezime ."</h2>";
        ?>
    <button class="btn btn-primary" onclick="location.href='logout.php'" type="button">Odjavi se</button>
    </div>
    <div class="forma" >
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="row form" style="margin-right:0;">
            <div class="col-md-2 form-group">
                <label for="dolasci">Dolasci/Nedolasci</label>
                <?php if(!isset($_POST["dolasci"])) $_POST["dolasci"]="Nedolasci";?>
                <select class="form-control" id="dolasci" name="dolasci" onchange="this.form.submit()">
                    <option <?php if($_POST["dolasci"]=="Dolasci") echo "selected"?> value="Dolasci">Dolasci</option>
                    <option <?php if($_POST["dolasci"]=="Nedolasci") echo "selected"?> value="Nedolasci">Nedolasci</option>
                </select>
            </div>
            <div class="col-md-2 form-group" <?php if($_SESSION["category"]=="Ucenici") echo "hidden"?>>
                <label for="prra">Predmet/Razred</label>
                <?php if(!isset($_POST["prra"])) $_POST["prra"]="Predmet";?>
                <select class="form-control" name="prra" id="prra" onchange="this.form.submit()">
                    <option <?php if($_POST["prra"]=="Predmet") echo "selected"?> value="Predmet">Predmet</option>
                    <option <?php if($_POST["prra"]=="Razred") echo "selected"?> value="Razred">Razred</option>
                </select>
            </div>
            
            <div class="col-md-2 form-group" <?php if($_POST["prra"]=="Predmet" and $_SESSION["category"]=="Ucitelji"){echo "hidden";}?>>
                <label for="student" >Predmet</label>
                <?php if(!isset($_POST["subject"])) $_POST["subject"]="";?>
                <select class="form-control" name="subject" id="subject" onchange="this.form.submit()">
                    <option value="">Svi</option>
                    <?php   
                        $sql = "SELECT naziv FROM Raspored";
                        $result = mysqli_query($link,$sql);
                        while($row = $result->fetch_assoc()) {
                            if($_POST["subject"]==$row["naziv"]){
                                $sel = "selected";
                            }else $sel = "";
                            echo "<option value=". $row["naziv"] . " ". $sel .">". $row["naziv"] ."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-1 form-group" <?php if($_SESSION["category"]=="Ucenici" or $_POST["prra"]=="Razred") echo "hidden";?>>
                <label for="student" >Razred</label>
                <?php if(!isset($_POST["class"])) $_POST["class"]="";?>
                <select class="form-control" name="class" id="class" onchange="this.form.submit()"
                    <?php if($_SESSION["category"]=="Ucenici") {
                        $sql = "SELECT Razred.naziv AS naziv FROM Razred INNER JOIN Ucenici ON Ucenici.razredID = Razred.id WHERE Ucenici.id =" . $_SESSION["id"];
                        $result = mysqli_query($link,$sql);
                        $value = mysqli_fetch_object($result);
                        echo "value=". $value->naziv;
                        }
                    ?>
                >
                    <option value="">Svi</option>
                    <?php   
                        $sql = "SELECT naziv FROM Razred";
                        $result = mysqli_query($link,$sql);
                        while($row = $result->fetch_assoc()) {
                            if($_POST["class"]==$row["naziv"]){
                                $sel = "selected";
                            }else $sel = "";
                            echo "<option value=". $row["naziv"] . " ". $sel .">". $row["naziv"] ."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2 form-group" <?php if($_SESSION["category"]=="Ucenici") echo "hidden";?>>
                <label for="student" >Učenik</label>
                <select class="form-control" name="student" id="student" onchange="this.form.submit()" 
                    <?php
                        if($_SESSION["category"]=="Ucenici"){
                            $sql2 = "SELECT ime,prezime FROM Ucenici WHERE id=" . $_SESSION["id"];
                            $result2 = mysqli_query($link,$sql2);
                            $value = mysqli_fetch_object($result2);
                            echo "value=". $value->ime . " " . $value->prezime;
                        }
                    ?>
                >
                    <option value="">Svi</option>
                    <?php
                        $sql = "SELECT id,ime,prezime FROM Ucenici";
                        $result = mysqli_query($link,$sql);
                        while($row = $result->fetch_assoc()) {
                            if($_POST["student"]==($row["ime"] . " " . $row["prezime"])){
                                $sel = "selected";
                            }else $sel = "";
                            echo "<option value='". $row["ime"] . " " . $row["prezime"] . "' ". $sel .">". $row["ime"] . " " . $row["prezime"] ."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-1.5 form-group" style="padding-left:15px;">
                <label>Od</label>
                <?php if(!isset($_POST["datefrom"])) $_POST["datefrom"]=date('Y-m-d',strtotime("-14 day"));?>
                <input type="date" class="form-control" name="datefrom"
                <?php
                    if(isset($_POST["datefrom"])){
                        echo "value='". $_POST["datefrom"] ."'";
                    }else{
                        echo "value='". date('Y-m-d',strtotime("-14 days"))."'";
                    }
                ?>    
                >
            </div>   
            <div class="col-md-1.5 form-group" style="padding-left:15px;padding-right:15px">
                <label>Do</label>
                <?php if(!isset($_POST["dateto"])) $_POST["dateto"]=date('Y-m-d');?>
                <input type="date" class="form-control" name="dateto"
                <?php
                    if(isset($_POST["dateto"])){
                        echo "value='". $_POST["dateto"] ."'";
                    }else{
                        echo "value='". date('Y-m-d')."'";
                    }
                ?> 
                >
            </div>   
            <div class="form-group" style="margin-top: 24px;">
                <input type="submit" class="btn btn-success form-control" value="Filtriraj">
            </div>
        </form>
    </div>
</body>
</html>
<?php
function sqldolasciucitelj(){
    $sql="SELECT Dolasci.id, Dolasci.datum AS datum, Ucenici.ime AS ime, Ucenici.prezime as prezime, Raspored.naziv AS predmet, Raspored.skolski_sat AS sksat, Raspored.ucionicaID AS ucionica
    FROM Dolasci 
    INNER JOIN Ucenici ON Ucenici.id = Dolasci.ucenikID 
    INNER JOIN Raspored ON Raspored.id = Dolasci.rasporedID 
    INNER JOIN Razred ON Razred.id = Raspored.razredID";

    if ($_POST["prra"]=="Predmet")
    $sql = $sql . " WHERE Raspored.uciteljID = ". $_SESSION["id"];
    if ($_POST["prra"]=="Razred")
    $sql = $sql . " WHERE Razred.razrednikID = ". $_SESSION["id"];

    if ($_POST["prra"]=="Predmet" && $_POST["class"] != "") {
        $class = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["class"]);
        $sql = $sql . " AND Razred.naziv = '$class' ";
    };

    if ($_POST["prra"]=="Razred" && $_POST["subject"] != "") {
        $subject = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["subject"]);
        $sql = $sql . " AND Raspored.naziv = '$subject' ";
    };

    if (isset($_POST["datefrom"]) && isset($_POST["dateto"]) && $_POST["datefrom"] != "" && $_POST["dateto"] != "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum BETWEEN '". $datefrom ."' AND '". $dateto ."'";
    }
    elseif (isset($_POST["datefrom"]) && $_POST["datefrom"] != "" && $_POST["dateto"] == "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $sql = $sql . " AND Dolasci.datum >= '". $datefrom ."'";
    }
    elseif (isset($_POST["dateto"]) && $_POST["dateto"] != "" && $_POST["datefrom"] == "") {
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum <= '". $dateto ."'";
}
    if (isset($_POST["student"]) && $_POST["student"] != "") {
        list($ime, $prezime) = explode(" ", $_POST["student"]);
        $ime = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$ime);
        $prezime = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$prezime);
        $sql = $sql . " AND Ucenici.ime = '$ime' AND Ucenici.prezime = '$prezime' ";
    };

    $sql= $sql . " ORDER BY Dolasci.datum DESC, Raspored.skolski_sat";
    return $sql;
}

function sqlnedolasciucitelj(){
    $sql="
    SELECT DISTINCT Ucenici.id AS uid, Raspored.id AS rid, Dolasci.datum
        FROM Ucenici
        CROSS JOIN Raspored
        CROSS JOIN Dolasci
        INNER JOIN Razred ON Razred.id = Raspored.razredID 
        WHERE Ucenici.razredID = Raspored.razredID "; 
    if ($_POST["prra"]=="Predmet")
    $sql = $sql . " AND Raspored.uciteljID = ". $_SESSION["id"];
    if ($_POST["prra"]=="Razred")
    $sql = $sql . " AND Razred.razrednikID = ". $_SESSION["id"];
    $sql = $sql . " AND (Ucenici.id,Raspored.id,Dolasci.datum) NOT IN
            (SELECT ucenikID,rasporedID,datum FROM Dolasci 
                INNER JOIN Ucenici ON Ucenici.id = Dolasci.ucenikID 
                INNER JOIN Raspored ON Raspored.id = Dolasci.rasporedID 
                INNER JOIN Razred ON Razred.id = Raspored.razredID ";
    if ($_POST["prra"]=="Predmet")
    $sql = $sql . " WHERE Raspored.uciteljID = ". $_SESSION["id"];
    if ($_POST["prra"]=="Razred")
    $sql = $sql . " WHERE Razred.razrednikID = ". $_SESSION["id"];
    $sql = $sql .")";

    if ($_POST["prra"]=="Predmet" && $_POST["class"] != "") {
        $class = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["class"]);
        $sql = $sql . " AND Razred.naziv = '$class' ";
    };

    if ($_POST["prra"]=="Razred" && $_POST["subject"] != "") {
        $subject = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["subject"]);
        $sql = $sql . " AND Raspored.naziv = '$subject' ";
    };

    if (isset($_POST["datefrom"]) && isset($_POST["dateto"]) && $_POST["datefrom"] != "" && $_POST["dateto"] != "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum BETWEEN '". $datefrom ."' AND '". $dateto ."'";
    }
    elseif (isset($_POST["datefrom"]) && $_POST["datefrom"] != "" && $_POST["dateto"] == "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $sql = $sql . " AND Dolasci.datum >= '". $datefrom ."'";
    }
    elseif (isset($_POST["dateto"]) && $_POST["dateto"] != "" && $_POST["datefrom"] == "") {
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum <= '". $dateto ."'";
    }
    if (isset($_POST["student"]) && $_POST["student"] != "") {
        list($ime, $prezime) = explode(" ", $_POST["student"]);
        $ime = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$ime);
        $prezime = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$prezime);
        $sql = $sql . " AND Ucenici.ime = '$ime' AND Ucenici.prezime = '$prezime' ";
    };

    $sql= $sql . " ORDER BY Dolasci.datum DESC, Raspored.id";
    return $sql;

}

function sqldolasciucenik(){
    $sql="SELECT Dolasci.datum AS datum, Raspored.naziv AS predmet, Raspored.skolski_sat AS sksat, Raspored.ucionicaID AS ucionica FROM Dolasci
    INNER JOIN Ucenici ON Ucenici.id = Dolasci.ucenikID
    INNER JOIN Raspored ON Raspored.id = Dolasci.rasporedID
    INNER JOIN Razred ON Razred.id = Raspored.razredID 
    WHERE Ucenici.id = ". $_SESSION["id"];

    if ($_POST["subject"] != "") {
        $subject = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["subject"]);
        $sql = $sql . " AND Raspored.naziv = '$subject' ";
    };

    if (isset($_POST["datefrom"]) && isset($_POST["dateto"]) && $_POST["datefrom"] != "" && $_POST["dateto"] != "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum BETWEEN '". $datefrom ."' AND '". $dateto ."'";
    }
    elseif (isset($_POST["datefrom"]) && $_POST["datefrom"] != "" && $_POST["dateto"] == "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $sql = $sql . " AND Dolasci.datum >= '". $datefrom ."'";
    }
    elseif (isset($_POST["dateto"]) && $_POST["dateto"] != "" && $_POST["datefrom"] == "") {
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum <= '". $dateto ."'";
    }

    $sql= $sql . " ORDER BY Dolasci.datum, Raspored.skolski_sat";
    return $sql;
}

function sqlnedolasciucenik(){
    $sql2 = "SELECT Razred.id AS id FROM Razred INNER JOIN Ucenici ON Ucenici.razredID = Razred.id WHERE Ucenici.id =" . $_SESSION["id"];
    $result = mysqli_query(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$sql2);
    $value = mysqli_fetch_object($result);

    $sql="SELECT DISTINCT datum, Raspored.naziv AS predmet, Raspored.skolski_sat AS sksat, Raspored.ucionicaID AS ucionica FROM Dolasci
    INNER JOIN Ucenici ON Ucenici.id = Dolasci.ucenikID
    INNER JOIN Raspored ON Raspored.id = Dolasci.rasporedID
    WHERE Raspored.razredID = ". $value->id ." AND(rasporedID,datum) NOT IN
        (SELECT rasporedID,datum FROM Dolasci WHERE ucenikID=". $_SESSION["id"] .")" ;

    if ($_POST["subject"] != "") {
        $subject = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["subject"]);
        $sql = $sql . " AND Raspored.naziv = '$subject' ";
    };

    if (isset($_POST["datefrom"]) && isset($_POST["dateto"]) && $_POST["datefrom"] != "" && $_POST["dateto"] != "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum BETWEEN '". $datefrom ."' AND '". $dateto ."'";
    }
    elseif (isset($_POST["datefrom"]) && $_POST["datefrom"] != "" && $_POST["dateto"] == "") {
        $datefrom = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["datefrom"]);
        $sql = $sql . " AND Dolasci.datum >= '". $datefrom ."'";
    }
    elseif (isset($_POST["dateto"]) && $_POST["dateto"] != "" && $_POST["datefrom"] == "") {
        $dateto = mysqli_real_escape_string(mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME),$_POST["dateto"]);
        $sql = $sql . " AND Dolasci.datum <= '". $dateto ."'";
    }

    $sql= $sql . " ORDER BY datum, Raspored.skolski_sat";
    return $sql;
}

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
}

if ($_SESSION["category"]=="Ucitelji" && $_POST["dolasci"]=="Dolasci"){
    $sql = sqldolasciucitelj();
}
elseif ($_SESSION["category"]=="Ucitelji" && $_POST["dolasci"]=="Nedolasci"){
    $sql = sqlnedolasciucitelj();
}
elseif ($_SESSION["category"]=="Ucenici" && $_POST["dolasci"]=="Dolasci"){
    $sql = sqldolasciucenik();
}
elseif ($_SESSION["category"]=="Ucenici" && $_POST["dolasci"]=="Nedolasci"){
    $sql = sqlnedolasciucenik();
}

$result = mysqli_query($link,$sql);


if ($_SESSION["category"]=="Ucitelji" && $_POST["dolasci"]=="Dolasci"){
    echo "<div><table class='table table-hover'>
        <thead>
            <tr>
            <th scope='col'>Datum</th>
            <th scope='col'>Učenik</th>
            <th scope='col'>Školski Sat</th>
            <th scope='col'>Predmet</th>
            <th scope='col'>Učionica</th>
            <th scope='col'>Action</th>;
            </tr>
        </thead>";
        echo "<tr><form action='create.php' id='form1' method='post'>
                <td><input type='date' class='form-control' name='udate'></td>
                <td><input type='text' class='form-control' style='width: 80%;' name='uname'></td>
                <td></td>
                <td><input type='text' class='form-control' style='width: 80%;' name='uclass'></td>
                <td></td>
                <td style='padding-left: 25px'><button type='submit' style='background-color:transparent;border:none;'><a style='margin-left:-40px;' title='Izbriši 'data-toggle='tooltip' onclick='document.getElementById('form1').submit();' href='create.php'><i class='fa fa-lg fa-check' style='margin-top:10px; color:green;'></i></a></button></td>
            </form></tr>";

    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . $row['datum'] . "</td><td>" . $row['ime'] . " " . $row['prezime'] . "</td><td>" . $row['sksat'] . "</td><td>" . $row['predmet'] . "</td><td>" . $row['ucionica'] . "</td><td style='padding-left: 25px'><a href='delete.php?id=". $row['id'] ."' title='Izbriši' data-toggle='tooltip'><i class='fa fa-trash' style='color:red;'></i></a></td></tr>";
    }
    echo "</table></div>";
}elseif ($_SESSION["category"]=="Ucitelji" && $_POST["dolasci"]=="Nedolasci"){
    echo "<div><table class='table table-hover'>
        <thead>
            <tr>
            <th scope='col'>Datum</th>
            <th scope='col'>Učenik</th>
            <th scope='col'>Školski Sat</th>
            <th scope='col'>Predmet</th>
            <th scope='col'>Učionica</th>
            </tr>
        </thead>";
    while($row = mysqli_fetch_array($result)){
        $sql2 = "SELECT Ucenici.ime AS ime, Ucenici.prezime AS prezime, Raspored.naziv AS predmet, Raspored.skolski_sat AS sksat, Raspored.ucionicaID AS ucionica
        FROM Raspored
        INNER JOIN Razred ON Razred.id = Raspored.razredID
        INNER JOIN Ucenici ON Ucenici.razredID = Razred.ID
        WHERE Ucenici.id = ". $row["uid"] ." AND Raspored.id=". $row["rid"];
        $result2 = mysqli_query($link,$sql2);
        $value = mysqli_fetch_object($result2);

        echo "<tr><td>" . $row['datum'] . "</td><td>" . $value->ime . " " . $value->prezime . "</td><td>" . $value->sksat . "</td><td>" . $value->predmet . "</td><td>" . $value->ucionica . "</td></tr>";
    }
    echo "</table></div>";
}else{
    echo "<div><table class='table table-hover'>
        <thead>
            <tr>
            <th scope='col' >Datum</th>
            <th scope='col' >Školski Sat</th>
            <th scope='col' >Predmet</th>
            <th scope='col' >Učionica</th>
            </tr>
        </thead>";
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td>" . $row['datum'] . "</td><td>" . $row['sksat'] . "</td><td>" . $row['predmet'] . "</td><td>" . $row['ucionica'] . "</td></tr>";
    }
    echo "</table></div>";

}
?>