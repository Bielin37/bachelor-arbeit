<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header text-center">
tu znajdziesz swoje przepisy</h1>                  </div>
</div>

       <?php 
        
        $query = "SELECT * FROM recipe WHERE recipe_author='" . $_SESSION['username'] ."'";
        $select_all_recipe_query = mysqli_query($connection, $query);
                                    
        while($row = mysqli_fetch_assoc($select_all_recipe_query)){
            
            $recipe_id = $row['recipe_id'];
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['recipe_author'];
            $recipe_date = $row['recipe_date'];
            $recipe_image = $row['recipe_image'];
            $recipe_content = $row['recipe_content'];
            $recipe_status = $row['recipe_status'];
            $recipe_ingredient_1 = $row['recipe_ingredient_1'];
            $recipe_ingredient_2 = $row['recipe_ingredient_2'];
            $recipe_ingredient_3 = $row['recipe_ingredient_3'];
            $recipe_ingredient_4 = $row['recipe_ingredient_4'];
            $recipe_ingredient_5 = $row['recipe_ingredient_5'];
            $recipe_ingredient_6 = $row['recipe_ingredient_6'];
            $recipe_ingredient_7 = $row['recipe_ingredient_7'];
            $recipe_ingredient_8 = $row['recipe_ingredient_8'];
            $recipe_ingredient_9 = $row['recipe_ingredient_9'];
            $recipe_proportion_1 = ($row['recipe_proportion_1']);
            $recipe_proportion_2 = ($row['recipe_proportion_2']);
            $recipe_proportion_3 = ($row['recipe_proportion_3']);
            $recipe_proportion_4 = ($row['recipe_proportion_4']);
            $recipe_proportion_5 = ($row['recipe_proportion_5']);
            $recipe_proportion_6 = ($row['recipe_proportion_6']);
            $recipe_proportion_7 = ($row['recipe_proportion_7']);
            $recipe_proportion_8 = ($row['recipe_proportion_8']);
            $recipe_proportion_9 = ($row['recipe_proportion_9']);
            
?>

                <!-- First Blog Post -->
                <h2 class="text-center">
                    <p><?php echo $recipe_title ?></h2>
                <p><span class="glyphicon glyphicon-time"></span><b> data dodania <?php echo $recipe_date ?></b></p>
                <hr>
                
                <img width="60%" height="60%" class="img-responsive center-block" src="../images/<?php echo $recipe_image ?>" alt="">
                <p><h1 class="text-center">Składniki:</h1><br>
                <div class="container">
                <div class="row">
                    <div class="col"><h4><b><?php echo $recipe_ingredient_1 ?></b><?php echo " " ?><?php echo $recipe_proportion_1 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_2 ?></b><?php echo " " ?><?php echo $recipe_proportion_2 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_3 ?></b><?php echo " " ?><?php echo $recipe_proportion_3 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_4 ?></b><?php echo " " ?><?php echo $recipe_proportion_4 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_5 ?></b><?php echo " " ?><?php echo $recipe_proportion_5 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_6 ?></b><?php echo " " ?><?php echo $recipe_proportion_6 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_7 ?></b><?php echo " " ?><?php echo $recipe_proportion_7 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_8 ?></b><?php echo " " ?><?php echo $recipe_proportion_8 ?></h4></div>
                    <div class="col"><h4><b><?php echo $recipe_ingredient_9 ?></b><?php echo " " ?><?php echo $recipe_proportion_9 ?></h4></div>
                </div>
                </div>
                <p><h1 class="text-center">Sposób przygotowania:</h1><br>
                
                <hr>
                <p><?php echo $recipe_content ?></p><br><br>
                
                <?php } ?>

