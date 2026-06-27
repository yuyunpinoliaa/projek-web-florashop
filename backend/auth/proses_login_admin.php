<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Florashop - Login Admin</title>
    <style>
        /* Style sederhana agar tampilannya mirip seperti desain aslimu */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .login-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 24px;
            text-align: center;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }
        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f0f4f9; /* Warna soft blue/gray mirip di foto */
            font-size: 16px;
            box-sizing: border-box;
            outline: none;
        }
        .btn-signin {
            width: 100%;
            padding: 14px;
            background-color: #9d2a6e; /* Warna ungu/magenta Florashop */
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-signin:hover {
            background-color: #822059;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-title">Login Admin</div>
        
        <form action="proses_login_admin.php" method="POST">
            <div class="input-group">
                <label for="username">Username / Email</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn-signin">Sign In</button>
        </form>
    </div>

</body>
</html>