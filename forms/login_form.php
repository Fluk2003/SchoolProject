
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
            background: linear-gradient(to right,rgb(26, 25, 25),rgb(72, 70, 68));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card styling */
        .login-container {
            max-width: 400px;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Login</h2>
            
                
                <form method="POST" action="login_process.php">
                    <div class="mb-3 input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" id="username" name="username" required placeholder="กรุณากรอก username">
                    </div>

                    <div class="mb-3 input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="กรุณากรอก password">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                        <label class="form-check-label" for="remember_me">จดจำฉัน</label>
                    </div>

                    <button type="submit" name ="loginSubmit" class="btn btn-primary">Login</button>
                </form>

                <div class="signup-link">
                    <p>ถ้ายังไม่มีบัญชี ->  <a href="register_form.php">สมัคร</a></p><a href="../index.php">กลับหน้าหลัก</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (for modal, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
