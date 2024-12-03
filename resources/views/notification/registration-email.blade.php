<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 550px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #dddddd;
        }
        .content {
            padding: 15px;
        }
        p {
            font-size: 12px; 
            line-height: 1.5;
            color: #292828; 
        }
        .footer {
            text-align: center;
            padding: 5px 0;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New User Registration</h1>
            <img src="{{ $message->embed(public_path('assets/img/Logo_1.png')) }}" alt="MediKeep Logo" style="width: 50px; height: auto;">
        </div>
        <div class="content">
            @switch($notificationType)
                @case('created_by_superadmin')
                    <p>The user account has been created by you and has been approved.</p>
                    @break

                @case('created_by_user')
                    <p>A new user has registered and is awaiting approval.</p>
                    @break

                @default
                    <p>An unknown action has occurred.</p>
            @endswitch
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MediKeep. All rights reserved.</p>
        </div>
    </div>
</body>
</html>