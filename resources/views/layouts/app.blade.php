<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Scores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(to bottom, #ffde59, #009688);
            position: fixed;
            padding-top: 30px;
            color: #000;
        }
        .sidebar h4 {
            text-align: center;
            font-weight: bold;
        }
        .sidebar a {
            color: #000;
            display: block;
            padding: 12px 25px;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
        .content {
            margin-left: 240px;
            padding: 30px;
        }
        .navbar {
            background-color: #0d47a1;
            color: white;
            padding: 15px 30px;
            font-weight: bold;
            font-size: 20px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }
        @media (max-width: 992px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        padding: 10px;
    }

    .sidebar a {
        padding: 10px;
        font-size: 14px;
    }

    .content {
        margin-left: 0;
        padding: 20px;
    }

    .navbar {
        font-size: 18px;
        text-align: center;
    }
}

    </style>
</head>
<body>
   <div class="sidebar">
    <h4>Menu</h4>
    <a href="{{ url('/') }}" 
       class="{{ request()->is('/') ? '' : '' }}">
       Dashboard
    </a>

    <a href="{{ route('scores.index') }}" 
       class="{{ request()->routeIs('scores.index') ? 'active' : '' }}">
       Search Scores
    </a>

    <a href="{{ route('report.index') }}" 
       class="{{ request()->routeIs('report.index') ? 'active' : '' }}">
       Reports
    </a>

    <a href="{{ route('top.groupA') }}" 
       class="{{ request()->routeIs('top.groupA') ? 'active' : '' }}">
       Top 10 Students Group A
    </a>
</div>


    <div class="content">
        <div class="navbar">G-Scores</div>
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
