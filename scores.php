<?
session_start();
if (!isset($_SESSION['isLoggedIn']) || !isset($_SESSION['id'])){
	echo 'Please login...';
	header("Location: ../"); /* Redirect browser */
	exit;
}
?>
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
	<title>Scores | RegentScores</title>
	<style>
		#loadingMessage, #userInfo{
			width: 70%;
			margin: 0 auto;
			text-align: center;
			padding: 50px 0 25px;
			font-size: 22px;
		}
		#scoreContainer{
			max-width: 700px;
			margin: 25px auto 25px;
		}
		.entry{
			position: relative;
			min-width: 250px;
			width: 90%;
			max-width: 300px;
			box-shadow: 1px 2px 10px 2px #eee;
			min-height: 40px;
			margin: 10px auto;
			padding: 10px 90px 10px 15px;
			border-radius: 5px;
		}
		.title{
			font-size: 20px;
		}
		.date{
			position: absolute;
			bottom: 8px;
			left: 15px;
			font-size: 14px;
			color: #333;
		}
		.score{
			position: absolute;
			top: 5px;
			right: 10px;
			font-size: 22px;
			background: #ccc;
			width: 55px;
			text-align: center;
			padding: 12px 0;
			border-radius: 5px;
		}
		.score.good{
			background: #1cb102;
			color: white;
		}
		.score.avrage{
			background: #ff9800;
		}
		.score.bad{
			background: #ff0000;
			color: white;
		}
	</style>
</head>
<body>
	<div id="loadingMessage"><b>Your scores are being loaded</b></div>

	<div id="userInfo" style="display:none;">
		<span>Available scores for</span><br>
		<span id="name">&nbsp;</span>
		<span id="student_id"></span>
		<br>
	</div>

	<div id="scoreContainer">
		<!-- auto-fill regents -->
	</div>

	<script>
		var loadingMessage = document.getElementById('loadingMessage'),
		nameEl = document.getElementById('name'),
		student_id = document.getElementById('student_id'),
		scoreContainer = document.getElementById('scoreContainer');

		if (window.XMLHttpRequest) {
			var xmlhttp=new XMLHttpRequest();
		}else{
			var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		var formData = new FormData();
		formData.append('method', 'getScores');
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

				loadingMessage.style.display = 'none';

				nameEl.innerText = res.last + ', ' + res.first;
				student_id.innerText = '('+res.student_id+')';
				document.getElementById('userInfo').removeAttribute('style')

				if(res.regents.length>0){
					for (var i = 0; i < res.regents.length; i++) {
						var regent = res.regents[i];
						var regentEL = document.createElement('div');
						var gradeRating = regent.grade!=='M' || regent.grade>75? 'good': 'bad';

						regentEL.classList.add('entry');
						regentEL.innerHTML = '<span class="title">'+regent.subject+' regent</span><span class="date">'+regent.date+'</span><span class="score '+gradeRating+'">'+regent.grade+'</span>';
						scoreContainer.appendChild(regentEL);
					}
				}else{
					var errorEL = document.createElement('div');
					errorEL.classList.add('entry');
					errorEL.innerHTML = '<span class="title">You have no regent entries</span><span class="date">Currently</span><span class="score">N/A</span>';
					scoreContainer.appendChild(errorEL);
				}
			}else if(this.readyState==4){

				console.log('An error occured (0X0%s)', this.status);
				loadingMessage.innerText = 'An error occured while fetching your regent scores (0X0'+this.status+')';
			}
		}
	</script>
</body>
</html>