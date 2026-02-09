<?php
require 'db.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$prompt = $data["prompt"];

$apiKey = "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";

$ch = curl_init("https://api.openai.com/v1/chat/completions");

$postData = [
  "model" => "gpt-4o-mini",
  "messages" => [
    ["role" => "system", "content" => "You are a helpful study assistant."],
    ["role" => "user", "content" => $prompt]
  ]
];

curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$response = json_decode($result, true);

$aiReply = $response["choices"][0]["message"]["content"];

// save to database
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO chats (user_id, message, response)
        VALUES ('$user_id', '$prompt', '$aiReply')";
mysqli_query($conn, $sql);

echo json_encode(["reply" => $aiReply]);
