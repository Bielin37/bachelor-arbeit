       <nav style="background:#3c3d41;" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div style="background:#3c3d41;" class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div style="background:#3c3d41;" class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Strona domowa</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav mr-auto">
                       
        <li class="nav-item dropdown">
        <a style="background:#3c3d41;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Szukaj przepisu po Kategorii
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">
            
            <?php
                    
        $query = "SELECT * FROM categories";
        $select_all_categories_query = mysqli_query($connection,$query);
                    
        while($row = mysqli_fetch_assoc($select_all_categories_query)){
            
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            
            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
            
        }
                    
            ?>
            
            </a>
        </li>
        </ul>
        </div>
        </li>
               
        <?php
                    
        if(isset($_SESSION['user_role'])){
    
            if($_SESSION['user_role'] == 'Administrator'){
        
                echo "<li><a href='admin'>Sekcja-Admin</a></li>";
        
            }else if($_SESSION['user_role'] == 'Uzytkownik') {
                
                echo "<li><a href='admin'>Dodaj Przepis</a></li>";
                
            }
    
        } 
                    
        ?>
            
        <li>
            <a href="registration.php">Rejestracja</a>
        </li>       
        </ul>
           
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
       