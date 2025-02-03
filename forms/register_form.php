<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Modern Bootstrap Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Background gradient */
        body {
            background: linear-gradient(to right, rgb(26, 25, 25), rgb(72, 70, 68));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card styling */
        .login-container {
            max-width: 450px;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            transition: transform 0.3s ease-in-out;
        }

        .login-container:hover {
            transform: scale(1.02);
        }

        .card-title {
            text-align: center;
            font-size: 2rem;
            color: #333;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 25px;
            padding-left: 40px;
        }

        .form-control:focus {
            border-color: #feb47b;
            box-shadow: 0 0 10px rgba(254, 180, 123, 0.5);
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #feb47b;
            border: none;
            border-radius: 25px;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff7e5f;
        }

        .form-check-label {
            color: #333;
        }

        /* Remember Me checkbox */
        .form-check-input {
            border-radius: 50%;
        }

        .signup-link {
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            color: #feb47b;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Icons inside input fields */
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #feb47b;
        }

        .input-group {
            position: relative;
        }

        /* Margin for the fields */
        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Login</h2>
                
                <?php if(isset($error_message)) { echo "<div class='error'>$error_message</div>"; } ?>
                <?php if(isset($image_upload_message)) { echo "<div class='error'>$image_upload_message</div>"; } ?>

                <!-- Form Start -->
                <form method="POST" action="register_process.php" enctype="multipart/form-data">
                    <!-- Username -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" id="username" name="username" required placeholder="กรุณากรอก username (6 ตัวอักษรขึ้นไป)">
                    </div>

                    <!-- Password -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="กรุณากรอก password (8 ตัวอักษรขึ้นไป)">
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="กรุณากรอกยืนยันรหัสผ่าน">
                    </div>

                    <!-- First Name -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" id="fname" name="fname" required placeholder="กรุณากรอกชื่อ">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" id="lname" name="lname" required placeholder="กรุณากรอกนามสกุล">
                    </div>

                    <!-- Grade Year -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-school input-icon"></i>
                        <input type="text" class="form-control" id="grade" name="grade" required placeholder="กรุณากรอกชั้นปี (มัธยมศึกษาปีที่ 1-6)">
                    </div>

                    <!-- Profile Picture -->
                    <div class="mb-3 input-group">
                        <i class="fas fa-image input-icon"></i>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <!-- Signup Link -->
                <div class="signup-link">
                    <p>ถ้ามีรหัสแล้ว -> <a href="login_form.php">กลับไปที่หน้า login</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (for modal, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
