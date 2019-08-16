<?php

    if(isset($_POST['create_recipe'])) {
        
        $recipe_category_id = escape($_POST['recipe_category_id']);
        $recipe_title = escape($_POST['title']);
        $recipe_author = escape($_POST['author']);
        $recipe_date = escape(date('d-m-y'));
        
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

        move_uploaded_file($recipe_image_temp, "../images/$recipe_image" );
        
        $query = "INSERT INTO recipe (recipe_category_id, recipe_title, recipe_author, recipe_date, recipe_image, recipe_content, recipe_ingredient_1, recipe_ingredient_2, recipe_ingredient_3, recipe_ingredient_4, recipe_ingredient_5, recipe_ingredient_6, recipe_ingredient_7, recipe_ingredient_8, recipe_ingredient_9, recipe_proportion_1, recipe_proportion_2, recipe_proportion_3, recipe_proportion_4, recipe_proportion_5, recipe_proportion_6, recipe_proportion_7, recipe_proportion_8, recipe_proportion_9) VALUES('$recipe_category_id', '$recipe_title', '$recipe_author', now(), '$recipe_image', '$recipe_content', '$recipe_ingredient_1', '$recipe_ingredient_2', '$recipe_ingredient_3', '$recipe_ingredient_4', '$recipe_ingredient_5', '$recipe_ingredient_6', '$recipe_ingredient_7', '$recipe_ingredient_8', '$recipe_ingredient_9', '$recipe_proportion_1', '$recipe_proportion_2', '$recipe_proportion_3', '$recipe_proportion_4', '$recipe_proportion_5', '$recipe_proportion_6', '$recipe_proportion_7', '$recipe_proportion_8', '$recipe_proportion_9')";
        
        $create_recipe_query =  mysqli_query($connection, $query);
       
        confirmQuery($create_recipe_query);
        
        $the_recipe_id = mysqli_insert_id($connection);
        
        echo "<p class='bg-success'>Receptura zostala utworzona lecz czeka na akceptacje Administratora <a href='../recipe.php?r_id=$the_recipe_id'>Pokaz Recepture</a>";
        
    }   

?>
   

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Nazwa przepisu</label>
        <input type="text" name="title" class="form-control"> 
    </div>
    
   <div class="form-group">
       <label for="recipe_category">Kategroria Receptury</label><br>
        <select class="form-control" name="recipe_category_id" id="recipe_category_id">
            
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
        <input type="text" class="form-control" name="author" autocomplete="on" value="<?php if(isset($_SESSION['username'])){
            
            echo $_SESSION['username'];
            
        } ?>">
        
     <?php if(is_admin()): ?>
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
      <?php endif ?>

    <div class="form-group">
        <label for="recipe_image">Obraz przepisu</label>
        <input type="file" name="image">
    </div>
    
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
            <input type="text" class="form-control" name="recipe_ingredient_1" placeholder="Składnik 1"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_1" placeholder="Ilość 1"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 2</th>
      <th scope="col">Ilość 2</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_2" placeholder="Składnik 2"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_2" placeholder="Ilość 2"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 3</th>
      <th scope="col">Ilość 3</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_3" placeholder="Składnik 3"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_3" placeholder="Ilość 3"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 4</th>
      <th scope="col">Ilość 4</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_4" placeholder="Składnik 4"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_4" placeholder="Ilość 4"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 5</th>
      <th scope="col">Ilość 5</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_5" placeholder="Składnik 5"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_5" placeholder="Ilość 5"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 6</th>
      <th scope="col">Ilość 6</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_6" placeholder="Składnik 6"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_6" placeholder="Ilość 6"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 7</th>
      <th scope="col">Ilość 7</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_7" placeholder="Składnik 7"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_7" placeholder="Ilość 7"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 8</th>
      <th scope="col">Ilość 8</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_8" placeholder="Składnik 8"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_8" placeholder="Ilość 8"></div>
        </td>
    </tr>
    <tr>
      <th scope="col">Składnik 9</th>
      <th scope="col">Ilość 9</th>
    </tr>
    <tr>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_ingredient_9" placeholder="Składnik 9"></div>
        </td>
        <td>
           <div style="width:auto;" class="col-6 col-sm-3">
            <input type="text" class="form-control" name="recipe_proportion_9" placeholder="Ilość 9"></div>
        </td>
    </tr>
  </tbody>
</table>
    <div id="" class="form-group">
        <label for="recipe_content">Opis przygotowania potrawy</label>
        <textarea class="form-control" name="recipe_content" id="editor" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_recipe" value="Opublikuj Przepis">
    </div>
        </div>
       </div>
    
</form>