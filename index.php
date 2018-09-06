<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php");?>
<?php
//pagination variables
// $current_page
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1 ; // from url
// $per_page, records per page
    $per_page = 3 ; // can be set to a desired page number
// $total_count, counts all the records in the db
    $total_count = Photograph::count_all();

    // $photos = Photograph::find_all(); //pagination was used instead of photographs
    $pagination = new Pagination($page, $per_page, $total_count);

    $sql = "SELECT * FROM photographs "; // 'GROUP BY' will return single photos for each owner
    // and this group can be made as couresel
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()} ";
    $photos = Photograph::find_by_sql($sql); // alternatively find all() can be used to query all the photos
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="frameworks/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Kejaport</title>
</head>
<body>
<div id="homepage">
    <header>
    <nav>
        <div class="row">
            <div class="col-6">
                    <ul class="nav">
                        <li class="nav-item"><a href="#" class="nav-link">LOGO</a></li>
                    </ul>
            </div>
            <div class="col-6">
                    <ul class="nav justify-content-center">
                        <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Contacts</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Advertise</a></li>
                        <li class="nav-item"><a href="signup.php" class="nav-link">Sign Up</a></li>
                        <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>

                    </ul>
            </div>
        </div>
    </nav>
    </header>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="container">
                <form action="#" method="post" id="searchForm">
                    <div class="form-group">
                        <table class="table-responsive">
                            <th class="col"></th>
                            <th></th>
                            <tr>
                                <td><input type="text" name="area" value="" class="form-control" id="input"></td>
                                <!-- <td><input type="submit" name="submit" value="SEARCH" class="btn btn-primary" id="search"></td> -->
                                <td><button type="submit"  class="btn btn-primary" id="search"><img src="images/search.svg" alt="search" srcset="" height="20" width="20"></button></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4"><h3></h3></div>
    </div>
</div>
<div class='row'>
    <div class="col-2">
    </div>
    <div class="col-8">
    <?php foreach ($photos as $photo): ?>
        <div style="float: left; margin-left: 20px">
            <img src="./public/<?php echo $photo->image_path()?>" width="200" height="200" alt="public photos" class="images">
            <p><?php echo $photo->caption ;?></p>
            <p><?php echo $photo->owner_id;?></p>
        </div>
    <?php  endforeach; ?>
    </div>
    <div class="col-2">

    </div>
</div>
<div style="clear:both">
    <?php
        if($pagination->total_pages() > 1){

            if($pagination->has_previous_page()){
                echo " <a href=\"index.php?page=" ;
                echo $pagination->previous_page();
                echo "\">&laquo; Previous</a> ";
            }
            for ($i=1; $i < $pagination->total_pages(); $i++) {
                if($i == $page){
                    echo $i; // no link coloring for the current page
                }else{
                    echo " <a href =\"index.php?page={$i}\">{$i}</a> ";
                }
            }
            if($pagination->has_next_page()){
                echo " <a href=\"index.php?page=" ;
                echo $pagination->next_page();
                echo "\">Next &raquo;</a> ";
            }
        }
    ?>
</div>
<script src="frameworks/node_modules/jquery/dist/jquery.min.js"></script>
<script src="frameworks/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="javaScript/script.js"></script>
</body>
</html>
