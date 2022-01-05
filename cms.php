<html>
    <head>
        <script src="js/bootstrap.bundle.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
    </head>

<?php

require_once('hub.php');

$userId = false; 
if($_COOKIE){
    if(isset($_COOKIE["LoggedAccount"])){
        $userId = $_COOKIE["LoggedAccount"];
    }
}
if(!$userId) header('Location: login.php');

$user = new user($userId);
$hub = $user->getHub();

if($hub){ ?>

    <body>
    <body>

<?php
}else{
?>

    <body>
    <body>
        
<?php
} 
?>

</html>