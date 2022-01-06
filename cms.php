<html>
    <head>
        <script src="js/bootstrap.bundle.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" />
    </head>






    <body>
    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
                        <h3 class="text-center text-black pt-3">new hub</h3>

                        <form method="post" id="formSG" class="mb-3">
                            <span id="errorsSpanSG"></span>
                            <div class="form-outline mb-4 ">
                                <label for="exampleFormControlInput1" class="form-label">title</label>
                                <input type="text" class="form-control" name="hubTitle" id="hubTitle">
                            </div>
                            <div class="form-outline mb-4">
                                <label for="exampleFormControlInput1" class="form-label">description</label>
                                <input type="password" class="form-control" name="hubDescription" id="hubDescription" >
                            </div>
                          
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="submit" class="btn btn-primary" id="creatbutt" value="create"></input>

                            </div>
                        </form>
                    </div>
        
    <body>











<?php

require_once('classes/hub.php');

$userId = false; 
if($_COOKIE){
    if(isset($_COOKIE["LoggedAccount"])){
        $userId = $_COOKIE["LoggedAccount"];
    }
}
// if(!$userId) header('Location: login.php');

$user = new user($userId);
$hub = $user->getHub();

if($hub){ ?>

    <body>
    <body>

<?php
}else{
?>

    <body>
    <div class="titrehub col-2 p-5 " style="background: red;">
    <h1>New Hub</h1>
    <h3>ShareHub</h3>
</div>
    <div id="loginform" class="container-sm col-4 border border-dark  " style=" border-radius:40px; ">
                        <h3 class="text-center text-black pt-3">new connard</h3>

                        <form method="post" id="formSG" class="mb-3">
                            <span id="errorsSpanSG"></span>
                            <div class="form-outline mb-4 ">
                                <label for="exampleFormControlInput1" class="form-label">title</label>
                                <input type="text" class="form-control" name="hubTitle" id="hubTitle">
                            </div>
                            <div class="form-outline mb-4">
                                <label for="exampleFormControlInput1" class="form-label">description</label>
                                <input type="password" class="form-control" name="hubDescription" id="hubDescription" >
                            </div>
                          
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="submit" class="btn btn-primary" id="creatbutt" value="create"></input>

                            </div>
                        </form>
                    </div>
        
    <body>
        
<?php
} 
?>























</html>