<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
        }

        .login-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn-custom {
            background: #4facfe;
            color: white;
        }

        .btn-custom:hover {
            background: #00c6ff;
            color: white;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h3 class="login-title">Login</h3>

    <form method="POST" action="">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">
            Login
        </button>
    </form>

</div>

</body>
</html>