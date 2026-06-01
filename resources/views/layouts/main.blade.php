<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nani Ga Suki?</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --matcha: #B7D3B0;
            --soft-pink-bg: #ffeef4;
            --strawberry: #e26d9f;
            --strawberry-hover: #c9547a;
            --card-header: #e89ab5;
            --text: #4a4a4a;
            --soft-white: #ffffff;
            --pastel-pink: #FFD1DC;
            --input-border: #f0c0d0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--soft-pink-bg);
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--matcha) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 8px 0;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem !important;
            font-weight: 700;
            color: white !important;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: var(--soft-pink-bg) !important;
            transform: translateY(-1px);
        }

        .btn-logout {
            background-color: white;
            color: var(--strawberry);
            border: none;
            border-radius: 20px;
            padding: 5px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .btn-logout:hover {
            background-color: var(--soft-pink-bg);
            color: var(--strawberry-hover);
            transform: translateY(-1px);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: var(--soft-white);
        }

        .card-header {
            background-color: var(--card-header) !important;
            border-radius: 16px 16px 0 0 !important;
            padding: 16px 20px;
        }

        .card-header h4,
        .card-header h5 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin: 0;
            color: white;
        }

        .card-header p {
            color: white;
            opacity: 0.85;
            font-size: 0.85rem;
        }

        .btn-pink {
            background-color: var(--strawberry);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-pink:hover {
            background-color: var(--strawberry-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            background-color: white;
            border-radius: 10px;
            border: 1.5px solid var(--input-border);
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: var(--text);
            padding: 10px 14px;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--strawberry);
            box-shadow: 0 0 0 0.2rem rgba(226, 109, 159, 0.2);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--text);
            margin-bottom: 6px;
        }

        a {
            color: var(--strawberry);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        a:hover {
            color: var(--strawberry-hover);
        }

        hr {
            border-color: var(--pastel-pink);
            opacity: 0.6;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #ffe4e4;
            border-color: #ffb3b3;
            color: #c0392b;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: var(--text);
            font-size: 0.82rem;
            margin-top: 40px;
            opacity: 0.6;
        }
    </style>
</head>
<body>

    @include('navbar')

    <div class="container mt-5">
        @yield('content')
    </div>

    <div class="footer">
        🍦 Nani Ga Suki? &copy; {{ date('Y') }} — Made with love
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>