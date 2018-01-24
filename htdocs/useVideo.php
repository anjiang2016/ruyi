实现这个功能的前提是你的电脑设备上需要安装有摄像头设备，以及你的浏览器需要支持flash
<!DOCTYPE HTML>

<html>

<head>

<meta charset="utf-8">

<title>Javascript+PHP实现在线拍照功能</title>

</head>

<body>

<div id="cam">

<!--调用摄像组件并显示图像-->

<input type=button value="点击这里拍照" class="btn" onclick="take_snapshot()">


</div>

<div id="results">

<!--显示上传结果-->

</div>

</body>

</html>
<?php 
/*
在body中加入一个用于调用摄像组件的容器id#cam和一个显示上传信息的容器id#results。

Javascript

接下来调用摄像组件，我们先载入webcam.js，用于拍照和上传的js库。
*/?>
<script type="text/javascript" src="webcam.js"></script>

<?php //然后在容器id#cam中，加入以下代码：
?>

<script language="JavaScript">

webcam.set_api_url( 'action.php' );

webcam.set_quality( 90 ); // 图像质量(1 - 100)

webcam.set_shutter_sound( true ); // 拍照时播放声音

document.write( webcam.get_html(320, 240, 160,120) );

</script>

<?php/* 
我们调用了webcam，其中webcam.set_api_url用来设置图像上传交互的php路径，set_quality可设置图像质量，set_shutter_sound设置声音，get_html输出摄像组件，参数即宽度、高度、上传后宽度、上传后高度。

当点击按钮拍照时，需要执行以下代码：

//钮拍照时，需要执行以下代码：
*/?>
<script language="JavaScript">

webcam.set_hook( 'onComplete', 'my_completion_handler' );

function take_snapshot() {

document.getElementById('results').innerHTML = '<h4>Uploading...</h4>';

webcam.snap();

}

function my_completion_handler(msg) {

if (msg.match(/(http\:\/\/\S+)/)) {

var image_url = RegExp.$1;

document.getElementById('results').innerHTML =

'<h4>Upload Successful!</h4>' +

'<img src="' + image_url + '">';

webcam.reset();

}

else alert("PHP Error: " + msg);

}

</script>
