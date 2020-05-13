<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
</head>

<body>
    <h1 class="text-center">New movie created!</h1>
    <p class="text-center">Title: {{$movie->title}}</p>
    <p class="text-center">Description: {{$movie->description}}</p>
</body>

</html>