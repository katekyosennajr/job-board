<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow max-w-md w-full">
        <h1 class="text-2xl font-bold mb-6 text-center">Admin Login</h1>
        <form method="POST" action="/admin/login">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input name="email" type="email" class="w-full border px-3 py-2 rounded" required autofocus>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Password</label>
                <input name="password" type="password" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember">Remember me</label>
            </div>
            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Login</button>
        </form>
    </div>
</body>
</html>
