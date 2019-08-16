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
                
        if(isset($_GET['r_id'])){

            $the_recipe_author = $_GET['author'];
                
        $query = "SELECT * FROM recipe WHERE recipe_author = '$the_recipe_author' ";
        $select_recipe_query = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($select_recipe_query);
             
        $recipe_author = $row['recipe_author'];
 

         echo "<h2 class='text-center'><span class='label label-success'>Tu znajdziemy wszystkie przepisy Użytkownika $recipe_author </span></h2>";
                
        }
                ?>
                
                <?php
                
        if(isset($_GET['r_id'])){
            
            $the_recipe_id = $_GET['r_id'];
            $the_recipe_author = $_GET['author'];

                
        $query = "SELECT * FROM recipe WHERE recipe_author = '$the_recipe_author' ";
        $select_all_recipe_query = mysqli_query($connection, $query);
                    
        while($row = mysqli_fetch_assoc($select_all_recipe_query)){
            
            $recipe_id = $row['recipe_id'];
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['recipe_author'];
            $recipe_date = $row['recipe_date'];
            $recipe_image = $row['recipe_image'];
            $recipe_content = $row['recipe_content'];
        
                ?>
                
            <h1 class="page-header text-center">Wypróbuj przepisu</h1>

                <h2 class="text-center">
                <p><?php echo $recipe_title ?> dodany przez Użytkownika <?php echo $recipe_author ?></p>
                </h2> 
                <p><span class="glyphicon glyphicon-time"></span><b> data dodania <?php echo $recipe_date ?></b>
                <hr>
                <a href="recipe.php?r_id=<?php echo $recipe_id; ?>"><img width="70%" height="70%" class="img-responsive center-block" src="images/<?php echo $recipe_image;?>" alt=""></a>
                <hr>
                <hr>
                <p><?php echo $recipe_content ?></p><br><br>
                <a class="btn btn-primary" href="recipe.php?r_id=<?php echo $recipe_id ?>">Czytaj Więcej <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
                <?php }} ?>
                
                
                <!-- Blog Comments -->
                
                <?php
                
                    if(isset($_POST['create_comment'])){
                        
                        $the_recipe_id = $_GET['r_id'];
                        
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            
                            $query = "INSERT INTO comments (comment_recipe_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ('$the_recipe_id', '$comment_author', '$comment_email', '$comment_content', 'Niezaakceptowany', now())";
                            
                        echo "<script>alert('Twoj komentarz czeka na akceptacje administratora')</script>";
                        
                        $create_comment_query = mysqli_query($connection, $query);
                        
                        if(!$create_comment_query){
                            
                            die('QUERY FAILED' . mysqli_error($connection));
                            
                        }
                        
                        $query = "UPDATE recipe SET recipe_comment_count = recipe_comment_count + 1 WHERE recipe_id = $the_recipe_id ";
                        $uodate_comment_count = mysqli_query($connection, $query);
            
                        } else {
                            
                            echo "<script>alert('Wszystkie pola komentarza musza byc wypelnione')</script>";
                            
                        }
                            
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