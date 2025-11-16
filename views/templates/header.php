<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $heading ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
            color: white;
        }

        body {
            background-color: #0b0e16;
        }

        h1 {
            font-size: 30px;
        }

        header {
            margin: 30px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 20px;

            padding: 10px;
            border-radius: 10px;
        }

        a {
            text-decoration: none;
        }

        .right-block {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .nav-item {
            font-size: 17px;
            background-color: #202531;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 999px;
            transition: 0.3s ease;
        }

        .nav-item:hover {
            transform: translateY(3px);
            box-shadow: 0 0px 4px #667086;
        }

        .focused {
            border: 1px solid rgba(92, 139, 215);
        }


    </style>
</head>

<body>
    <header>
        <a class="logo" href="/">
            <svg width="40px" height="40px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16ZM9 5H7V11H9V5Z" fill="#eef0f4" />
            </svg>
            <h1>
                PointsBank
            </h1>
        </a>
        <div class="right-block">
            <a href="/login" class="nav-item <?= ($path == '/login')  ? "focused" : "" ?>">Log in</a>
            <a href="/register" class="nav-item <?= ($path == '/register')  ? "focused" : "" ?>">Register</a>

        </div>

    </header>