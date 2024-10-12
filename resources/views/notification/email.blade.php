<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Account Status</title>
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
            line-height: 1;
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
            <h1>Hello {{ $user->name }}!</h1>
            <img src="{{ $message->embed(public_path('assets/img/Logo_1.png')) }}" alt="MediKeep Logo" style="width: 50px; height: auto; margin-right: 10px;">  
        </div>
        <div class="content">
            @switch($type)
                @case('created')
                    <p>Your account has been successfully created and is awaiting approval.</p>
                    @break
                @case('archived')
                    <p>Your account has been temporarily disabled.</p>
                    @break
                @case('restored')
                    <p>Your account has been successfully restored.</p>
                    @break
                @case('deleted')
                    <p>Your account has been permanently deleted.</p>
                    @break
                @case('status')
                    <p>Your status has been {{ $status }}.</p>
                    @break
                @case('role')
                    @php
                        $roleNames = [
                            \App\Models\User::ROLE_STAFF => 'Staff',
                            \App\Models\User::ROLE_ADMIN => 'Admin',
                            \App\Models\User::ROLE_SUPERADMIN => 'Super Admin'
                        ];
                        $roleName = $roleNames[$role] ?? 'Unknown';
                    @endphp
                    <p>You have been set as {{ $roleName }}.</p>
                    @break
            @endswitch

            <p>Regards,</p>
            <p>MediKeep</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MediKeep. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
