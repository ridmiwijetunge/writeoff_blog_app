<?php
// Simple PHP script with a web interface to check if a website is up or down.
// It uses cURL to send a request to the provided URL and checks the HTTP status code.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = filter_var($_POST['url'], FILTER_VALIDATE_URL);
    if ($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true); // HEAD request only
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            $result = "The website is UP (HTTP Code: $httpCode).";
        } else {
            $result = "The website is DOWN or unreachable (HTTP Code: $httpCode).";
        }
    } else {
        $result = "Invalid URL provided.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Status Checker</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        form { margin-bottom: 20px; }
        input[type="url"] { width: 70%; padding: 8px; }
        button { padding: 8px 16px; }
        .result { font-weight: bold; color: #333; }
    </style>
</head>
<body>
    <h1>Simple Website Status Checker</h1>
    <p>Enter a URL to check if the website is up or down.</p>
    <form method="post">
        <input type="url" name="url" placeholder="https://example.com" required>
        <button type="submit">Check</button>
    </form>
    <?php if (isset($result)): ?>
        <p class="result"><?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>
</body>
</html>