<div class="footer-area">
    <div class="col-md-12 text-center">
        <p>All rights reserved &copy; Basic-CMS</p>
    </div>
</div>
</div>
</div>


<script type="text/javascript" src="<?php echo $baseUrl?>/asset/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl?>/asset/js/bootstrap.min.js"></script>

<script>
    function getPageContent(){
        $("#page_content").val(quill2.root.innerHTML);
        return true;
    }
    $(document).ready( function () {
        var nextUrl = base_url+"/admin.php";

        $(document).on('click', '.page', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var loadQuil = $(this).attr('load-quil');
            var pageType = $(this).attr('page-type');

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
                        if(pageType)
                            url = base_url+"/index.php";

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

        $("form").submit(function(e){
            e.preventDefault();
            var form = $(this);
            var id = form.attr('id');
            var url = form.attr('action');

            let fd = new FormData(document.getElementById(id));

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
                        window.history.pushState({}, '', nextUrl);
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

</body>
</html>
