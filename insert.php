<?php
//Needed so that computer on different network can access
  header('Access-Control-Allow-Origin: *');

  $id = $_POST['id'];
  $date = $_POST['date'];
  $subject = $_POST['subject'];
  $grade = $_POST['grade'];

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

  $sql = "INSERT INTO scores (id, student_id, date, subject, grade) VALUES (NULL, '$id', '$date', '$subject', '$grade')";

  $result = $conn->query($sql);

  echo $result;

  $conn->close();

?>