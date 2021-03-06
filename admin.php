<?php

require_once __DIR__.'/include/HomeClass.php';
$env = __DIR__.'/.env';
$home = new HomeClass($env);

$loggedIn = $home->isLoggedIn();
$username = $home->getLoggedInUserName();

if(!$loggedIn) {
    header("Location:login.php");
}

$pages = $home->getAllPages();

$title = "Admin Home";
$baseUrl = $home->base_url();

?>

<?php include './header.php'?>
        <div class="page-body mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center page-title">Manage page</h1>

                    <?php if($pages['status']):?>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Page Title</th>
                                    <th>Page Status</th>
                                    <th><a class='btn btn-outline-primary page' load-quil='true' href='./create-page.php'>Add New</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pages['data'] as $ind => $data){
                                    $pageNo = $ind+1;
                                    echo "<tr><td width='5%'>$pageNo</td><td>$data[page_title]</td><td>$data[page_status]</td>
                                    <td width='20%'>
                                        <a class='btn btn-outline-warning page' target='_blank' href='./index.php?page=$data[id]'>View</a>
                                        <a class='btn btn-outline-info page' load-quil='true' href='./update-page.php?page=$data[id]'>Edit</a>
                                        <a class='btn btn-outline-danger delete-page' href='./delete-page.php?page=$data[id]'>Delete</a>
                                    </td>
                                    </tr>";
                                }?>
                                <script>
                                    function confirmMe(){
                                        if(confirm("Are you sure?"))
                                            return true;
                                        else return false;
                                    }
                                </script>
                            </tbody>

                        </table>
                    <?php else:?>
                    <div class="alert alert-danger">
                        <p class="text-center">No page found <a href="./create-page.php" load-quil='true' class="page">Add Now</a></p>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>

<?php include './footer.php'?>
