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
                        
    <?php
                        
        if(isset($_GET['source'])){
            
            $source = $_GET['source'];
            
        }else{
            
            $source = '';
            
        }
        
        switch($source){
                
            case 'add_recipe';
            include "includes/add_recipe.php";
            break;
                
            case 'edit_recipe';
            include "includes/edit_recipe.php";
            break;
                
            default:
                
            include "includes/view_all_comments.php";
                
            break;
                
        }
    
    ?>
                        
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        
        </div>
        
        </div>
        
<?php include "includes/admin_footer.php";?>