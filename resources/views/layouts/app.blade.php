<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <title>Equation</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    	<style>
    		body {
    			font-family: 'Montserrat', sans-serif;
    		}
    		/* Pagination styles */
    		.pagination {
                margin: 0 auto;
            }

            .pagination .page-item .page-link {
                color: #343a40;
                background-color: #ffffff;
                border-color: #ced4da;
            }
            .pagination .page-item.active .page-link {
                color: #ffffff;
                background-color: #343a40;
                border-color: #343a40;
            }
            .pagination .page-item .page-link:hover {
                color: #ffffff;
                background-color: #1f2326;
                border-color: #1f2326;
            }
    	</style>
    </head>
    <body>
        @php
            use Illuminate\Support\Facades\Auth;
        @endphp
            @include('includes.navbar')

                @yield('content')

            @include('includes.footer')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
