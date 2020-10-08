<?php
/*
require_once 'backend.php';

if ($_SESSION[isLoggedIn]){
	echo 'You are logged in already...';
	header("Location: /");// Redirect browser
	exit();
}
 */
?>
<!DOCTYPE HTML>
<!--
||\\   ||\\   //|| | | ||
|| \\  || \\ // ||
||  \\ ||  \\/  || | ||
||   \\||	    ||

	NOSSON M FRANKEL
	nossonmfrankel@gmail.com
	ALL RIGHTS RESERVED, <?=date('Y')?>
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="theme-color" content="#fff">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="main.css">
	<title>Login | &nbsp;</title>
	<style>
		body{
			display: flex;
			vertical-align: center;
			justify-content: center;
			background: #fff;
			background: linear-gradient(128deg, rgb(248, 248, 248) 0%, rgb(255, 255, 255) 47%);
			padding: 35px;
		}
		input, button{
			display: block;
			margin: 15px auto;
		}
		form{
			margin: auto;
			text-align: center;
			max-width: 320px;
			background: #fff;
			border-radius: 5px;
			padding: 35px 35px;
			box-shadow: -1px 2px 20px 2px #ddd;
		}
		form img{
			height: 75px;
			padding-bottom: 1rem;
		}
		form div#guide{
			font-size: 1.5rem;
			padding-bottom: 1rem;
		}
		form div#subGuide{
			padding-bottom: 2rem;
			color: #333;
		}
		form .input-container{
			margin: 20px 0px;
			right: 0;
			transition: all cubic-bezier(0.6, 0, 0.2, 1) 1s;
		}
		form.disabled .input-container{
			right: 130%;
		}
		form button, form input[type="button"], form input[type="submit"]{
			min-width: unset;
			margin-top: 40px;
		}
		form button.sub, form input[type="button"].sub{
			float: left;
			width: 145px;
			color: rgb(38, 147, 255);
			background: #fff;
			border: 1px solid #eee;
			/* box-shadow: none; */
		}
		form button.main, form input[type="submit"].main{
			float: right;
			width: 80px;
		}
		form .disabledTrue{
			position: absolute;
			bottom: 180px;
			height: unset;
			right: -190%;
			width: 100%;
			color: #b00020;
			font-size: 1.2em;
			font-weight: 700;
			z-index: 10;
			transition: all cubic-bezier(0.6, 0, 0.2, 1) 1s;
		}
		form.disabled .disabledTrue{
			right: 0px;
			left: 0px;
			margin: 0 auto;
		}
	</style>
</head>
<body>
	<div id="loadingContainer">
		<div id="loading"></div>
	</div>

	<form action="backend" method="post">
		<div id="guide">Welcome</div>
		<div id="subGuide">Sign in to continue</div>

		<input type="hidden" name="auth">
		<input type="hidden" name="method" value="login">
		<div class="input-container">
			<input type="text" id="first" name="first" autocomplete="given-name">
			<span class="focus-border"></span>
			<label for="first">First</label>
			<div class="error">First name required</div>
		</div>
		<div class="input-container">
			<input type="text" id="last" name="last" autocomplete="family-name">
			<span class="focus-border"></span>
			<label for="last">Last</label>
			<div class="error">Last name required</div>
		</div>
		<div class="input-container">
			<input type="password" id="student_id" name="student_id" autocomplete="password">
			<span class="focus-border"></span>
			<label for="student_id">Student ID</label>
			<div class="error">Student ID required</div>
		</div>
		<div class="input-container">
			<input type="text" id="dob" name="dob" autocomplete="off">
			<span class="focus-border"></span>
			<label for="dob">Date of birth</label>
			<div class="error">Date of birth required</div>
		</div>
		<div id="error"></div>
		<button class="sub" onclick="event.preventDefault();">Create account</button>
		<button class="main" onclick="postForm(event);" name="mainButton">Login</button>
	</form>

	<script>
		var inputs = document.getElementsByTagName('input', 'textarea'),
		form = document.forms[0],
		error = document.getElementById('error');

		// Hide labels, when inputs are filled
		Array.prototype.forEach.call(inputs, function(button){
			button.addEventListener("ready", movement)
			button.addEventListener("focusout", movement)
			button.addEventListener("change", movement)
		})
		function movement (e){
			var target = event.target || event.srcElement
			var text_val = target.value
			if(text_val === ""){
				target.classList.remove('has-value')
			}else {
				target.classList.add('has-value')
			}
		}

		function postForm(e){
			e.preventDefault();

			if (window.XMLHttpRequest) {
				var xmlhttp=new XMLHttpRequest();
			}else{
				var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			var formData = new FormData();
			formData.append('method', form.method.value);
			formData.append('last', form.last.value);
			formData.append('first', form.first.value);
			formData.append('student_id', form.student_id.value);
			formData.append('dob', form.dob.value);
			xmlhttp.open("POST", "backend");
			xmlhttp.send(formData);

			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200){

					if(!this.responseText || !(/^[\],:{}\s]*$/.test(this.responseText.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, '')))){
						// invalid response
						console.log('The server returned an invalid response');
						return;
					}

					var res = JSON.parse(this.responseText);
					console.log(res);

					switch (res.err) {
						case 0:
							error.innerHTML = '';
							window.location = res.redirect;
							break;
						default:
							error.innerHTML = res.msg;
							break;
					}
				}else if(this.readyState==4){

					console.log('An error occured (0X0%s)', this.status);
				}
			}
		}
	</script>
</body>
</html>