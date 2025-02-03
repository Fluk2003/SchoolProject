<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION["userName"])) {
  header("Location: login_form.php");
  exit();
}
$userName = $_SESSION["userName"];

try {
  // Connect to the database
  require_once "forms/connectDB.php";

  // Fetch user data
  $sqlFetchUsers = $pdo->prepare("SELECT * FROM users WHERE username = :userName");
  $sqlFetchUsers->bindParam(":userName", $userName);
  $sqlFetchUsers->execute();
  $user = $sqlFetchUsers->fetch(PDO::FETCH_ASSOC);

  if (!$user) {
    throw new Exception("No user found.");
  }

  // Profile image path
  $dir = 'upload/';
  $profileImage = (!empty($user['picture'])) ? $dir . htmlspecialchars($user['picture']) : 'assets/img/default-profile.png';
} catch (PDOException $error) {
  echo "Database error: " . $error->getMessage();
  exit();
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile - <?php echo htmlspecialchars($userName); ?></title>

  <!-- Bootstrap CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: rgb(110, 110, 111);
      color: #333;
    }

    .profile-card {
      background: white;
      color: black;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }

    .profile-img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid #007bff;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background: linear-gradient(to right, #1a1919, #484646);
      padding-top: 20px;
      box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.1);
      transition: width 0.3s ease;
    }

    .sidebar .nav-link {
      color: yellow;
      font-weight: 500;
      padding: 15px 20px;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-radius: 5px;
      font-size: 16px;
    }

    .sidebar .nav-link:hover {
      background-color: #007bff;
      color: white;
    }

    .sidebar .nav-link.active {
      background-color: #ff6600;
      color: white;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }

    .content {
      margin-left: 260px;
      padding: 30px;
    }

    @media (max-width: 991px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .content {
        margin-left: 0;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar d-lg-block collapse navbar-collapse" id="navbarNav">
    <div class="text-center mb-4">
      <img src="<?php echo $profileImage; ?>" alt="Profile Picture" class="profile-img">
      <h5 class="mt-2 text-white"><?php echo htmlspecialchars($userName); ?></h5>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link active" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
      <li class="nav-item"><a class="nav-link" href="edit_profile.php"><i class="fas fa-edit"></i> Edit Profile</a></li>
      <li class="nav-item"><a class="nav-link" href="settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
      <li class="nav-item"><a class="nav-link" href="portfolio.php"><i class="fas fa-images"></i> Portfolio</a></li>
      <li class="nav-item">
        <form action="forms/logout_process.php" method="POST" style="display: inline;">
          <button type="submit" name="logout" class="nav-link" style="background: none; border: none; color: yellow; text-align: left; width: 100%;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </li>

    </ul>
  </div>

  <!-- Profile Section -->
  <div class=" container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="profile-card">
          <h3 class="text-center mb-4">Profile Information</h3>
          <hr>
          <div class="row mb-3">
            <div class="col-4"><strong>Full Name:</strong></div>
            <div class="col-8"><?php echo htmlspecialchars($user['fname'] . ' ' . $user["lname"]); ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-4"><strong>Academic Year:</strong></div>
            <div class="col-8"><?php echo htmlspecialchars($user['grade']); ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-4"><strong>Member Since:</strong></div>
            <div class="col-8">January 2021</div>
          </div>
          <hr>

          <!-- Social Media Links -->
          <h5 class="text-center mb-3">Connect with Me</h5>
          <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-outline-primary mx-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-outline-primary mx-2"><i class="fab fa-facebook"></i></a>
            <a href="#" class="btn btn-outline-danger mx-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-outline-info mx-2"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelector(".navbar-toggler").addEventListener("click", function() {
      document.querySelector(".sidebar").classList.toggle("collapse");
    });
  </script>

</body>

</html>