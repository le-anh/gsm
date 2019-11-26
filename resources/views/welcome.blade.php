<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial;
    font-size: 17px;
    background-image: url('images/background.jpg');
}

#myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%; 
    min-height: 100%;
}

.content {
    position: fixed;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    color: #f1f1f1;
    width: 100%;
    padding: 20px;
}

#myBtn {
    width: 200px;
    font-size: 18px;
    padding: 10px;
    border: none;
    background: #000;
    color: #fff;
    cursor: pointer;
}

#myBtn:hover {
    background: #ddd;
    color: black;
}
.bgr_blue{
  /*background: #17A2B8;*/

  background: url(images/background.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<!-- Styles -->
  <link href="{{URL::asset('themes/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

</head>
<body class="bgr_blue">



<video autoplay muted loop id="myVideo" class="hidden">
  <source src="{{URL::asset('videos\agu_flycam.mp4')}}" type="video/mp4">
  Your browser does not support HTML5 video.
</video>

<div id="div_content" class="content text-center">
  <h1>TẬP ĐOÀN LỘC TRỜI</h1>
  <h2>CÔNG TY LỘC TRỜI - VIÊN THỊ</h2>
  <h5>WEBSITE UPDATING...</h5>
  <br>
  
  <a href="{{route('login')}}" class="btn btn-danger">ĐĂNG NHẬP</a>
</div>

<script>
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function myFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "Pause";
  } else {
    video.pause();
    btn.innerHTML = "Play";
  }



}

  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) 
  {
    video.setAttribute('hidden', 'true');
  }

</script>

</body>
</html>
