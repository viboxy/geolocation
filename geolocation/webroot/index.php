<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script
        src="http://maps.googleapis.com/maps/api/js">
    </script>

    <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDsyDj8ro_YD0tlRDxnHYhKrkg5LbBNqTg">
    </script>

    <!-- select location -->
    <script>
        var map;
        var myCenter=new google.maps.LatLng(51.508742,-0.120850);

        function initialize()
        {
            var mapProp = {
                center:myCenter,
                zoom:5,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("googleMap1"),mapProp);

            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });
        }

        function placeMarker(location) {/*
            var marker = new google.maps.Marker({
                position: location,
                map: map,
            });*/
            /*var infowindow = new google.maps.InfoWindow({
                content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
            });
            infowindow.open(map,marker);*/
            document.getElementById("lat").value = location.lat();
            document.getElementById("lng").value = location.lng();

        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <!-- view the result map -->
    <script>
        var myCenter=new google.maps.LatLng(<?php echo $_GET['lat']?>,<?php echo $_GET['lng']?>);

        function initialize()
        {
            var mapProp = {
                center:myCenter,
                zoom:12,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map=new google.maps.Map(document.getElementById("googleMap2"),mapProp);

            var marker=new google.maps.Marker({
                position:myCenter,
            });

            marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <style type="">
        .local{
            margin-top: 5px;
        }
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Hemantha
 * Date: 02/09/2016
 * Time: 10:59
 */

$payload = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$_GET['lat'].','.$_GET['lng'].'&key=AIzaSyDsyDj8ro_YD0tlRDxnHYhKrkg5LbBNqTg');
$obj = json_decode($payload, true);
$data = $obj["results"][0]["address_components"];
$results = $obj["results"];
?>

<div class="container-fluid">
    <div class="row">
        <div class="text-center">
            <h1>Geo Location</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Select A Location</div>
                <div class="panel-body">
                    <div id="googleMap1" style="width:auto;height:400px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">View The Result</div>
                <div class="panel-body">
                    <div id="googleMap2" style="width:auto;height:400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary local">
                <div class="panel-heading">Enter Latitude and Longitude</div>
                <div class="panel-body">
                    <form action="#" method="get" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 label-control" for="lat">Latitude :</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" id="lat" name="lat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 label-control" for="lng">Longitude :</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" id="lng" name="lng">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">Result</div>
                <div class="panel-body">
                    <label class="label-control">Latitude : <?php echo $_GET['lat'] ?></label><br>
                    <label class="label-control">Latitude : <?php echo $_GET['lng'] ?></label>
                    <table class="table table-bordered">
                        <tr>
                            <th>Type</th>
                            <th>Long Name</th>
                            <th>Short Name</th>
                        </tr>
                        <?php foreach ($results[0]["address_components"] as $result){ ?>
                            <tr>
                                <td><?php echo $result["types"][0] ?></td>
                                <td><?php echo $result["long_name"] ?></td>
                                <td><?php echo $result["short_name"] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

