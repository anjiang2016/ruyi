<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript">
            function a(){
                var st = document.documentElement.scrollTop;//滚去的高度
                var ch = document.documentElement.clientHeight;//窗口的高度
                var at = document.getElementById("a").offsetTop;//元素离页面顶部的高度
                var v = ch - (at - st);//元素离窗口底部的高度,为负的话表示元素还在窗口底部下面
                alert("距离底部的高度为:"+v);
            }
        </script>
    </head>
    <body>
        <div>
            test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/><input type="button" value="test" onclick="a()"/>
            test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/><input type="button" value="test" onclick="a()"/>
            test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/><input type="button" value="test" onclick="a()"/>
            test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/><input type="button" value="test" onclick="a()"/>
            test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/><input type="button" value="test" onclick="a()"/>
            <div id="a" style="width:100px;height:1px;background-color: red"></div>
            test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/>test<br/><input type="button" value="test" onclick="a()"/>
        </div>
    </body>
</html>