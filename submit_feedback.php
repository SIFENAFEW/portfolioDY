<?php
// Only process the form if it's submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost:8080";  // your database server
    $username = "root";         // your database username
    $password = "";             // your database password
    $dbname = "contact_form";   // your database name
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form inputs and sanitize them
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Insert form data into database
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Prepare the email
        $to = "sifenafework1@gmail.com"; // Replace with your email
        $subject = "New Contact Form Submission";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "Thank you for your message!";
        } else {
            echo "There was a problem sending your message.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?> 
