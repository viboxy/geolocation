<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>

    <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDsyDj8ro_YD0tlRDxnHYhKrkg5LbBNqTg">
    </script>

    <script>
        var myCenter=new google.maps.LatLng(<?php echo $_GET['lat']?>,<?php echo $_GET['lng']?>);

        function initialize()
        {
            var mapProp = {
                center:myCenter,
                zoom:12,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

            var marker=new google.maps.Marker({
                position:myCenter,
            });

            marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
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

<table>
    <tr>
        <td
            <?php
            foreach ($results as $result){
                $ac = $result["address_components"];
                foreach ($ac as $acData){
                    echo "long name : ".$acData["long_name"]."<br>";
                    echo "short name : ".$acData["short_name"]."<br>";
                    $types = $acData["types"];
                    echo "type : ";
                    foreach ($types as $type){
                        echo $type;
                        if($type != end($types)) {
                            echo ", ";
                        }
                    }
                    echo "<br><br>";
                }
                echo "<br><br>";
            }
            ?>
        </td>

        <td>
            <div id="googleMap" style="width:800px;height:400px;"></div>
        </td>

    </tr>
</table>

</body>
</html>




