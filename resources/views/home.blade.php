{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    @auth
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>Your email is {{ Auth::user()->email }}</p>
        <a href="/logout"> Logout </a>
        {{-- Add more user data here --}}
    @else
        <p>Not authorized!</p>
    @endauth
</body>
</html>