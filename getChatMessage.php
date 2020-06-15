<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");

include 'database_connection.php';

set_time_limit(0);

$postdata = file_get_contents('php://input');

$request = json_decode($postdata);
// where does the data come from ? In real world this would be a SQL query or something
$from_id = $request->from_id;
$to_id = $request->to_id;
$timestamp = $request->timestamp;
$sql = "SELECT * from chat_message WHERE (to_user_id=" . $to_id . " and from_user_id=" . $from_id . ") OR (to_user_id=" . $from_id . " and from_user_id=" . $to_id .") order by timestamp DESC limit 1";
$message = [];
if ($result = mysqli_query($connect, $sql)) {
    $row_count = mysqli_num_rows($result);   

    if ($row_count > 0) {
        $i = 0;
        while (true) {
            $i++;
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            // if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
            // $last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;

            // PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
            clearstatcache();
            // get timestamp of when file has been changed the last time
            $last_change_in_data_file = $row['timestamp'];
            $last_time = strtotime($last_change_in_data_file);
    
            // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
            if ($timestamp == '' || $last_time > $timestamp) {
                
               
                $sql = "SELECT * from chat_message WHERE (to_user_id=" . $to_id . " and from_user_id=" . $from_id .") OR (to_user_id=" . $from_id . " and from_user_id=" . $to_id .") order by timestamp desc limit 20";
                $i = 0;
             
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $message[$i]['content'] = $row['chat_message'];
                    $message[$i]['from'] = $row['from_user_id'];
                    $i++;
                }
               
                $result = array(
                    'data_from_file' => $message,
                    
                );

                
                $json = json_encode($message);
                echo $json;

               
                break;

            } else {
                
                sleep(1);
                
            }
        }
    }
}

// main loop
