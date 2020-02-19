<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700|Sigmar+One&display=swap" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>x3mNews</title>
</head>
<body>
    <header class="navbar sticky-top navbar-expand navbar-dark bg-primary rounded-pill shadow">
        <a class="navbar-brand ml-5 mr-5 font-weight-bolder" href="{{route('home')}}">x3mNews</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @yield('menuItems')
        </ul>
        <a class="navbar-text mr-5" href="{{route('admin.admin')}}">
            Admin
        </a>
    </header>
    @yield('main')


{{--<footer class="footer navbar navbar-expand bg-primary" style="padding-top: 100px;">--}}

{{--</footer>--}}
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
