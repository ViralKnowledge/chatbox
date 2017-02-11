<?php 
$con = mysqli_connect('localhost', 'root','','chat');
$data = $_REQUEST;

$last_id = $data['last_id'];

if(isset($data['username']) && isset($data['message'])){
	$username = $data['username'];
	$message = $data['message'];
	$query = "INSERT INTO message VALUES('','$username','$message')";
	mysqli_query($con, $query);
}

$query = "SELECT * FROM message WHERE chat_id > $last_id";
$result = mysqli_query($con, $query);

$args = array();
$row_count = mysqli_num_rows($result);

if($row_count > 0){
	while($row = mysqli_fetch_assoc($result)){
		array_push($args, $row);
	}
}
mysqli_close($con);

echo json_encode($args);

?>