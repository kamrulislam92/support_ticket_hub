<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .register-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .btn-custom {
            background: #667eea;
            color: white;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: #5a67d8;
            color: white;
        }

        .small-text {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .small-text a {
            text-decoration: none;
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="register-box">

    <h3 class="title">Create Account</h3>

    <form method="POST" action="">
        @csrf

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">
            Register
        </button>
    </form>

    <div class="small-text">
        Already have an account? <a href="/login">Login</a>
    </div>

</div>

</body>
</html>