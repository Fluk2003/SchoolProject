<?php
session_start();
include 'sweetalert.php'; // Include SweetAlert for usage

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'connectDB.php'; // Make sure connectDB.php defines a PDO instance named $pdo

    // Check if the login form was submitted (assuming the submit button is named "loginSubmit")
    if (isset($_POST["loginSubmit"])) {
        $userName = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $errors = [];

        // Validate username and password inputs
        if (empty($userName)) {
            $_SESSION["userNameEmpty"] = "กรุณากรอกชื่อผู้ใช้";
            $errors[] = $_SESSION["userNameEmpty"];
        }

        if (empty($password)) {
            $_SESSION["passwordEmpty"] = "กรุณากรอกรหัสผ่าน";
            $errors[] = $_SESSION["passwordEmpty"];
        }

        // If any errors, display them using SweetAlert and stop further processing
        if (count($errors) > 0) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'มีข้อผิดพลาด',
                    html: '" . implode(' ', $errors) . "'
                }).then(() => {
                    window.history.back();
                });
            </script>";
            exit;
        } else {
            try {
                // Prepare a PDO statement to check if the username and password match
                $sqlUserLogin = $pdo->prepare("SELECT * FROM users WHERE username = :userName AND password = :password");
                $sqlUserLogin->bindParam(":userName", $userName);
                $sqlUserLogin->bindParam(":password", $password);
                $sqlUserLogin->execute();

                if ($sqlUserLogin->rowCount() > 0) {
                    // Login successful – set the session and show success SweetAlert
                    $_SESSION["userName"] = $userName;

                    echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบสำเร็จ',
                            text: 'ยินดีต้อนรับ $userName'
                        }).then(() => {
                            window.location.href = '../profile/index.php';
                        });
                    </script>";
                    exit;
                } else {
                    // Login failed – show an error SweetAlert
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่มีบัญชีนี้',
                            text: 'กรุณาตรวจสอบชื่อผู้ใช้และรหัสผ่าน'
                        }).then(() => {
                            window.history.back();
                        });
                    </script>";
                    exit;
                }
            } catch (PDOException $err) {
                // Display any PDO exceptions as an error SweetAlert
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: '" . $err->getMessage() . "'
                    }).then(() => {
                        window.history.back();
                    });
                </script>";
                exit;
            }
        }
    }
}
?>
