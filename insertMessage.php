<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");

include 'database_connection.php';

set_time_limit(0);

$postdata = file_get_contents('php://input');

$request = json_decode($postdata);

$from_id = $request->from_id;
$to_id = $request->to_id;
$message = mysqli_real_escape_string($connect,$request->message);
$mssv = $request->mssv;

$sql = "INSERT INTO chat_message (from_user_id,to_user_id,chat_message,status,mssv) values (".$from_id.",".$to_id.",'".$message."',0,".$mssv.")";
$result = mysqli_query($connect,$sql);

echo $sql;


