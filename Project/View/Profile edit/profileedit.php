<?php
$response = ["success" => false, "errors" => []];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');

    if (empty($name)) {
        $response["errors"][] = "Name field is required.";
    }

    if (empty($email)) {
        $response["errors"][] = "Email field is required.";
    }

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["errors"][] = "Invalid email format.";
    }

    if (empty($response["errors"])) {
        $response["success"] = true;
    }
}

echo json_encode($response);
?>
