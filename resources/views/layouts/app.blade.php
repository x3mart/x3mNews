<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700|Sigmar+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('style/style.css')}}">
    <title>x3mNews</title>
</head>
<body>

<header class="header">
    <h1><a href="/"><span class="header_green">x3m</span><span class="header_violet">News</span></a></h1>
    <h4>мы придумываем новости</h4>
    <div class="header__bottomLine"></div>
</header>

    @yield('main')
    @yield('news')

<footer class="footer">

</footer>
</body>
</html>
