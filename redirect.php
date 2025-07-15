<?php
$code = ltrim($_SERVER["REQUEST_URI"], "/"); // remove leading slash
$data = json_decode(file_get_contents("urls.json"), true);

if (isset($data[$code])) {
    header("Location: " . $data[$code]);
    exit();
} else {
    http_response_code(404);
    echo "404 - Short link not found!";
}
?>