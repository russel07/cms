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

    });
</script>
<?php endif;?>

<script>
    $(document).ready( function () {
        $(document).on('click', '.page', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');

            if(url !== ''){
                $.ajax({
                    url: url,
                    type: 'GET',
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#overlay").fadeIn(300);
                    },
                    success : function(data) {
                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', url);
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
                let url = base_url+'/login.php', nextUrl = '';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: fd,
                    cache: false,
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#overlay").fadeIn(300);
                    },
                    success: function (data) {
                        var hasError = $(data).find("#has_error");
                        hasError = hasError.length > 0;

                        if(hasError)
                            nextUrl = url;
                        else nextUrl = base_url+'/admin.php';

                        document.querySelector('html').innerHTML = data;
                        window.history.pushState({}, '', nextUrl);
                    },
                    complete: function () {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    }
                });
            }
        });
    });
</script>

</body>
</html>
