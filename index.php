<?php 
$utenteLoggato = false;


define("DB_SERVERNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","root");
define("DB_NAME","university");




if(isset($_POST['email']) && isset($_POST['password'])) {
    // var_dump($_POST);
    $connection = new mysqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD, DB_NAME, 3306);

    if($connection && $connection->connect_error) {
        echo "Connection failed:" . $connection->connect_error; 
    }
    $query = "  SELECT * FROM `students` 
                WHERE `students`.`email` = '" . $_POST['email'] . "'
                AND `students`.`password`= '".  $_POST['password'] . "';";
    $rispostaQuery = $connection->query($query);
    
    if($rispostaQuery && $rispostaQuery->num_rows > 0) {
        while($ennupla = $rispostaQuery->fetch_assoc()){
            // var_dump($ennupla);
            // echo $ennupla['name'];
            $utenteLoggato = true;
        }
    } else {
        echo 'Non ho trovato nulla oppure la query non è corretta';
    }
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP University</title>
    <!-- link css -->
    <link rel="stylesheet" href="./styles/style.css">
    <!-- link bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body id="my-body">
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <?php if(!$utenteLoggato) {?>
                <form class="col-12" action="./index.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <?php } else {
                    $query = "SELECT * FROM `students` WHERE `students`.`id` < 10";
                    $rispostaQuery = $connection->query($query);
                    
                    if($rispostaQuery && $rispostaQuery->num_rows > 0) {
                        while($ennupla = $rispostaQuery->fetch_assoc()){
                            // var_dump($ennupla);
                            echo $ennupla['name'].' '.$ennupla['surname'] . ' <br> ';
                        }
                    } else {
                        echo 'Non ho trovato nulla oppure la query non è corretta';
                    }?>

                <?php } ?>
            </div>
        </div>
    </main>
</body>
</html>