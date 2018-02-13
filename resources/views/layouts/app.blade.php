<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{ Html::style('/css/style.css') }}
    <meta id="_token" value="{{ csrf_token() }}">



</head>
<body id="app-layout" style="direction:rtl; text-align: right;">



@yield('content')

{{ Html::script('/js/main.js') }}
{{ Html::script('/js/app.js') }}



</body>
</html>
