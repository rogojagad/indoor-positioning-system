<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
    <title>Indoor Mapping</title>
</head>
<body>
    <canvas id="map" width="600px" height="600px" style="border:1px solid #000000;">
        Your browser does not support the HTML5 canvas tag.
    </canvas>

    <script>
        var c = document.getElementById("map");
        var ctx = c.getContext("2d");

        ctx.moveTo(0, 0);
        ctx.lineTo(500, 500);
        ctx.stroke(); 
    </script>
</body>
</html>