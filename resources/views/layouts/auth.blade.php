<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Auth' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-200 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl">
        {{ $slot }}
    </div>
</body>
</html>
