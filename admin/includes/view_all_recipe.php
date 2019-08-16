<?php

    if(isset($_POST['checkBoxArray'])){
        
        foreach($_POST['checkBoxArray'] as $recipeValueId){
            
            $bulk_options = escape($_POST['bulk_options']);
            
            switch($bulk_options){
                case 'Zaakceptowana':
                    $query = "UPDATE recipe SET recipe_status = '$bulk_options' WHERE recipe_id = '$recipeValueId'";
                    
                    $update_to_approved_status = mysqli_query($connection, $query);
                    
                break;
                    
                case 'Niezaakceptowana':
                    $query = "UPDATE recipe SET recipe_status = '$bulk_options' WHERE recipe_id = '$recipeValueId'";
                    
                    $update_to_unapproved_status = mysqli_query($connection, $query);
                    
                break;
                    
                case 'Usun':
                    $query = "DELETE FROM recipe WHERE recipe_id = '$recipeValueId'";
                    
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
                <option value="Zaakceptowana">Zaakceptowana</option>
                <option value="Niezaakceptowana">Niezaakceptowana</option>
                <option value="Usun">Usuń</option>

                
            </select>   
               
            </div>
            
            <div class="col-xs-4">
                
                <input type="submit" name="submit" class="btn btn-success" value="Akceptuj">
                <a class="btn btn-primary" href="recipes.php?source=add_recipe">Dodaj Nową</a>
                
            </div>
           
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Autor</th>
                    <th>Tytuł</th>
                    <th>Kategoria</th>
                    <th>Status</th>
                    <th>Obraz</th>
                    <th>Komentarze</th>
                    <th>Data dodania</th>
                    <th>Pokaz</th>
                    <th>Edycja</th>
                    <th>Usuwanie</th>
                    <th>Liczba odwiedzin</th>
                </tr>
            </thead>
            <tbody>
                                
    <?php
                                
        $query = "SELECT * FROM recipe";
        $select_recipe = mysqli_query($connection, $query);
                                
        while($row = mysqli_fetch_assoc($select_recipe)){
            
            $recipe_id = $row['recipe_id'];
            $recipe_author = $row['recipe_author'];
            $recipe_title = $row['recipe_title'];
            $recipe_category_id = $row['recipe_category_id'];
            $recipe_status = $row['recipe_status'];
            $recipe_image = $row['recipe_image'];
            $recipe_comment_count = $row['recipe_comment_count'];
            $recipe_date = $row['recipe_date'];
            $recipe_views_count = $row['recipe_views_count'];
            
            echo "<tr>";
            
            ?>
            
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $recipe_id; ?>"></td>
            
            <?php
            
            echo "<td>$recipe_id</td>";
            echo "<td>$recipe_author</td>";
            echo "<td>$recipe_title</td>";
            
            $query = "SELECT * FROM categories WHERE cat_id = $recipe_category_id";
                $select_categories_id = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($select_categories_id)){
                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            
            echo "<td>$cat_title</td>";
            
                }
                    
            echo "<td>$recipe_status</td>";
            echo "<td><img width='50' height='50' src='../images/$recipe_image' alt='image'></td>";
            
            $query = "SELECT * FROM comments WHERE comment_recipe_id = '$recipe_id'";
            $send_comment_query = mysqli_query($connection, $query);
            
            $row = mysqli_fetch_array($send_comment_query);
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_comment_query);
            
            echo "<td><a href='recipe_comments.php?id=$recipe_id'>$count_comments</a></td>";
            echo "<td>$recipe_date</td>";
            echo "<td><a href='../recipe.php?r_id=$recipe_id' class='btn btn-primary'>Pokaz Przepis</a></td>";
            echo "<td><a href='recipes.php?source=edit_recipe&r_id=$recipe_id' class='btn btn-success'>Edytuj</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Jesteś pewien że chcesz usunąć?'); \" href='recipes.php?delete=$recipe_id' class='btn btn-danger'>Usuń</a></td>";
            echo "<td>$recipe_views_count</td>";
            echo "</tr>";
            
        }                        
    
    ?>   
                </tbody>
                </table>
</div> 
</form>  

<?php

if(isset($_GET['delete'])){
    
    $the_recipe_id = escape($_GET['delete']);
    
    $query = "DELETE FROM recipe WHERE recipe_id = {$the_recipe_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: recipes.php");
    
}

?>             