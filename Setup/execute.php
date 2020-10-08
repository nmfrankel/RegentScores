<?
// load db connection info
require_once "$_SERVER[DOCUMENT_ROOT]/backend.php";

// create connection and load db build queries
echo "Connecting to database<br>";
$conn = new mysqli(servername, username, password);
$sqlQueries = file_get_contents('regentScores.sql');

// check for connection errors
if($conn->connect_errno){
   echo $conn->connect_error;
}
echo "Connected to database<br>";

// execute the full build with sample info
if($conn->multi_query($sqlQueries)){
	echo "Building database<br>";
	while($conn->next_result()){
		/* $result = $conn->store_result();
		$result->free(); */
	}
}

// for debugging
// print_r($conn);

// build successful
$conn->close();
echo "Database built<br>Ready to use!!!";
?>