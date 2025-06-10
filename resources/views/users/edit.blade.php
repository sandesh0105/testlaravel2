<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-container {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"], input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            background: #ffc107;
            color: black;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #e0a800;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .note {
            background: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit User</h1>
        
        <div class="error">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        
        <form method="POST" action="{{route('user.update',['user'=>$user])}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" value="{{$user->username}}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
                <div class="note">Note: Leave password field empty if you don't want to change it.</div>
            </div>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" value="{{$user->dob->format('Y-m-d')}}" required>
            </div>
            <div class="form-group">
                <label>College</label>
                <input type="text" name="college" placeholder="College" value="{{$user->college}}" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update User" class="btn">
            </div>
        </form>
        
        <a href="{{route('user.index')}}" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>