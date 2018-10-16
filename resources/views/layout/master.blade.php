<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inspire Me</title>
    <link rel="stylesheet" href="/css/app.css" />
</head>

<body>
    @include('layout.nav')

    <div class="container">
        @yield('content')
    </div>

    @if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
    @endif

</body>

</html>
