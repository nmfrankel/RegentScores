<?php

	$first = $_POST['first'];
	$last = $_POST['last'];
	$id_num = $_POST['id_num'];

	$first = ucwords(strtolower($first));
	$last = ucwords(strtolower($last));

	function f_clean($array) {
	    return array_map('mysql_real_escape_string', $array);
	}
	$_POST = f_clean($_POST);
	function escape_xss($string){
		return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
	};

	$first = escape_xss($first, ENT_QUOTES, 'utf-8');
	$last = escape_xss($last, ENT_QUOTES, 'utf-8');
	$id_num = escape_xss($id_num, ENT_QUOTES, 'utf-8');
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "veretzky";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	//select databse
	//$sql = "SELECT * FROM students WHERE id = '$id_num' AND first = '$first' AND last = '$last'";
	//$sql = "SELECT first, last, student_id, date, subject, grade FROM students JOIN scores WHERE student_id = students.id AND student_id = '$id_num' AND first = '$last' AND last = '$first'";
	$sql = "SELECT student_id, date, subject, grade FROM scores WHERE student_id = '$id_num' ";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$time = $result->num_rows;
		if ($result->num_rows > 1) {
			echo "[";
		}
	    // output data of each row
	    while($row = $result->fetch_array()) {
	        echo 
'{
	"first": "'.$first.'",
	"last": "'.$last.'",
	"id": "'.$row['0'].'",
	"date": "'.$row['1'].'",
	"subject": "'.$row['2'].'",
	"grade": "'.$row['3'].'"
}';
			if($time > 1){
				echo ",";
			}
			$time = $time - 1;
	    }
	    if ($result->num_rows > 1) {
			echo "]";
		}
	} else {
		$sql = "SELECT student_id, date, subject, grade FROM scores WHERE student_id = '$id_num' ";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		$time = $result->num_rows;
		if ($result->num_rows > 1) {
			echo "[";
		}
	    // output data of each row
	    while($row = $result->fetch_array()) {
	        echo 
'{
	"first": "'.$first.'",
	"last": "'.$last.'",
	"id": "'.$row['0'].'",
	"date": "'.$row['1'].'",
	"subject": "'.$row['2'].'",
	"grade": "'.$row['3'].'"
}';
			if($time > 1){
				echo ",";
			}
			$time = $time - 1;
	    }
	    if ($result->num_rows > 1) {
			echo "]";
		}
	} else {
		    echo "There are 0 results.";
		}
	}

	$conn->close();

?>
