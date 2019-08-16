        <?php

        if(isset($_GET['r_id'])){
            
            $the_recipe_id = escape($_GET['r_id']);
            
        }

        $query = "SELECT * FROM recipe WHERE recipe_id = $the_recipe_id ";
        $select_recipe_by_id = mysqli_query($connection, $query);
                                
        while($row = mysqli_fetch_assoc($select_recipe_by_id)){
            
            $recipe_id = $row['recipe_id'];
            $recipe_author = $row['recipe_author'];
            $recipe_title = $row['recipe_title'];
            $recipe_category_id = $row['recipe_category_id'];
            $recipe_status = $row['recipe_status'];
            $recipe_image = $row['recipe_image'];
            $recipe_ingredient_1 = $row['recipe_ingredient_1'];
            $recipe_ingredient_2 = $row['recipe_ingredient_2'];
            $recipe_ingredient_3 = $row['recipe_ingredient_3'];
            $recipe_ingredient_4 = $row['recipe_ingredient_4'];
            $recipe_ingredient_5 = $row['recipe_ingredient_5'];
            $recipe_ingredient_6 = $row['recipe_ingredient_6'];
            $recipe_ingredient_7 = $row['recipe_ingredient_7'];
            $recipe_ingredient_8 = $row['recipe_ingredient_8'];
            $recipe_ingredient_9 = $row['recipe_ingredient_9'];
            $recipe_proportion_1 = escape($row['recipe_proportion_1']);
            $recipe_proportion_2 = escape($row['recipe_proportion_2']);
            $recipe_proportion_3 = escape($row['recipe_proportion_3']);
            $recipe_proportion_4 = escape($row['recipe_proportion_4']);
            $recipe_proportion_5 = escape($row['recipe_proportion_5']);
            $recipe_proportion_6 = escape($row['recipe_proportion_6']);
            $recipe_proportion_7 = escape($row['recipe_proportion_7']);
            $recipe_proportion_8 = escape($row['recipe_proportion_8']);
            $recipe_proportion_9 = escape($row['recipe_proportion_9']);
            $recipe_content = $row['recipe_content'];
            $recipe_comment_count = $row['recipe_comment_count'];
            $recipe_date = $row['recipe_date'];
            
        }

        if(isset($_POST['update_recipe'])){
            
            $recipe_category_id = escape($_POST['recipe_category']);
            $recipe_title = escape($_POST['recipe_title']);
            $recipe_author = escape($_POST['author']);        
            $recipe_image = escape($_FILES['image']['name']);
            $recipe_image_temp = escape($_FILES['image']['tmp_name']);
            $recipe_content = escape($_POST['recipe_content']);
            $recipe_ingredient_1 = escape($_POST['recipe_ingredient_1']);
            $recipe_ingredient_2 = escape($_POST['recipe_ingredient_2']);
            $recipe_ingredient_3 = escape($_POST['recipe_ingredient_3']);
            $recipe_ingredient_4 = escape($_POST['recipe_ingredient_4']);
            $recipe_ingredient_5 = escape($_POST['recipe_ingredient_5']);
            $recipe_ingredient_6 = escape($_POST['recipe_ingredient_6']);
            $recipe_ingredient_7 = escape($_POST['recipe_ingredient_7']);
            $recipe_ingredient_8 = escape($_POST['recipe_ingredient_8']);
            $recipe_ingredient_9 = escape($_POST['recipe_ingredient_9']);
            $recipe_proportion_1 = escape($_POST['recipe_proportion_1']);
            $recipe_proportion_2 = escape($_POST['recipe_proportion_2']);
            $recipe_proportion_3 = escape($_POST['recipe_proportion_3']);
            $recipe_proportion_4 = escape($_POST['recipe_proportion_4']);
            $recipe_proportion_5 = escape($_POST['recipe_proportion_5']);
            $recipe_proportion_6 = escape($_POST['recipe_proportion_6']);
            $recipe_proportion_7 = escape($_POST['recipe_proportion_7']);
            $recipe_proportion_8 = escape($_POST['recipe_proportion_8']);
            $recipe_proportion_9 = escape($_POST['recipe_proportion_9']);
            $recipe_status = escape($_POST['recipe_status']);
            
            move_uploaded_file($recipe_image_temp, "../images/$recipe_image" );
            
            if(empty($recipe_image)){
                
                $query = "SELECT * FROM recipe WHERE recipe_id = $the_recipe_id ";
                $select_image = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_array($select_image)){
                    
                    $recipe_image = $row['recipe_image'];
                    
                }
                
            }
            
            $query = "UPDATE recipe SET recipe_title = '$recipe_title', recipe_category_id = '$recipe_category_id', recipe_date = now(), recipe_author = '$recipe_author', recipe_status = '$recipe_status', recipe_ingredient_1 = '$recipe_ingredient_1', recipe_ingredient_2 = '$recipe_ingredient_2', recipe_ingredient_3 = '$recipe_ingredient_3', recipe_ingredient_4 = '$recipe_ingredient_4', recipe_ingredient_5 = '$recipe_ingredient_5', recipe_ingredient_6 = '$recipe_ingredient_6', recipe_ingredient_7 = '$recipe_ingredient_7', recipe_ingredient_8 = '$recipe_ingredient_8', recipe_ingredient_9 = '$recipe_ingredient_9', recipe_proportion_1 = '$recipe_proportion_1', recipe_proportion_2 = '$recipe_proportion_2', recipe_proportion_3 = '$recipe_proportion_3', recipe_proportion_4 = '$recipe_proportion_4', recipe_proportion_5 = '$recipe_proportion_5', recipe_proportion_6 = '$recipe_proportion_6', recipe_proportion_7 = '$recipe_proportion_7', recipe_proportion_8 = '$recipe_proportion_8', recipe_proportion_9 = '$recipe_proportion_9', recipe_content = '$recipe_content', recipe_image = '$recipe_image'  WHERE recipe_id = '$the_recipe_id' ";
            
            $update_recipe = mysqli_query($connection, $query);
            
            confirmQuery($update_recipe);
            
            echo "<p class='bg-success'>Receptura zostala zaktualizowana. <a href='../recipe.php?r_id=$the_recipe_id'>Pokaz Recepture</a> lub <a href='recipes.php'>Edytuj Wiecej Receptur</a></p>";
        
        }

