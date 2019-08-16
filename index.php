<?php include "includes/db.php";?>

<?php include "includes/header.php";?>

    <!-- Navigation -->
    <!-- Page Content -->
    <div class="container" style="width:95%;">

        <div class="row">

            <!-- Blog Entries Column -->
        <div class="col-lg-12">
            <div id="my-slider" class="carousel slide" data-ride="carousel">
                 
                 <ol class="carousel-indicators">
                    <li data-target="#my-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#my-slider" data-slide-to="1"></li>
                    <li data-target="#my-slider" data-slide-to="2"></li>
                 </ol>
                  
                <div class="carousel-inner" role="listbox">
                     <div class="item active">
                         <img class="center-block" style="width:auto; height:auto;"   src="images/vegetables-752153_1280.jpg" alt="warzywa" />
                         <div class="carousel-caption">
                             <h2>Jeżeli gotowanie sprawia Ci przyjemność. . . </h2>
                         </div>
                     </div>
                     <div class="item">
                         <img class="center-block" style="width:auto; height:auto;" src="images/hotel-3728754_1280.jpg" alt="warzywa" />
                         <div class="carousel-caption">
                             <h2>. . .a kuchnia to Twoje ulubione pomieszczenie w domu... </h2>
                         </div>
                     </div>
                        <div class="item">
                         <img class="center-block" style="width:auto; height:auto;" src="images/men-2425121_1280.jpg" alt="warzywa" />
                         <div class="carousel-caption">
                             <h2>to świetnie trafiłeś, dołącz do nas i podziel się swoim przepisem...</h2>
                         </div>
                     </div>
                 </div>
         
                   
               </div>
            </div>
              
    <div class="col-md-8">

               
                <?php
                
                $per_page = 5;
                
            if(isset($_GET['page'])){
                
                $page = $_GET['page'];
                
            }else{
                
                $page = "";
                
            }
                
            if($page == "" || $page == 1){
                
                $page_1 = 0;
                
            }else{
                
                $page_1 = ($page * $per_page) - $per_page;
                
            }
                
        $recipe_query_count = "SELECT * FROM recipe WHERE recipe_status = 'Zaakceptowana'";
        $find_count = mysqli_query($connection, $recipe_query_count);
        $count = mysqli_num_rows($find_count);
                
        if($count < 1){
            
            echo "<h1 class='text-center'>Nie ma aktywnych Receptur</h1>";
            
        }else{
                
        $count = ceil($count / $per_page);
                
        $query = "SELECT * FROM recipe LIMIT $page_1, $per_page";
        $select_all_recipe_query = mysqli_query($connection,$query);
                                    
        while($row = mysqli_fetch_assoc($select_all_recipe_query)){
            
            $recipe_id = $row['recipe_id'];
            $recipe_title = $row['recipe_title'];
            $recipe_author = $row['recipe_author'];
            $recipe_date = $row['recipe_date'];
            $recipe_image = $row['recipe_image'];
            $recipe_content = substr($row['recipe_content'],0,200);
            $recipe_status = $row['recipe_status'];
            
            if($recipe_status == 'Zaakceptowana'){
                
            
                ?>
                
                
                
            <h1 class="page-header text-center">Posmakuj....</h1>

                <!-- First Blog Post -->
                <h2 class="text-center">
                    <p><?php echo $recipe_title ?> dodany przez: <p class="text-center"><a href="author_recipes.php?author=<?php echo $recipe_author ?>&r_id=<?php echo $recipe_id; ?>" data-toggle="tooltip" title="Zobacz więcej przepisów tego Użytkownika"><?php echo $recipe_author ?></a></h2>
                <p><span class="glyphicon glyphicon-time"></span><b> data dodania <?php echo $recipe_date ?></b></p>
                <hr>
                
                <a href="recipe.php?r_id=<?php echo $recipe_id; ?>">
                <img width="70%" height="70%" class="img-responsive center-block" src="images/<?php echo $recipe_image;?>" alt="">
                </a>
                
                <hr>
                <p><?php echo $recipe_content ?></p><br><br>
                <a class="btn btn-primary" href="recipe.php?r_id=<?php echo $recipe_id; ?>">Czytaj Więcej <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
                <?php } } }?>

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
    <?php include "includes/navigation.php";?>
    <?php include "includes/sidebar.php";?>

            
        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
            
    <?php
            
        for($i = 1; $i <= $count; $i++){
            
            if($i == $page){
                
                echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
                
            }else{
                
                echo "<li><a href='index.php?page=$i'>$i</a></li>";
                
            }
            
            
            
        }        
            
    ?>

        </ul>
</div>
<?php include "includes/footer.php";?>