<html>
    <head>
        <title>Stars - @yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/demo.css') }}" />
	
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/easy-responsive-tabs.css') }} " />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="{{ URL::asset('js/easyResponsiveTabs.js') }}"></script>
    </head>
    <body>
        <div>
            @yield('content')
        </div>

        @section('javascript')
            This is the master sidebar.
        @show
        
    </body>
</html>