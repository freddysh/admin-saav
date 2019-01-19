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
        html {
            margin: 0;
        }
        body {
            font-family: "Times New Roman", serif;
            font-size: 08px;
            margin: 1rem 0.5rem 1rem 0.8rem;
        }
        .rojo{
            color: #dd060f;
        }
        .azul{
            color: #0063d1;
        }
        .text-08{
            font-size: 08px;
        }
        .text-09{
             font-size: 09px;
        }
        .text-10{
            font-size: 10px;
        }
        .text-12{
            font-size: 12px;
        }
        .footer {
            position: fixed;
            left: 0px;
            bottom: -25px;
            right: 0px;
            height: 55px;
            line-height:2px;
        }
        .footer span{
            color: #949494;
        }
        .footer .page:after {
            content: counter(page);
        }
        .footer table {
            width: 100%;
        }
        .venta_anulada{
            background-color: #f8d7da !important;
            border-color: #f5c6cb !important;
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