<?php
$conn = mysqli_connect('localhost', 'root', 'Root@1234', 'viper');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Email already exists.";
    } else {
        // Insert new user
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo "Registration successful.";
        } else {
            echo "Registration failed: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
