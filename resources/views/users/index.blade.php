<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 8px 16px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-warning {
            background: #ffc107;
            color: black;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f8f9fa;
            font-weight: bold;
        }
        tr:hover {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>User Management Dashboard</h1>
        <form method="POST" action="{{route('user.logout')}}" style="margin: 0;">
            @csrf
            <input type="submit" value="Logout" class="btn btn-secondary">
        </form>
    </div>
    
    @if(session()->has('success'))
        <div class="success">
            {{session('success')}}
        </div>
    @endif
    
    <div style="margin-bottom: 20px;">
        <p><strong>Total Users:</strong> {{count($users)}}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Username</th>
                <th>Date of Birth</th>
                <th>College</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->dob->format('Y-m-d')}}</td>
                    <td>{{$user->college}}</td>
                    <td>
                        <a href="{{route('user.edit',['user' => $user])}}" class="btn btn-warning">Edit</a>
                        <form method="POST" action="{{route('user.destroy',['user'=>$user])}}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @if(count($users) == 0)
        <div style="text-align: center; padding: 40px; color: #666;">
            <p>No users found.</p>
        </div>
    @endif
</body>
</html>