<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php

function distance($pincode1,$pincode2)
{
	$url1 = "http://maps.googleapis.com/maps/api/geocode/json?address=".$pincode1.",India&sensor=false";
	$details1=file_get_contents($url1);
    $result1 = json_decode($details1,true);

    $lat1=$result1['results'][0]['geometry']['location']['lat'];
    $lon1=$result1['results'][0]['geometry']['location']['lng'];
	
//	echo "pin:".$pincode1." Lat:".$lat1." Lon:".$lon1."<br />";
	
	$url2 = "http://maps.googleapis.com/maps/api/geocode/json?address=".$pincode2.",India&sensor=false";
	$details2=file_get_contents($url2);
    $result2 = json_decode($details2,true);

    $lat2=$result2['results'][0]['geometry']['location']['lat'];
    $lon2=$result2['results'][0]['geometry']['location']['lng'];
	
//	echo "pin:".$pincode2." Lat:".$lat2." Lon:".$lon2."<br />";
	$distanceKM=distance_latlon($lat1,$lon1,$lat2,$lon2);
	return $distanceKM;
}

function distance_latlon($lat1, $lon1, $lat2, $lon2) {

  $unit="K";
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
?>

</body>
</html>