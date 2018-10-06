<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>PDF - Version</title>
        <!-- CSS  -->
        <link href="{{asset('css/quotes-pdf.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <style>
        .alert{
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-danger{
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
<body>
<div class="footer text-center text-12">
    <p class="page">Páge </p>
    <p>GotoPeru.com</p>
    <p class="text-10 margin-top-20"><span>Go to Peru once in your lifetime !</span></p>
</div>
@yield('content')
</body>
</html>