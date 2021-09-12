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
        $(document).on('click', '.page', function (e) {
            e.preventDefault();
        });
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
    });
</script>

</body>
</html>
