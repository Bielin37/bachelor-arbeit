<div class="table-responsive"> 
 <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Uzytkownik</th>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <th>Rola</th>
                </tr>
            </thead>
            <tbody>
                                
    <?php
                                
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
                                
        while($row = mysqli_fetch_assoc($select_users)){
            
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];

            
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            echo "<td><a href='users.php?change_to_admin=$user_id'>Administrator</a></td>";
            echo "<td><a href='users.php?change_to_subscriber=$user_id'>Uzytkownik</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edytuj</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Usuń</a></td>";

            echo "</tr>";
            
        }                        
    
    ?>   
                </tbody>
                </table>
</div>   

<?php

if(isset($_GET['change_to_admin'])){
    
    $the_user_id = escape($_GET['change_to_admin']);
    
    $query = "UPDATE users SET user_role = 'Administrator' WHERE user_id = $the_user_id ";
    $change_to_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
    
}


if(isset($_GET['change_to_subscriber'])){
    
    $the_user_id = escape($_GET['change_to_subscriber']);
    
    $query = "UPDATE users SET user_role = 'Uzytkownik' WHERE user_id = $the_user_id ";
    $change_to_subscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");
    
}


if(isset($_GET['delete'])){
    
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role'] == 'Administrator'){     
    
    $the_user_id = mysqli_real_escape_string(escape($_GET['delete']));
    
    $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
    
        }
        
    }
}

?>             