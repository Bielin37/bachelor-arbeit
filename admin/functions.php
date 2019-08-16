<?php

function redirect($location){
    
    return header("location:" . $location);
    
}

function escape($string){
    
    global $connection;
    
    return mysqli_real_escape_string($connection, trim($string));
    
}


function confirmQuery($result){
    
    global $connection;
    
    if(!$result){
            
            die("QUERY FAILED ." . mysqli_error($connection));
            
        }
    
}

function query($query){
    
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
    
}

function fetchRecords($result){
    
    return mysqli_fetch_array($result);
    
}

function isLoggedIn(){
    
    if(isset($_SESSION['user_role'])){
        
        return true;
        
    }else{
        
        return header("Location: ../registration.php");
        
    }
    
}

function isLoggedIn2(){
    
    if(isset($_SESSION['user_role'])){
        
        return true;
        
    }else{
        
        echo "<div class='row center-text alert alert-success'>
                <h4 style='text-align:center;' class='center-text'>Nie posiadasz jeszcze konta a chcialbyś pomóc nam w rozwoju serwisu, dołącz do nas i zacznij dzielić się swoją wiedzą kulinarną dodając nowe przepisy.</h4>
            </div>";        
    }
    
}

function loggedInUserId(){
        
    if(isLoggedIn()){
        
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
            
        }
        return false;
        
    }


function get_all_user_recipes(){
    
    return query("SELECT * FROM recipe WHERE user_id=".loggedInUserId()."");
    
}

function count_records($result){
    
    return mysqli_num_rows($result);
    
}

function insert_categories(){
    
    global $connection;
    
    if(isset($_POST['submit'])){
                                
                $cat_title = $_POST['cat_title'];
                                
                if($cat_title == "" || empty($cat_title)){
                                    
                    echo "To pole nie powinno być puste";
                                    
            }else{
                        
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUES('{$cat_title}') ";
                    
                $create_category_query = mysqli_query($connection, $query);
                    
                if(!$create_category_query){
                            
                    die('QUERY FAILED' . mysqli_error($connection));
                            
                }
                                
            }
        }
    
}


function findAllCategories(){
    
    global $connection;
    
    // FIND ALL CATEGORIES QUERY
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);
                
    while($row = mysqli_fetch_assoc($select_categories)){
                
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
                
    echo "<tr>";    
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}' class='btn btn-danger'>Usuń</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}' class='btn btn-primary'>Edytuj</a></td>";
    echo "</tr>";
            
        }
    
}


function deleteCategories(){
    
    global $connection;
    
    // DELETE QUERY                           
        if(isset($_GET['delete'])){
                    
            $the_cat_id = $_GET['delete'];
                    
            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
            $delete_query = mysqli_query($connection, $query);
            header("Location: categories.php");
                    
        }
    
}

function is_admin(){
        
    if(isLoggedIn()){
    
    $result = query("SELECT user_role FROM users WHERE user_id=".$_SESSION['user_id']."");
    $row = fetchRecords($result);
    if($row['user_role'] == 'Administrator'){
        
        return true;
        
    }else{
        
        return false;
        
    }
    }
    return false;
}

function is_user(){
        
    if(isLoggedIn()){
    
    $result = query("SELECT user_role FROM users WHERE user_id=".$_SESSION['user_id']."");
    $row = fetchRecords($result);
    if($row['user_role'] == 'Uzytkownik'){
        
        return true;
        
    }else{
        
        return false;
        
    }
    }
    return false;
}

function username_exists($username){
    
    global $connection;
    
    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0){
        
        return true; 
        
    }else{
        
        return false;
        
    }
     
    }
    
function email_exists($email){
    
    global $connection;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0){
        
        return true; 
        
    }else{
        
        return false;
        
    }
    
    }

function register_user($username, $email, $password){
    
    global $connection;
        
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
            
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
    $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES('$username', '$email', '$password', 'Uzytkownik')";
    $registration_user_query = mysqli_query($connection, $query);
    
    confirmQuery($registration_user_query);  
    
    redirect("/cms/index.php");

        
    }


function login_user($username, $password){
    
    global $connection;
    
    $username = trim($username);
    $password = trim($password);
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_user_query = mysqli_query($connection, $query);
    
    
    while($row = mysqli_fetch_array($select_user_query)){
        
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        
    }
        
    if(password_verify($password, $db_user_password)){
        
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        
        redirect("/cms/admin");
        
    } else {
        
        redirect("../index.php");
       
    }
    
} ?>