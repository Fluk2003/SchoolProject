<?php
session_start();

// Include the database connection file

include 'sweetalert.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    require_once 'connectDB.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $grade = $_POST['grade'];

    // Initialize error message
    $error_message = "";

    // Check for empty fields
    if (empty($username)) {
        $error_message .= "กรุณากรอกชื่อผู้ใช้ (Username)<br>";
    } elseif (strlen($username) <= 6) {
        $error_message .= "ชื่อผู้ใช้ (Username) ต้องมีความยาวมากกว่า 6 ตัวอักษร<br>";
    }

    if (empty($password)) {
        $error_message .= "กรุณากรอกรหัสผ่าน (Password)<br>";
    } elseif (strlen($password) < 8) {
        $error_message .= "รหัสผ่าน (Password) ต้องมีความยาวอย่างน้อย 8 ตัวอักษร<br>";
    }

    if ($password !== $confirm_password) {
        $error_message .= "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน<br>"; // Passwords do not match
    }

    if (empty($fname)) {
        $error_message .= "กรุณากรอกชื่อ (First Name)<br>";
    }
    if (empty($lname)) {
        $error_message .= "กรุณากรอกนามสกุล (Last Name)<br>";
    }
    if (empty($grade)) {
        $error_message .= "กรุณากรอกชั้นปี (Grade)<br>";
    }

    // Image upload handling
    $profile_picture = "";
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "../upload/";  // Folder for storing images
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            // Save the image to the uploads directory
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $profile_picture = $target_file; // Save the path in the database
            } else {
                $error_message .= "ขออภัย, เกิดข้อผิดพลาดในการอัปโหลดภาพ.<br>";
            }
        } else {
            $error_message .= "ไฟล์ที่อัปโหลดไม่ใช่ภาพ.<br>";
        }
    }

    // If there are errors, display the error message
    if (!empty($error_message)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'มีข้อผิดพลาด',
                    html: '$error_message',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'register_form.php';
                    }
                });
            </script>";
        exit(); // Stop the script execution if there are errors
    }

    // Password hash (important for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    try {
        // Check if the username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ชื่อผู้ใช้ (Username) นี้มีการใช้งานแล้ว',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'register_form.php';
                        }
                    });
                </script>";
            exit();
        } else {
            // Insert new user data
            $stmt = $pdo->prepare("INSERT INTO users (username, password, fname, lname, grade, picture) 
                                    VALUES (:username, :password, :fname, :lname, :grade, :picture)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password); // Store hashed password
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':grade', $grade);
            $stmt->bindParam(':picture', $profile_picture);

            $stmt->execute(); // Execute the SQL query

            $_SESSION['username'] = $username; // Start session with username

            // Show success message with SweetAlert
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'ลงทะเบียนสำเร็จ',
                        text: 'คุณสามารถเข้าสู่ระบบได้ทันที',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login_form.php';
                        }
                    })
                </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: '" . $e->getMessage() . "',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'register_form.php';
                    }
                });
            </script>";
        exit();
    }
}
?>
