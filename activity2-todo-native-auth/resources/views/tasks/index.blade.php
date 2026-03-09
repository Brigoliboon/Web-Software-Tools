<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks - Todo App</title>
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

        .nav-links .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .nav-links .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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

        .stat-card .icon.total {
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

        .stat-card .icon.pending {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
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

        /* Content Section */
        .content-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .section-header {
            padding: 25px 30px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header h2 {
            color: #333;
            font-size: 22px;
        }

        .add-task-btn {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .add-task-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .alert {
            padding: 12px 15px;
            font-size: 14px;
            margin: 20px 30px 0;
        }

        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
            border-radius: 8px;
        }

        .alert-success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
            border-radius: 8px;
        }

        /* Task List */
        .task-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .task-item {
            padding: 20px 30px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-item:hover {
            background: #f9f9f9;
        }

        .task-content {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .task-checkbox {
            width: 22px;
            height: 22px;
            border: 2px solid #ddd;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
        }

        .task-checkbox:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .task-info {
            flex: 1;
        }

        .task-title {
            color: #333;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .task-meta {
            display: flex;
            gap: 20px;
            color: #999;
            font-size: 13px;
        }

        .task-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .task-actions {
            display: flex;
            gap: 10px;
        }

        .task-actions a,
        .task-actions button {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .edit-btn {
            background: #e3f2fd;
            color: #1976d2;
        }

        .edit-btn:hover {
            background: #1976d2;
            color: white;
        }

        .delete-btn {
            background: #fce4e4;
            color: #e74c3c;
        }

        .delete-btn:hover {
            background: #e74c3c;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state .icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            color: #666;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
            margin-bottom: 25px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard {
                grid-template-columns: repeat(2, 1fr);
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

            .task-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .task-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><span>Todo</span> App</h1>
        <div class="nav-links">
            <a href="/profile">Profile</a>
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
                <div class="icon total">📋</div>
                <div class="stat-value">{{ count($tasks) }}</div>
                <div class="stat-label">Total Tasks</div>
            </div>
            <div class="stat-card">
                <div class="icon today">📝</div>
                <div class="stat-value">{{ $tasks->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                <div class="stat-label">Created Today</div>
            </div>
            <div class="stat-card">
                <div class="icon week">📅</div>
                <div class="stat-value">{{ $tasks->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                <div class="stat-label">This Week</div>
            </div>
            <div class="stat-card">
                <div class="icon pending">⏳</div>
                <div class="stat-value">{{ count($tasks) }}</div>
                <div class="stat-label">Pending Tasks</div>
            </div>
        </div>

        <!-- Task List Section -->
        <div class="content-section">
            <div class="section-header">
                <h2>My Tasks</h2>
                <a href="/tasks/create" class="add-task-btn">+ Add New Task</a>
            </div>

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(count($tasks) > 0)
                <ul class="task-list">
                    @foreach($tasks as $task)
                        <li class="task-item">
                            <div class="task-content">
                                <div class="task-checkbox"></div>
                                <div class="task-info">
                                    <div class="task-title">{{ $task->title }}</div>
                                    <div class="task-meta">
                                        <span>📅 Created: {{ $task->created_at->format('M d, Y') }}</span>
                                        <span>🕐 {{ $task->created_at->format('h:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="task-actions">
                                <a href="/tasks/{{ $task->id }}/edit" class="edit-btn">Edit</a>
                                <form action="/tasks/{{ $task->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="empty-state">
                    <div class="icon">📝</div>
                    <h3>No tasks yet</h3>
                    <p>Start by adding your first task to get organized!</p>
                    <a href="/tasks/create" class="add-task-btn">+ Add First Task</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
