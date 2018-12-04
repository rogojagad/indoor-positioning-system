<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type = "text/javascript" src = "{{ url("js/jquery.min.js") }}"></script>
    <script src="{{ url("js/jsDraw2D.js") }}"></script>
    <title>Indoor Mapping</title>
</head>
<body>
    <!-- <canvas id="map" width="100px" height="100px" style="border:1px solid #000000;">
        Your browser does not support the HTML5 canvas tag.
    </canvas> -->

    <!-- <script>
        var c = document.getElementById("map");
        var ctx = c.getContext("2d");

        ctx.fillRect(45, 43, 10, 10);
    </script> -->

    <div id="canvas" style="overflow:hidden;position:relative;width:500px;height:500px;float:left"></div>

    <form action="/indoor-positioning/delete/coordinates" method="POST">
        <button type="submit">Reset</button>
    </form>
    <br>
    <form action="" method="POST">
        <p>Masukkan koordinat Access Point</p><br>
        <p>Koordinat Access Point 1</p>
        <label for="ap1x">x</label>
        <input type="text" id="ap1x">
        <label for="ap1y">y</label>
        <input type="text" id="ap1y">

        <p>Koordinat Access Point 2</p>
        <label for="ap2x">x</label>
        <input type="text" id="ap2x">
        <label for="ap2y">y</label>
        <input type="text" id="ap2y">

        <p>Koordinat Access Point 3</p>
        <label for="ap3x">x</label>
        <input type="text" id="ap3x">
        <label for="ap3y">y</label>
        <input type="text" id="ap3y">
        <br>
        <br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <div id="devices-data"></div>

    <p>This app running at : </p> {{ hostIP }}

    <script>
        var gr=new jsGraphics(document.getElementById("canvas"));
        var redPen=new jsPen(new jsColor("red"),3);
        var greenPen=new jsPen(new jsColor("green"),3);
        var bluePen=new jsPen(new jsColor("blue"),3);

        var pens = [redPen, greenPen, bluePen];

        var flag = false;

        var objects = [];

        var colorToDevice = {};

        gr.setCoordinateSystem("default");
        gr.showGrid(50, false);
    
        setInterval( function(){ refreshPosition(); }, 2000);
        
        function refreshPosition() {
            $.getJSON('/indoor-positioning/coordinates', function(jd) {
                redrawPosition(jd);
                showDevicesData();
            });        
        };

        function showDevicesData() {
            $('#devices-data').empty();

            for (var i in colorToDevice)
            {
                $('#devices-data').append(
                    '<p id="'+ colorToDevice[i].name +'">'+ colorToDevice[i].name +'</p>'
                );

                $('#' + colorToDevice[i].name).attr("style", "color: rgb("+ i +")");
            }
        };

        function redrawPosition(jd) {
            var devicesCount = Object.keys(jd.devices_coords).length;
            
            if (flag == true)
            {
                if( devicesCount > 0 )
                {
                    for( var i = 0; i < devicesCount; i++)
                    {
                        objects[i].remove();
                    }

                    objects.length = [];
                }
            }
            
            for (var i = 0; i < devicesCount; i++)
            {
                var obj = gr.drawCircle(pens[i], new jsPoint(jd.devices_coords[i].x, jd.devices_coords[i].y), 10);

                colorToDevice[pens[i].color.getRGB()] = jd.devices_coords[i];

                objects.push(obj);
            }
            
            flag = true;
        }
    </script>
</body>
</html>