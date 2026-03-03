<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <!-- Liens vers des fichiers CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>

    <!-- Barre de navigation ou sidebar -->
    <div class="sidebar">

    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <header>

        </header>

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Liens vers des fichiers JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
