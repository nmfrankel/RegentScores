<?
session_start();
if (!isset($_SESSION['isLoggedIn']) || !isset($_SESSION['id']) || $_SESSION['status'] !== '1'){
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
	ALL RIGHTS RESERVED, <?=date('Y')?>
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="main.css">
	<title>Add students | RegentScores</title>
</head>
<body>
	<header align='center'>
		<!-- SWITCH BUTTONS TO LABELS -->
		<button>insert single score</button>
		<button for='file'>upload file</button>
		<input type="file" name="file" id="file" style="display: none;">
	</header>

	<div align='center'>
		Create new regent<br>
		Add students<br>
		Disable/Enable user accounts<br>
		Insert regent scores<br>
		? Change scores
	</div>

	<table align='center'>
		<thead>
			<th>Student Id</th>
			<th>Last</th>
			<th>First</th>
			<th>Birthday</th>
		</thead>
	</table>

	<script>
		// run on page load
		function loadScores(){
			let formData = new FormData()
			formData.append('method', 'getScores')

			fetch('backend', {
				method: "POST",
				body: formData
			}).then((res)=>{
				return res.json()
			}).then((jsonRes)=>{
				console.log(jsonRes)
				console.log("FINISH loadScores()")
			}).catch((err)=>{
				console.error('An error occured while loading scores: %s', err)
			})
		}
		// insert scores (both single or file are supported)
		function insertScores(){
			let multi = document.getElementById('file').files[0]
			let formData = new FormData()
			formData.append('method', 'insertScores')
			formData.append('option', multi? 'multiple': 'single')// single or multiple
			if(multi){
				document.getElementById('file').files[0].text().then((text)=>{
					console.log(text)
				})
			}else{
				
			}

			fetch('backend', {
				method: "POST",
				body: formData
			}).then((res)=>{
				return res.json()
			}).then((jsonRes)=>{
				console.log(jsonRes)
				console.log("Finish insertScores()")
			}).catch((err)=>{
				console.error('An error occured while inserting scores: %s', err)
			})
		}
	</script>
</body>
</html>