<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
        
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Strona Domowa Admin</a>
    </div>
            <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
        
        
<li><a href="../index.php">Strona Domowa</a></li> 
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>            
    <?php
                        
        if(isset($_SESSION['username'])){
            
            echo $_SESSION['username'];
            
        }                 
    
    ?>
                                           
                      <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i>Mój Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i>Wyloguj sie</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="recipes.php?source=add_recipe"><i class="fa fa-plus-circle"></i>Dodaj Przepis</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php if(is_admin()): ?>
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Panel Główny</a>
                    </li>
                    <?php endif ?>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Przepisy <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                           
                        <?php if(is_admin()): ?>
                            <li>
                                <a href="recipes.php">Pokaż Przepisy</a>
                            </li>
                        <?php endif ?>
                           
                            <li>
                                <a href="recipes.php?source=add_recipe">Dodaj Przepis</a>
                            </li>
                        </ul>
                    </li>
                    
                    <?php if(is_admin()): ?>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-wrench"></i>Kategorie</a>
                    </li>
                    <li class="">
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i>Komentarze</a>
                    </li>
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Użytkownicy<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="users.php">Pokaż wszystkich użytkowników</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Dodaj nowego użytkownika</a>
                            </li>
                        </ul>
                        <?php endif ?>
                    </li>
                    <li class="">
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i>Profil</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>