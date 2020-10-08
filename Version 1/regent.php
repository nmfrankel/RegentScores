<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="jquery-3.1.1.min.js"></script>
	<title>Marks</title>
	<style type="text/css">
		body{
			padding: 0px;
			margin: 0px;
			font:1em/1.2 arial;
		}
		a{
			position: absolute;
			top: 20px;
			right: 40px;
			text-decoration: none;
			background-color: #888;
			color: #fff;
			text-align: center;
			padding: 10px 18px;
			text-transform: uppercase;
			border-radius: 10px;
			transition: all .25s ease-in-out;
			box-shadow: 0 0 10px #aaa;
			display: none;
		}
		a:hover{
			background-color: #666;
			box-shadow: 0 0 10px #676767;
		}
		main{
			display: block;
			position: absolute;
			top: calc(50% - 1.5in);
			left: calc(50% - 1.75in);
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		#card{
			border-radius: 10px;
			border: 2px solid #000;
			height: 2in;
			width: 3.25in;
			box-shadow: 0 0 15px 3px #aaa;
		}
		#photo{
			width: 1in;
			height: 1in;
			position: absolute;
			top: .5in;
			right: .2in;
			background: gray;
		}
		img{
			height: .5in;
			width: 1.75in;
			margin: .1in;
		}
		#year-came-in, #number{
			margin-left: .1in;
			padding-bottom: 4px;
		}
		input[name="last"]{
			width: calc((1.75in / 2) - 5px);
			margin-left: .1in;
		}
		input[name="first"]{
			width: calc((1.75in / 2) - 6px);
			margin-bottom: 6px;
			margin-left: 3px;
		}
		input[name="id_number"]{
			padding-left: 2px;
			width: .86in;
			margin-left: .1in;
		}
		#preset{
			margin: 0 0 0 .1in;
			line-height: 1.35;
		}
		#submit{
			margin-top: 25px;
			text-transform: uppercase;
			font-size: 1.4em;
			font-weight: 600;
			background-color: #03a9f4;
			color: #fff;
			text-align: center;
			padding-top: 8px;
			padding-bottom: 8px;
			border-radius: 10px;
			transition: all .25s ease-in-out;
			box-shadow: 0 0 10px #aaa;
			cursor: pointer;
		}
		#submit:hover{
			background-color: #2196f3;
			box-shadow: 0 0 10px #676767;
		}
		footer{
			display: block;
		}
		#name{
			margin-left: 15%;
			padding: 0 2px;
			margin-top: calc(17% - 29px);
		}
		#names{
			text-decoration: underline;
		}
		table{
			width: 70%;
			height: 56%;
			margin-left: 15%;
			text-align: center;
		}
		thead{
			font-size: 1.3em;
			line-height: 1.2;
			font-weight: 600;
			background-color: #d5d5d5;
		}
		tr:nth-child(even){
			background-color: lightgray;
		}
		#date{
			width: 20%;
			min-width: 100px;
		}
		#subject{
			width: 60%;
		}
		#grade{
			width: 20%;
			min-width: 100px;
		}
		#error{
			position: absolute;
			width: 182px;
			overflow: hidden;
			margin-top: 8px;
			left: 19%;
			text-align: center;
			color: #f00;
			text-transform: uppercase;
		}
		th:nth-child(2){
			text-align: left;
			padding-left: 1%;
		}
		td:nth-child(2){
			text-align: left;
			padding-left: 1%;
		}
	</style>
</head>
<body>
<a href="">Logout</a>
<main>
	<div id="card">
		<img src="header.png", alt="Header">
		<div id="year-came-in">September 2016</div>
		<input type="text" name="last" placeholder="Last">
		<input type="text" name="first" placeholder="First">
		<div id="photo"></div>
		<div id="number">ID number<input type="text" name="id_number" placeholder="613000000"></div>
		<div id="preset">718-252-7777<br>1102 Ave L, Bklyn NY 11230</div>
	</div>
	<div id="submit">get scores</div>
</main>

<footer style="display: none;">
	<div id="name">
		<span>Name: </span>
		<span id="names">
			<span id="last"></span>
			<span> , </span>
			<span id="first"></span>
		</span>
	</div>
	<table>
		<thead>
			<th id="date">Date</th>
			<th id="subject">Subject</th>
			<th id="grade">Grade</th>
		</thead>
		<tbody>
		</tbody>
	</table>
</footer>

<script type="text/javascript">
	$('#submit').click(function(){
		var name = {
			first: $("input[name='first']").val(),
			last: $("input[name='last']").val(),
			id: $("input[name='id_number']").val()
		};

		var formdata = new FormData();
		formdata.append('first', name.first);
		formdata.append('last', name.last);
		formdata.append('id_num', name.id);
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'scores.php', true);
		xhr.send(formdata);

		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 && xhr.status == 200){
				console.log(xhr.responseText);
				if(xhr.responseText = 'There are 0 results.'){
					$('main').append("<span id='error'>User doesn't exist</span>");
				}
				response = JSON.parse(xhr.responseText);
				count = $(response).toArray().length;
				if(count == 1){
					$('tbody').append('<tr><td>'+ response.date +'</td><td>'+ response.subject +'</td><td>'+ response.grade +'</td></tr>');
					$('#first').text(response.first);
					$('#last').text(response.last);
				}else if(count > 1){
					for(i = 0; i < count; i++){
						$('tbody').append('<tr><td>'+ response[i].date +'</td><td>'+ response[i].subject +'</td><td>'+ response[i].grade +'</td></tr>');
					}
					$('#first').text(response[0].first);
					$('#last').text(response[0].last);
				}
				$('main').hide().fadeOut('fast');
				$('footer').show().fadeIn('fast');
				$('a').show().fadeIn('fast');
			}
		};

	});

	$('input').keypress(function(e){
		if((e.which || e.keyCode) == 13){
			e.preventDefault();
			$('#submit').click();
		}
	});

	$('body').ready(function(){
		$('center').hide().css('opacity','0');
	});
</script>
</body>
</html>