?>
   

   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Nazwa przepisu</label>
        <input class="form-control" value="<?php echo $recipe_title; ?>" type="text" name="recipe_title" class="form-control"> 
    </div>
    
    <div class="form-group">
        <label for="category">Kategoria Receptury</label><br>
        <select class="form-control" name="recipe_category" id="recipe_category_id">
            
            <?php
                                    
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection,$query);
            
                confirmQuery($select_categories);
                
                while($row = mysqli_fetch_assoc($select_categories)){
                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title']; 
                 
                    echo "<option value='$cat_id'>$cat_title</option>";
                
                }
                    
            ?>
            
        </select>
    </div>
    
    <div class="form-group">      
        <label for="title">Autor Przepisu</label>
        <input value="<?php echo $recipe_author; ?>" type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
      <label for="status">Status Receptury</label>
       <br><select class="form-control" name="recipe_status" id="">
        
        <option value='<?php echo $recipe_status; ?>'>Wybierz Status</option>
        
        <?php
        
          if($recipe_status == '' ){
              
              echo "<option value='Niezaakceptowana'>Niezaakceptowana</option>";
              echo "<option value='Zaakceptowana'>Zaakceptowana</option>";
              
          } 
        
        ?>    
        
        </select>
        </div>
    
    <div class="form-group">
        <img width="100" src="../images/<?php echo $recipe_image; ?>" alt=""> <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="recipe_ingredient_1">Składniki Przepisu</label><br><br>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Składnik 1</th>
      <th scope="col">Ilość 1</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_1" value="<?php echo $recipe_ingredient_1; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_1" value="<?php echo $recipe_proportion_1; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 2</th>
      <th scope="col">Ilość 2</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_2" value="<?php echo $recipe_ingredient_2; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_2" value="<?php echo $recipe_proportion_2; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 3</th>
      <th scope="col">Ilość 3</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_3" value="<?php echo $recipe_ingredient_3; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_3" value="<?php echo $recipe_proportion_3; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 4</th>
      <th scope="col">Ilość 4</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_4" value="<?php echo $recipe_ingredient_4; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_4" value="<?php echo $recipe_proportion_4; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 5</th>
      <th scope="col">Ilość 5</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_5" value="<?php echo $recipe_ingredient_5; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_5" value="<?php echo $recipe_proportion_5; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 6</th>
      <th scope="col">Ilość 6</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_6" value="<?php echo $recipe_ingredient_6; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_6" value="<?php echo $recipe_proportion_6; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 7</th>
      <th scope="col">Ilość 7</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_7" value="<?php echo $recipe_ingredient_7; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_7" value="<?php echo $recipe_proportion_7; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 8</th>
      <th scope="col">Ilość 8</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_8" value="<?php echo $recipe_ingredient_8; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_8" value="<?php echo $recipe_proportion_8; ?>"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 9</th>
      <th scope="col">Ilość 9</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_9" value="<?php echo $recipe_ingredient_9; ?>"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_9" value="<?php echo $recipe_proportion_9; ?>"></div>
        </td>
    </tr>
  </tbody>
</table>
</div>
    <div class="form-group">
        <label for="recipe_content">Opis przygotowania potrawy</label>
        <textarea class="form-control" name="recipe_content" id="editor" cols="30" rows="10"><?php echo $recipe_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_recipe" value="Zaktualizuj Przepis">
    </div>
       </div>
</form>