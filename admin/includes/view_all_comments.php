<?php

    if(isset($_POST['checkBoxArray'])){
        
        foreach($_POST['checkBoxArray'] as $commentValueId){
            
            $bulk_options = escape($_POST['bulk_options']);
            
            switch($bulk_options){
                case 'Zaakceptowany':
                    $query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = '$commentValueId'";
                    
                    $update_to_approved_status = mysqli_query($connection, $query);
                    
                break;
                    
                case 'Niezaakceptowany':
                    $query = "UPDATE comments SET comment_status = '$bulk_options' WHERE comment_id = '$commentValueId'";
                    
                    $update_to_unapproved_status = mysqli_query($connection, $query);
                    
                break;
                    
                case 'Usun':
                    $query = "DELETE FROM comments WHERE comment_id = '$commentValueId'";
                    
                    $update_to_DELETE_status = mysqli_query($connection, $query);
                    
                break;
                    
            }
            
        }
        
    }

?>

<form action="" method="post">

<div class="table-responsive"> 
 <table class="table table-bordered table-hover">
           
           <div id="bulkOptionContainer" class="col-xs-4">
               
            <select class="form-control" name="bulk_options" id="">
                
                <option value="">Wybierz Opcje</option>
                <option value="Zaakceptowany">Zaakceptowany</option>
                <option value="Niezaakceptowany">Niezaakceptowany</option>
                <option value="Usun">Usuń</option>

                
            </select>   
               
            </div>
            
            <div class="col-xs-4">
                
                <input type="submit" name="submit" class="btn btn-success" value="Akceptuj">
                
            </div>
           
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Autor</th>
                    <th>Treść</th>
                    <th>Email</th>
                    <th>Zobacz Przepis</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Akceptacja</th>
                    <th>Brak akceptacji</th>
                    <th>Usuń</th>
                </tr>
            </thead>
            <tbody>
                                
    <?php
                                
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);
                                
        while($row = mysqli_fetch_assoc($select_comments)){
            
            $comment_id = $row['comment_id'];
            $comment_recipe_id = $row['comment_recipe_id'];
            $comment_author = $row['comment_author'];
            $comment_content = substr($row['comment_content'],0,20);
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            
            echo "<tr>";
            ?>
            
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $comment_id; ?>"></td>
            
            <?php
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>";
            
            $query = "SELECT * FROM recipe WHERE recipe_id = $comment_recipe_id ";
            $select_recipe_id_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_recipe_id_query)){
                
                $recipe_id = $row['recipe_id'];
                $recipe_title = $row['recipe_title'];
                
                echo "<td><a href='recipe.php?r_id=$recipe_id'>$recipe_title</a></td>";    
                    
            } 
            
            echo "<td>$comment_status</td>";         echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id' class='btn btn-success'>Zatwierdz</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id' class='btn btn-warning'>Nie zatwierdzaj</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id' class='btn btn-danger'>Usuń</a></td>";


            echo "</tr>";
            
        }                        
    
    ?>   
                </tbody>
                </table>
</div>
</form>   

<?php

if(isset($_GET['approve'])){
    
    $the_comment_id = escape($_GET['approve']);
    
    $query = "UPDATE comments SET comment_status = 'Zaakceptowany' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    
}


if(isset($_GET['unapprove'])){
    
    $the_comment_id = escape($_GET['unapprove']);
    
    $query = "UPDATE comments SET comment_status = 'Niezaakceptowany' WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    
}


if(isset($_GET['delete'])){
    
    $the_comment_id = escape($_GET['delete']);
    
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    
}

?>             