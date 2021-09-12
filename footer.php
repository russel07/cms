<div class="footer-area">
    <div class="col-md-12 text-center">
        <p>All rights reserved &copy; Basic-CMS</p>
    </div>
</div>
</div>
</div>


<script type="text/javascript" src="asset/js/jquery.min.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>

<?php if ($loggedIn):?>
<script>
    $(document).ready( function () {
        $(document).on('click', '#create_page', function (e) {
            document.getElementById("page_content").value = quill2.root.innerHTML;

            if(!$('#create_page_form')[0].checkValidity()) {
                $('#create_page_form').addClass('was-validated');
                $('#submitCreatePage').click();
            }else{
                let fd = new FormData(document.getElementById('create_page_form'));
                let url = base_url+'/create-page.php', nextUrl = base_url+'/admin.php';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        var hasError = $(data).find("#has_error");
                        hasError = hasError.length > 0;

                        if(hasError)
                            nextUrl = url;

                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', nextUrl);
                    },
                    complete: function () {

                    }
                });
            }
        });

        $(document).on('click', '#update_page', function (e) {
            document.getElementById("page_content").value = quill2.root.innerHTML;

            if(!$('#update_page_form')[0].checkValidity()) {
                $('#update_page_form').addClass('was-validated');
                $('#submitUpdatePage').click();
            }else{
                let fd = new FormData(document.getElementById('update_page_form'));
                let url = base_url+'/update-page.php', nextUrl = base_url+'/admin.php';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        var hasError = $(data).find("#has_error");
                        hasError = hasError.length > 0;

                        if(hasError)
                            nextUrl = url;

                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', nextUrl);
                    },
                    complete: function () {

                    }
                });
            }
        });

        $(document).on('click', '.delete-page', function (e) {
            e.preventDefault();
            if(confirm("Are you sure?")){
                var url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {

                    },
                    success : function(data) {
                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', url);

                        if(loadQuil){
                            quill2 = new Quill('#editor', {
                                placeholder: 'Compose your order details',
                                theme: 'snow',
                                modules: {
                                    toolbar: '#toolbar'
                                }
                            });
                        }
                    },
                    error : function(request,error)
                    {

                    }
                });
            }else{
                return false;
            }
        });
    });
</script>
<?php endif;?>

<script>
    $(document).ready( function () {
        $(document).on('click', '.page', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var loadQuil = $(this).attr('load-quil');
            if(url !== ''){
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {

                    },
                    success : function(data) {
                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', url);

                        if(loadQuil){
                            quill2 = new Quill('#editor', {
                                placeholder: 'Compose your order details',
                                theme: 'snow',
                                modules: {
                                    toolbar: '#toolbar'
                                }
                            });
                        }
                    },
                    error : function(request,error)
                    {

                    }
                });
            }
        });

        $(document).on('click', '#login', function (e) {
            if(!$('#login_form')[0].checkValidity()) {
                $('#login_form').addClass('was-validated');
                $('#submitLogin').click();
            }else{
                let fd = new FormData(document.getElementById('login_form'));
                let url = base_url+'/login.php', nextUrl = base_url+'/admin.php';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        var hasError = $(data).find("#has_error");
                        hasError = hasError.length > 0;

                        if(hasError)
                            nextUrl = url;

                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', nextUrl);
                    },
                    complete: function () {

                    }
                });
            }
        });
    });
</script>

</body>
</html>
