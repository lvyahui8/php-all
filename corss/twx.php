<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="../js/jquery-1.10.1.min.js"></script>
</head>
<body>
    <script>
        $(document).ready(function(){
            var url = 'http://pre.console.tstar.qcloud.com/home/user';
//            var url = 'http://dbuilder.qq.com/develop/check-login';
//            $.get(url,function(resp){
//                console.dir(resp);
//            });
            $.ajax({
                url :   url,
                xhrFields: {
                    withCredentials:true
                },
//                crossDomain:true,
                success: function (resp) {
                    console.dir(resp);
                }
            });
        });
    </script>
</body>
</html>