<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/functions.php"; ?> 
<?php

    if(isset($_POST['register'])){
        
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        $error = [
            
            'username' => '',
            'email' => '',
            'password' => ''
            
        ];
        

        if(strlen($username) < 4){
            
    $error['username'] = '<div class="alert alert-danger"><strong>Przykro mi!</strong> Nazwa Użytownika jest za krótka, min 4 znaki.
    </div>';
            
        }
        
        if($username == ''){
            
    $error['username'] = '<div class="alert alert-danger"><strong>Przykro nam! </strong>Nazwa Użytownika nie może być pusta.</div>';
            
        }
        
        if(username_exists($username)){
            
            $error['username'] = '<div class="alert alert-danger"><strong>Przykro nam! </strong>Uzytkownik już istnieje, prosimy wybrać inną nazwę.</div>';
            
        }
        
        if($email == ''){
            
            $error['email'] = '<div class="alert alert-danger"><strong>Przykro nam! </strong>Email nie może być pusty.</div>';
            
        }
        
        if(email_exists($email)){
            
            $error['email'] = '<div class="alert alert-danger"><strong>Przykro nam! </strong>Użytkownik z takim adresem email już istnieje.</div><a href="index.php" class="btn btn-primary">Proszę zalogować</a>';
            
        }
        
        if($password == ''){
            
            $error['password'] = '<div class="alert alert-danger"><strong>Przykro nam! </strong>Hasło nie może być puste.</div>';
            
        }
        
        foreach($error as $key => $value){
            
            if(empty($value)){
                
                unset($error[$key]);
                
            }
            
        }
        
        if(empty($error)){
            
            register_user($username, $email, $password);
            
        }
                        
    }
    

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    <?php isLoggedIn2(); ?>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 text-center">
                <div class="form-wrap">
                <h1>Rejestracja</h1><br>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Uzytkownik</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Wprowadz nazwe Uzytkownika" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                        </div><br>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email@gmail.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>"><p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div><br>
                         <div class="form-group">
                            <label for="password" class="sr-only">Haslo</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Haslo"><p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                        </div><br>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Zarejestruj">
                    </form><br>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

</div>

<?php include "includes/footer.php";?>
