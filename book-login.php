<?php
session_start();
include('dbconfig.php');

$error = '';

if(isset($_POST['isbn']) && isset($_POST['password'])){
    $isbn = mysqli_real_escape_string($db, $_POST['isbn']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $result = mysqli_query($db, "SELECT * FROM book_login WHERE isbn='$isbn' AND password='$password'");
    if(mysqli_num_rows($result) > 0){
        $_SESSION['isbn'] = $isbn;
        header("Location: author_dashboard.php");
        exit;
    } else {
        $error = "Invalid ISBN or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .login-header {
            background: #9b27b0;
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .login-header-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            position: relative;
            z-index: 1;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 2.5rem 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border: 1.5px solid #e0e0e0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #9b27b0;
            box-shadow: 0 0 0 0.25rem rgba(155, 39, 176, 0.15);
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1.5px solid #e0e0e0;
            border-right: none;
            color: #6c757d;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: #9b27b0;
            background-color: rgba(155, 39, 176, 0.05);
            color: #9b27b0;
        }

        .input-group:focus-within .form-control {
            border-color: #9b27b0;
        }

        .btn-login {
            background: #9b27b0;
            border: none;
            color: white;
            padding: 0.85rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 0.5rem;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: #7b1fa2;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(155, 39, 176, 0.4);
        }

        .alert {
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .login-footer {
            text-align: center;
            padding: 1.5rem 2rem;
            background-color: #f8f9fa;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .login-footer a {
            color: #9b27b0;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <!-- Header -->
        <div class="login-header">
            <div class="login-header-icon">
                <i class="fas fa-book fs-2"></i>
            </div>
            <h2>Book Login</h2>
            <p>Access your author dashboard</p>
        </div>

        <!-- Body -->
        <div class="login-body">
            <?php if($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo $error; ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <!-- ISBN Input -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">
                        <i class="fas fa-barcode me-2"></i>ISBN
                    </label>
                    <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-book"></i>
                            </span>
                        <input type="text"
                               class="form-control"
                               id="isbn"
                               name="isbn"
                               placeholder="Enter your ISBN"
                               required
                               autocomplete="off">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-key"></i>
                            </span>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <p class="mb-0">
                Need help? <a href="contactus.php">Contact Support</a>
            </p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
