<?php
$data = json_decode(file_get_contents("php://input"), true);
$prompt = $data["prompt"];

$apiKey = "sk-abcdef1234567890abcdef1234567890abcdef12";

$ch = curl_init("https://api.openai.com/v1/chat/completions");

$postData = [
  "model" => "gpt-4o-mini",
  "messages" => [
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

echo json_encode(["reply" => $response["choices"][0]["message"]["content"]]);
