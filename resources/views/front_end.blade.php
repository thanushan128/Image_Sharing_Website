<html>
    <head>
        <title>Laveral Image Sharing</title>
        <link rel="stylesheet" href="{{url('css/style.css')}}">
    </head>
    <body>
        <h2>Your Awsom Image Sharing Website</h2>
        @if (Session::has('errors'))
            <h3 class="error">{{Session::get('error')}}</h3>
        @endif
        @if (Session::has('sucess'))
            <h3 class="sucess">{{Session::get('sucess')}}</h3>
        @endif
        @yield('content')
    </body>
</html>
