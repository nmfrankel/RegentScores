<?
/*
	||\\   ||\\   //|| | | ||
	|| \\  || \\ // ||
	||  \\ ||  \\/  || | ||
	||   \\||       ||

	NOSSON M FRANKEL
	nossonmfrankel@gmail.com
	ALL RIGHTS RESERVED, 2020
*/

	/* set general parameters */
	set_time_limit(0);
	session_start();
	// database variables
	$testing = $_SERVER[HTTP_HOST] == ('localhost' || '127.0.0.1')? 1: 0;
	define('servername', $testing===1 ? "localhost": "");
	define('username', $testing===1 ? "root": "");
	define('password', $testing===1 ? "root": "");
	define('dbname', $testing===1 ? "regentScores": "");
	// post variables
	$method = escape_xss($_POST["method"]);
	$auth = escape_xss($_POST["auth"]);

	/* functions used throughout site */
	// Prevent cross-site scripting
	function escape_xss($string){
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}


	/* run functions based on users method */
	if($method === 'login'){
		// gather posted variables
		$last = strtolower(escape_xss($_POST[last]));
		$first = strtolower(escape_xss($_POST[first]));
		$student_id = escape_xss($_POST[student_id]);
		$dob = strtotime(escape_xss($_POST[dob]));

		$conn = new mysqli(servername, username, password, dbname);
		$result = $conn->query("SELECT * FROM `users` WHERE (users.student_id = '$student_id' AND LOWER(users.last) = '$last') OR (LOWER(users.last) = '$last' AND LOWER(users.first) = '$first' AND users.dob = '$dob') LIMIT 1");

		// send response to page that requested
		if($result->num_rows>0){
			// user info was matched
			$user = $result->fetch_assoc();
			if($user[status]==='0'){
				// account disabled
				echo '{"userLoggedIn": 0, "err": 2, "msg": "Your account was suspended"}';
			}else if($user[status]==='1' || $user[status]==='2'){
				// login successful
				$_SESSION[id] = $user[id]*193;
				$_SESSION[status] = $user[status];
				$_SESSION[first] = $user[first];
				$_SESSION[last] = $user[last];
				$_SESSION[student_id] = $_SESSION[status]!=='1'? substr_replace($user[student_id], 'XXX', 2, 3): null;
				$_SESSION[authToken] = uniqid();
				$_SESSION[isLoggedIn] = true;
				$redirect = $user[status]==='1'? 'insert': 'scores';

				$conn->query("UPDATE users SET authToken = '$_SESSION[authToken]' WHERE id = $_SESSION[id]/193");
				echo '{"userLoggedIn": 1, "err": 0, "redirect": "../'.$redirect.'", "msg": "login successful."}';
			}else{
				// any of the required user details don't match
				echo '{"userLoggedIn": 0, "err": 2, "msg": "Your user type is not supported. Contact customer assistance for help."}';
			}
		}else{
			// any of the required user details don't match
			echo '{"userLoggedIn": 0, "err": 1, "msg": "Your info entered doesn\'t match our records."}';
		}
		$conn->close();
	}else if($method === 'logout'){
		// check wether the user is logged in
		if($_SESSION[isLoggedIn]){
			session_destroy();
			echo '{"userLoggedIn": 0, "redirect": "../", "err": 0, "msg": "You\'re now logged out."}';
			die;
		}else{
			echo '{"userLoggedIn": 0, "redirect": "../", "err": 1, "msg": "You weren\'t logged in."}';
		}
	}else if($method === 'insertStudents' && $auth === '' && $_SESSION[isLoggedIn] && $_SESSION[status] = '1'){
			## insert students

	}else if($method === 'insertScores' && $auth === '' && $_SESSION[isLoggedIn] && $_SESSION[status] = '1'){
			## insert regent scores


			echo json_encode($_POST);

	}else if($method === 'updateScores' && $auth === '' && $_SESSION[isLoggedIn] && $_SESSION[status] = '1'){
			## Use this for inserting new scores

	}else if($method === 'getScores' && $_SESSION[isLoggedIn]){

		// check if user was disabled after logged in
		if($regent[status] === '0' && $key === 0){
			session_destroy();
			echo '{"userLoggedIn": 0, "redirect": "../", "err": 1, "msg": "Your account has been disabled."}';
			exit;
		}else if($_SESSION[status] === '1'){
			$conn = new mysqli(servername, username, password, dbname);
			$result = $conn->query("SELECT * FROM `users` LEFT JOIN scores ON scores.student = users.id LEFT JOIN regent ON regent.id = scores.regent_id WHERE users.status >= 2");
			$conn->close();

			if($result->num_rows>0){
				$response = [];
				foreach ($result as $regent)
					array_push($response, $regent);
				echo '{"response": '.json_encode($response).', "err": "0", "msg": "Score retrieval was successful."}';
			}else{
				echo '{"response": [], "err": "1", "msg": "There aren\'t any results."}';
			}
		}else if($_SESSION[status] !== '1'){
			$conn = new mysqli(servername, username, password, dbname);
			$result = $conn->query("SELECT * FROM scores LEFT JOIN regent ON regent.id = scores.regent_id WHERE scores.student = $_SESSION[id]/193");
			$conn->close();

			$last = $_SESSION[last];
			$first = $_SESSION[first];
			$student_id = $_SESSION[student_id];

			// process db results
			$response = [];
			foreach ($result as $key => $regent)
				array_push($response, ['subject' => $regent[subject], 'date' => date('g:ia n/j/y', $regent[date]), 'grade' => $regent[grade]]);

		// send response back to client
		echo '{
"student_id": "'.$student_id.'",
"first": "'.$first.'",
"last": "'.$last.'",
"regents": '.json_encode($response).'
}';
		}
	}else if((strtok($_SERVER['REQUEST_URI'], '?')=='/backend'||strtok($_SERVER['REQUEST_URI'], '?')=='/backend.php')&&($_SERVER['REDIRECT_STATUS']==200)){

		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
		include("missing.html");
	}
?>