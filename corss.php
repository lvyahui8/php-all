<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<iframe src="http://www.baidu.com" width="400px" height="800px">

</iframe>
<script>
    var xhr = new XMLHttpRequest();

//    xhr.open('get','http://www.baidu.com',true);
    xhr.open('GET','https://github.com/',true);
//    xhr.open('get','http://movesun.com',true);
    xhr.setRequestHeader('Content-Type','text/html;charset=utf-8');
    xhr.send();

    xhr.withCredentials = true;

    xhr.onreadystatechange = function(){
        if(4 == xhr.readyState && 200 == xhr.status){
            $('#web').value = xhr.responseText;
        }
    }
</script>
</body>
</html>