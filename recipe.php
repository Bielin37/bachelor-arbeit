<?php include "includes/db.php";?>

<?php include "includes/header.php";?>
    
<?php include "includes/navigation.php";?>


    <!-- Page Content -->
    <div class="container" style="width:95%%;">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                
        if(isset($_GET['r_id'])){
            
            $the_recipe_id = $_GET['r_id'];
            
        $view_query = "UPDATE recipe SET recipe_views_count = recipe_views_count + 1 WHERE recipe_id = $the_recipe_id ";
        $send_query = mysqli_query($connection, $view_query);
        if(!$send_query){
            
            die("QUERY FAILED");
            
        }
                
        $query = "SELECT * FROM recipe WHERE recipe_id = '$the_recipe_id' ";
        $select_all_recipe_query = mysqli_query($connection, $query);
                    
        while($row = mysqli_fetch_assoc($select_all_recipe_query)){
            
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['recipe_author'];
            $recipe_date = $row['recipe_date'];
            $recipe_image = $row['recipe_image'];
            $recipe_content = $row['recipe_content'];
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
                
            <h1 class="page-header text-center">Szczegóły przepisu <?php echo $recipe_title ?></h1>

                <!-- First Blog Post -->

                <p class="lead text-center">
                    dodany przez: <h2>
                <p class="text-center"><a href="author_recipes.php?author=<?php echo $recipe_author ?>&r_id=<?php echo $recipe_id; ?>" data-toggle="tooltip" title="Zobacz więcej przepisów tego Użytkownika"><?php echo $recipe_author ?></a></h2>
                <p><span class="glyphicon glyphicon-time"></span><b> data dodania <?php echo $recipe_date ?></b></p>
                <hr>
                <img width="90%" height="90%" class="img-responsive center-block" src="images/<?php echo $recipe_image;?>" alt="">
                <hr>
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
                <p><?php echo $recipe_content ?></p><br><br>

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
                        
                        
            
                        } else {
                            
                            echo "<script>alert('Wszystkie pola komentarza musza byc wypelnione')</script>";
                            
                        }
                            
                        }
                
                ?>
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Zostaw Komentarz:</h4>
                    <form ctiom="" method="post" role="form">
                        <div class="form-group">
                            <label for="Author">Autor</label>
                            <input type="text" name="comment_author" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Author">Email</label>
                            <input type="email" name="comment_email" class="form-control" name="comment_email" >
                        </div>
                        <div class="form-group">
                            <label for="Comment">Twoj Komentarz</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Wyślij</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php
                
        if(isset($_GET['r_id'])){
            
            $the_recipe_id = $_GET['r_id'];
                
        $query = "SELECT * FROM comments WHERE comment_recipe_id = '$the_recipe_id' AND comment_status = 'Zaakceptowany' ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
        if(!$select_comment_query){
            
            die('QUERY FAILED' . mysqli_error($connection));
            
        }
                                
        while($row = mysqli_fetch_array($select_comment_query)){
            
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_date = $row['comment_date'];
            
                ?>
                
                <!-- Comment -->
                <div class="media">
                    <div class="pull-left">
                        <img style="width:50px; height:50px;" class="media-object" src="images/images.png" alt="">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>  
                    </div>
                </div>
                
                
        <?php } } ?>

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
<?php include "includes/sidebar.php";?>
            
        </div>
        <!-- /.row -->

</div>

<?php include "includes/footer.php";?>