<?php include "includes/admin_header.php";?>

    <div id="wrapper">
        
<?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center">
        Witam <?php echo $_SESSION['username'] ?>

                        </h1>
           
                        <div class="col-xs-6">
                           
 <?php insert_categories(); ?>
                           
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Dodaj Kategorie</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Dodaj Kategorie">
                                </div>
                            </form>
                            
        <?php
        // UPDATE AND INCLUDE QUERY                    
            if(isset($_GET['edit'])){
                
                $cat_id = $_GET['edit'];
                
                include "includes/update_categories.php";
                
            }
                            
        ?>
                            
                        </div>
                        
                        <div class="table-responsive">
                           
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nazwa Kategorii</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
        <?php // FIND ALL CATEGORIES QUERY 
            findAllCategories(); ?>
                                  
        <?php // DELETE QUERY                           
            deleteCategories(); ?>
                                   
                                   
                                </tbody>
                            </table>
                        
                        </div>           
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        
        </div>

<?php include "includes/admin_footer.php";?>