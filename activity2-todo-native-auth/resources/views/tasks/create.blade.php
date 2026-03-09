<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task - Todo App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            font-size: 24px;
        }

        .back-link {
            padding: 10px 20px;
            background: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .back-link:hover {
            background: #e0e0e0;
        }

        .content {
            background: white;
            padding: 40px;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
            font-weight: 500;
            font-size: 16px;
        }

        textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            resize: vertical;
            min-height: 120px;
            transition: border-color 0.3s;
        }

        textarea:focus {
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

        .btn-secondary {
            background: #95a5a6;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            box-shadow: 0 5px 20px rgba(149, 165, 166, 0.4);
        }

        .hint {
            color: #999;
            font-size: 13px;
            margin-top: 5px;
        }

        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Add Task</h1>
            <a href="/tasks" class="back-link">← Back to Tasks</a>
        </div>

        <div class="content">
            <h2>Create New Task</h2>

            @if($errors->any())
                <div style="background: #fee; color: #c33; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fcc;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/tasks" method="POST">
                @csrf

                <div class="form-group">
                    <label for="title">Task Title</label>
                    <textarea 
                        id="title" 
                        name="title" 
                        placeholder="Enter your task here..."
                        required
                    >{{ old('title') }}</textarea>
                    <p class="hint">Be specific and clear about what you need to do.</p>
                </div>

                <button type="submit" class="btn">Create Task</button>
                <a href="/tasks" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
