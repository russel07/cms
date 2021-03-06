<?php

require_once __DIR__.'/include/HomeClass.php';
$env = __DIR__.'/.env';
$home = new HomeClass($env);

$loggedIn = $home->isLoggedIn();
$username = $home->getLoggedInUserName();

if(!$loggedIn) {
    header("Location:login.php");
}

$title = "Create new page";
$baseUrl = $home->base_url();

$err = [];
if(isset($_REQUEST) && ($_SERVER['REQUEST_METHOD'] === 'POST')) {
    if (isset($_POST) && !empty($_POST)) {
        $home->validatePageForm($_POST);

        if(sizeof($err) < 1){
            $page = $home->createPage($_POST);
            if($page){
                header("Location:admin.php");
            }else{
                array_push($err, 'Something went wrong try again');
            }
        }
    }
}

?>

<?php include './header.php'?>
<div class="page-body mt-2">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center page-title">Create new page</h1>
        </div>

        <div class="card col-md-10 mt-2 offset-1">

            <?php
            if(sizeof($err) > 0):
                ?>
                <div class="alert alert-danger" id="has_error">
                    <p>please fix the following issue(s)</p>
                    <ul>
                        <?php foreach ($err as $error){
                            echo "<li>$error</li>";
                        }?>
                    </ul>
                </div>
                <?php $err= []; endif;?>

            <form action="<?php echo $baseUrl?>/create-page.php" method="POST" id="create_page_form">
                <div class="form-group">
                    <label for="page_title">Page Title:</label>
                    <input type="text" name="page_title" class="form-control" id="page_title" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="page_content">Page Content:</label>

                    <div id="toolbar">
                        <!-- Add buttons as you would before -->
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                    </div>
                    <div id="editor"></div>
                    <input type="hidden" class="form-control" name="page_content" id="page_content">
                </div>

                <script>
                    quill2 = new Quill('#editor', {
                        placeholder: 'Compose your order details',
                        theme: 'snow',
                        modules: {
                            toolbar: '#toolbar'
                        }
                    });
                </script>

                <div class="form-group text-center">
                    <input type="submit" id="submitCreatePage" style="display: none"/>
                    <button type="submit" class="btn btn-outline-success" id="create_page" onclick="return getPageContent();">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include './footer.php'?>
