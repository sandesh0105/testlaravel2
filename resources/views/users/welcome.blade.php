<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }
        .container {
            background: #f9f9f9;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .success {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to User Management System</h1>
        
        @if(session()->has('success'))
            <div class="success">
                {{session('success')}}
            </div>
        @endif
        
        <p>Please choose an option to continue:</p>
        
        <div>
            <a href="{{route('user.login')}}" class="btn">Login</a>
            <a href="{{route('user.signup')}}" class="btn">Sign Up</a>
        </div>
    </div>
</body>
</html>