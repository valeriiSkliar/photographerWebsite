<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$exception->getStatusCode()}} Server Error</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset("AdminLTE/plugins/fontawesome_6_4_2/css/all.min.css")}}" />

    @vite('resources/scss/errors/style.scss')

    <meta name="robots" content="noindex, follow">
<body class="dark">
<div id="notfound">
    <div class="notfound">
        <div class="notfound-bg">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h1>oops!</h1>
        <h2>Error {{$exception->getStatusCode()}}</h2>
        <h3>It's always time for a coffee break.</h3>
        <p>We should be back by the time you finish your coffee.</p>
        <a href="javascript:history.go(-1)">go back</a>
    </div>
</div>
</body>
</html>
