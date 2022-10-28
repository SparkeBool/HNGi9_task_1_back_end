<?php
include('db.php');

header("Content-Type:application/json");

if (isset($_GET['user_id'])) {
	
	$user_id = $_GET['user_id'];

    $sql = "SELECT * FROM mybio WHERE user_id = '".$user_id."'";

	$result = $con->query($sql);

	if($result->num_rows >0 ){
    
    $row = mysqli_fetch_assoc($result);

	$SlackUsername = $row['SlackUsername'];
	$age = $row['age'];
	$backend = $row['backend'];
    $bio = $row['bio'];

	      
 response($SlackUsername,$age,$backend,$bio);  
	mysqli_close($con);
	}else{
		response(NULL, NULL, 200,"Nothing to show");
		}
}else{
	response(NULL, NULL, 400,"Invalid Request");
	}

function response($SlackUsername,$age,$backend,$bio){
	$response['SlackUsername'] = $SlackUsername;
	$response['age'] = $age;
	$response['backend'] = $backend;
	$response['bio'] = $bio;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>
