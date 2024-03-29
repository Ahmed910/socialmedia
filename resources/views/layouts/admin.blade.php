<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>There are laravel views</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
         integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
          <link href="https://fonts.googleapis.com/css?family=Arizonia&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">       
    </head>
    <body>
        @include('partials.admin-header')
        <div class="container">
           @yield('content')
        </div>
        
    </body>
</html>