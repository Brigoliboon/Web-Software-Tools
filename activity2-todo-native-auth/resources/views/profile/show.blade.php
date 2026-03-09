<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Todo App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f7fa;
            padding: 0;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header h1 {
            color: #333;
            font-size: 24px;
            font-weight: 700;
        }

        .header h1 span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-links a {
            padding: 10px 20px;
            background: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .nav-links a:hover {
            background: #e0e0e0;
        }

        .logout-btn {
            padding: 10px 20px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* Main Content */
        .main-content {
            padding: 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Dashboard Stats */
        .dashboard {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-card .icon.tasks {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-card .icon.today {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .stat-card .icon.week {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .stat-card .icon.user {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        .stat-card .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            color: #999;
            font-size: 14px;
            font-weight: 500;
        }

        /* Profile Section */
        .profile-section {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 40px;
            text-align: center;
            height: fit-content;
        }

        .avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            color: white;
            font-weight: bold;
        }

        .profile-card h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .profile-card .email {
            color: #999;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .profile-card .joined {
            color: #bbb;
            font-size: 12px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        /* Form Section */
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 40px;
        }

        .form-card h3 {
            color: #333;
            font-size: 22px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            display: inline-block;
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert-success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }

        .divider {
            height: 1px;
            background: #e1e1e1;
            margin: 30px 0;
        }

        .section-title {
            color: #333;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .optional {
            font-size: 12px;
            color: #999;
            font-weight: normal;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard {
                grid-template-columns: repeat(2, 1fr);
            }

            .profile-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .main-content {
                padding: 20px;
            }

            .dashboard {
                grid-template-columns: 1fr;
            }

            .profile-card,
            .form-card {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><span>Todo</span> App</h1>
        <div class="nav-links">
            <a href="/tasks">My Tasks</a>
            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <!-- Dashboard Stats -->
        <div class="dashboard">
            <div class="stat-card">
                <div class="icon tasks">📋</div>
                <div class="stat-value">{{ $taskCount }}</div>
                <div class="stat-label">Total Tasks</div>
            </div>
            <div class="stat-card">
                <div class="icon today">📝</div>
                <div class="stat-value">{{ $todayTaskCount }}</div>
                <div class="stat-label">Created Today</div>
            </div>
            <div class="stat-card">
                <div class="icon week">📅</div>
                <div class="stat-value">{{ $weekTaskCount }}</div>
                <div class="stat-label">This Week</div>
            </div>
            <div class="stat-card">
                <div class="icon user">👤</div>
                <div class="stat-value">1</div>
                <div class="stat-label">Account</div>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <!-- Profile Info Card -->
            <div class="profile-card">
                <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <h2>{{ $user->name }}</h2>
                <p class="email">{{ $user->email }}</p>
                <p class="joined">Member since {{ $user->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Profile Form Card -->
            <div class="form-card">
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <h3>Edit Profile</h3>

                <form action="/profile" method="POST">
                    @csrf
                    @method('POST')

                    <h4 class="section-title">Personal Information</h4>

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="divider"></div>

                    <h4 class="section-title">Change Password <span class="optional">(optional)</span></h4>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                    </div>

                    <button type="submit" class="btn">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
