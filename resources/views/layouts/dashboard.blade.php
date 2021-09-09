<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GH Care | Dashboard</title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <script src="{{asset('/js/app.css')}}"></script>
</head>
<body>
    @include('includes.sidebar')
    <div class="col-9 offset-3">
        <div class="container">
            @include('includes.topbar')
            @yield('content')
        </div>
    </div>
</body>
</html>