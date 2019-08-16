<?php

    if(isset($_GET['edit_user'])){
        
        $the_user_id = escape($_GET['edit_user']);
        
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_users_query = mysqli_query($connection, $query);
                                
        while($row = mysqli_fetch_assoc($select_users_query)){
            
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        
        }
        
    }

    if(isset($_POST['edit_user'])) {
        
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_role = escape($_POST['user_role']);
        $username = escape($_POST['username']);
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);
        
        if(!empty($user_password)){
        
        $query_password = "SELECT * FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQuery($get_user_query);
        
        $row = mysqli_fetch_array($get_user_query);
        
        $db_user_password = $row['user_password'];
        
            if($db_user_password != $user_password){
                
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                
            }    
        
        $query = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_role = '$user_role', username = '$username', user_email = '$user_email', user_password = '$hashed_password' WHERE user_id = $the_user_id ";
        
        $edit_user_query = mysqli_query($connection, $query);
        
        confirmQuery($edit_user_query);
            
            echo "Uzytkownik Zaktualizowany" . "<a href='users.php'> Pokaz Uzytkownikow</a>";
        
        }
        
    } 

?>
   

    <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">      
        <label for="user_firstname">Imie</label>
        <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
    </div>
       
    <div class="form-group">   
        <label for="user_lastname">Nazwisko</label>
        <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <label for="user_role">Rola</label><br>
        <select name="user_role" id="">
        <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        
           <?php
            
                if($user_role == 'Administrator'){
                    
                    echo "<option value='Uzytkownik'>Użytkownik</option>";
                
                }else{
                    
                    echo "<option value='Administrator'>Administrator</option>";
                    
                }
            
            ?>
           
        </select>
    </div>
    
    <div class="form-group">
        <label for="username">Uzytkownik</label>
        <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="user_email">Email</label>
        <input autocomplete="off" class="form-control" type="email" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="user_password">Haslo</label>
        <input  autocomplete="off" class="form-control" type="password" name="user_password">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edytuj Użytkownika">
    </div>
    
</form>