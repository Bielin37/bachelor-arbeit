<?php include "includes/db.php";?>

<?php include "includes/header.php";?>

    <!-- Navigation -->
    
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container" style="width:95%;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                
        if(isset($_GET['category'])){
            
            $recipe_category_id = $_GET['category']; 
                
        $query = "SELECT * FROM recipe WHERE recipe_category_id = $recipe_category_id AND recipe_status = 'Zaakceptowana'";
        $select_all_recipes_query = mysqli_query($connection, $query);
            
        if(mysqli_num_rows($select_all_recipes_query) < 1){
            
            echo "<h1 class='text-center'>Nie ma aktywnych Receptur</h1>";            
        }else{
                    
        while($row = mysqli_fetch_assoc($select_all_recipes_query)){
            
            $recipe_id = $row['recipe_id'];
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['recipe_author'];
            $recipe_date = $row['recipe_date'];
            $recipe_image = $row['recipe_image'];
            $recipe_content = substr($row['recipe_content'],0,200);
            
            $query = "SELECT * FROM categories WHERE cat_id = $recipe_category_id";
                $select_categories_id = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($select_categories_id)){
                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                }
            
            ?>
            
            <h2 class="page-header text-center">Przepis z kategorii <?php echo $cat_title ?>: <?php echo $recipe_title; ?>
                </h2>
                
                <p class="lead text-center">
                    dodany przez: <h2>
                <p class="text-center"><a href="author_recipes.php?author=<?php echo $recipe_author ?>&r_id=<?php echo $recipe_id; ?>" data-toggle="tooltip" title="Zobacz więcej przepisów tego Użytkownika"><?php echo $recipe_author ?></a></h2>
                
                <p><span class="glyphicon glyphicon-time"></span><b> data dodania <?php echo $recipe_date ?></b>
                <hr>
                <a href="recipe.php?r_id=<?php echo $recipe_id; ?>"><img width="100%" height="100%" class="img-responsive center-block" src="images/<?php echo $recipe_image;?>" alt=""></a>
                <hr>
                <p><?php echo $recipe_content ?></p><br><br>
                <a class="btn btn-primary" href="recipe.php?r_id=<?php echo $recipe_id; ?>">Czytaj Więcej <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
                <?php } } }else{
            
                    header("Location: index.php");
            
                }
                
                ?>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php";?>
            
        </div>
        <!-- /.row -->

        <hr>
</div>
<?php include "includes/footer.php";?>