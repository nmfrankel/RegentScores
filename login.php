<?//session_destroy();?>
<!--
||\\   ||\\   //|| | | ||
|| \\  || \\ // ||
||  \\ ||  \\/  || | ||
||   \\||       ||

	NOSSON M FRANKEL
	nossonmfrankel@gmail.com
	ALL RIGHTS RESERVED, <?php echo date('Y')?>
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="main.css">
	<title>Login | RegentScores</title>
	<style>
		form{
			text-align: center;
			margin: 0 auto;
			width: 320px;
		}
		input{
			display: block;
			width: 275px;
			margin: 20px auto;
		}
	</style>
</head>
<body>
	
	<form onsubmit="login(event)">
		<div id="error"></div>
		<input type="hidden" name="method" value="login">
		<input type="text" name="last" placeholder="last">
		<input type="text" name="first" placeholder="first">
		<input type="text" name="student_id" placeholder="student_id">
		<input type="text" name="dob" placeholder="dob">
		<button type="submit">Login</button>
	</form>

	<script>
		var form = document.forms[0],
		error = document.getElementById('error');

		function login(e){
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