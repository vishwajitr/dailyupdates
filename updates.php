<?php

$url = 'https://api.flock.com/hooks/sendMessage/ef5b0eaf-8929-410f-b2bd-b4e91d6ad2be';

$data = array(
    'text' => $_POST['hiddenTextarea']
);

$data_string = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string)
));

$result = curl_exec($ch);
print_r($result);

// Check for errors
if ($result === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    echo 'Request sent successfully!';
}

curl_close($ch);
?>
