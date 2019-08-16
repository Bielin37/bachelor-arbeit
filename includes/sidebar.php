               <div class="col-md-4">
                
                <!-- Blog Search Well -->
            <div style="margin-top:20px;" class="well">
                    <h4>Szukaj przepisu</h4>
                    
                    <form action="search.php" method="post">
                    
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="na co masz ochotę?">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                 <!-- Login -->
                <div class="well">
                   
        <?php if(isset($_SESSION['user_role'])): ?>
                 
            <h4>Zalogowany jako <?php echo $_SESSION['username'] ?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Wyloguj</a>
                  
        <?php else: ?>
                 
            <h4>Zaloguj sie</h4>
                <form action="includes/login.php" method="post">
                    
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Podaj nazwe Uzytkownika">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Podaj haslo"><br>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Zaloguj</button>
                    </span>
                </div>
                </form>
                    <!-- /.input-group -->
                  
        <?php endif; ?>          
         
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                  
        <?php
                   
        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($connection,$query);
                    
        ?>
                   
                    <h4>Kategorie Przepisów</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
        
        <?php                      
            
            while($row = mysqli_fetch_assoc($select_categories_sidebar)){
            
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            
            echo "<li class='list-group-item list-group-item-success'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
            
        }
                                
        ?>
        
                            </ul>
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                
    <?php include "widget.php";?>

            </div>
