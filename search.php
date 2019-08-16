<?php include "includes/db.php";?>

<?php include "includes/header.php";?>

    <!-- Navigation -->
    
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container"  style="width:95%;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
               
               <?php
    
                if(isset($_POST['submit'])){
                    
                    $search = $_POST['search'];
                    
                    $query = "SELECT * FROM recipe WHERE recipe_title LIKE '%$search%'";
                    
                    $search_query = mysqli_query($connection, $query);
                    
                    if(!$search_query){
                        
                        die("QUERY FAILED" . mysqli_error($connection));
                        
                    }
                    
                    $count = mysqli_num_rows($search_query);
                    
                if($count == 0){
                        
                        echo "<h1>NIC NIE ZNALEZIONO</h1>";
                        
                }else{
                    
                    while($row = mysqli_fetch_assoc($search_query)){
                        
                    $recipe_id = $row['recipe_id'];    
                    $recipe_title = $row['recipe_title'];
                    $recipe_author = $row['recipe_author'];
                    $recipe_date = $row['recipe_date'];
                    $recipe_image = $row['recipe_image'];
                    $recipe_content = substr($row['recipe_content'],0,200);
            
                ?>

                <!-- First Blog Post -->
                <h1 class="text-center">
                    <?php echo $recipe_title ?>
                </h1>
                <p class="lead text-center">
                    dodany przez: <h2>
                <p class="text-center"><a href="author_recipes.php?author=<?php echo $recipe_author ?>&r_id=<?php echo $recipe_id; ?>" data-toggle="tooltip" title="Zobacz więcej przepisów tego Użytkownika"><?php echo $recipe_author ?></a></h2>
                
                <p><span class="glyphicon glyphicon-time"></span><b> data dodania <?php echo $recipe_date ?></b></p>
                <hr>
                
                <hr>
                <a href="recipe.php?r_id=<?php echo $recipe_id; ?>">
                <img width="90%" height="%" class="img-responsive center-block" src="images/<?php echo $recipe_image;?>" alt="">
                </a>
                
                <hr>
                <p><?php echo $recipe_content ?></p><br><br>
                <a class="btn btn-primary" href="recipe.php?r_id=<?php echo $recipe_id; ?>">Czytaj Więcej <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                
            <?php } } } ?>
            
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php";?>
            
        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php";?>