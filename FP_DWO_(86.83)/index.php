<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Dashboard AW Mekdi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2e59d9, #1c4bbc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .login-container {
            background: #fff;
            border-radius: 12px;
            padding: 40px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            color: #333;
        }

        .login-container h1 {
            font-weight: 600;
            color: #2e59d9;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
        }

        .btn-primary {
            background-color: #2e59d9;
            border-color: #2e59d9;
            border-radius: 8px;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #1c4bbc;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>
            <div class="error-message" id="errorMessage">
                Invalid username or password.
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        // Login validation
        document.getElementById("loginForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            if (username === "melor" && password === "melor") {
                alert("Login successful! Welcome, Melor.");
                // Redirect to dashboard or another page
                window.location.href = "home.php";
            } else {
                document.getElementById("errorMessage").style.display = "block";
            }
        });
    </script>
</body>

</html>
