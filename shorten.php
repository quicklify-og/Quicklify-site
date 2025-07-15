<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $url = trim($_POST["url"]);
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Invalid URL";
        exit();
    }

    $dataFile = "urls.json";
    $data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

    // Check if already shortened
    if (($code = array_search($url, $data)) === false) {
        $code = substr(md5($url . time()), 0, 6);
        $data[$code] = $url;
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    echo $code;
}
?>