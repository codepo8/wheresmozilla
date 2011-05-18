<?php
$url='https://spreadsheets.google.com/pub?key=0AhphLklK1Ve4dGo5UGpIcG80Rm5wZ1BiTXNTQ2RWaUE&output=csv';

    if (($handle = fopen($url, "r")) !== FALSE) {
        # Set the parent multidimensional array key to 0.
        $nn = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            # Count the total keys in the row.
            $c = count($data);
            # Populate the multidimensional array.
            for ($x=0;$x<$c;$x++)
            {
                $csvarray[$nn][$x] = $data[$x];
            }
            $nn++;
        }
        # Close the File.
        fclose($handle);
    }
    # Print the contents of the multidimensional array.
    //print_r($csvarray);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Where's Mozilla?</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="style.css?v=2">
  <!--[if lt IE 9]>
  <script src="html5shiv.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.2r1/build/fonts/fonts-min.css" />
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.2r1/build/calendar/assets/skins/sam/calendar.css" />
  <style type="text/css">
    *{margin:0;padding:0;font-size:14px;}
    body{font-family:arial,sans-serif;padding:2em;background:#ccc;}
    h2{margin:1em 0;}
    table{width:100%;}
    th,td{padding:5px;vertical-align:top;border-collapse:collapse;}
    th{background:#369;color:#fff;vertical-align:top;
      -moz-border-radius:2px;
      -webkit-border-radius:2px;
      border-radius:2px;
    }
    #map_canvas li{list-style:none;padding-bottom:5px;}
    #map_canvas a{display:block;font-weight:bold;color:#036;padding:5px 0;}
    tr.odd{background:#ccc;}
    tr:hover{background:#ddd;}
    tr.odd:hover{background:#aaa;}
    td a{color:#369;font-weight:bold;}
    td a:hover{text-decoration:none;}
    #map_canvas{height:400px;width:100%}
    #canvas{position:relative;width:800px;padding:10px;margin:20px auto;
      -moz-box-shadow:0px 0px 10px rgba(0,0,0,.6);
      -webkit-box-shadow:0px 0px 10px rgba(0,0,0,.6);
      box-shadow:0px 0px 10px rgba(0,0,0,.6);
      -moz-border-radius:10px;
      -webkit-border-radius:10px;
      border-radius:10px;
      background:#fff;
    }
    #cal1Container{position:absolute;top:120px;left:15px;
      -moz-box-shadow:4px 4px 10px rgba(0,0,0,.6);
      background:#369;
    }
    table,#map_canvas{margin-bottom:20px;
    }
    h1,.intro{font-size:30px;width:800px;margin:0 auto;color:#666;text-transform:uppercase;}
    .intro{text-transform:none;font-size:16px;padding:10px;}
    .intro a{color:#000;font-size:16px;}
    h2{font-size:18px;color:#333;text-transform:uppercase;margin:10px 5px;}
    .today{background:#fc6;}
  </style>
  
</head>
<body class="yui-skin-sam">
  <h1>Where's Mozilla?</h1>
<p class="intro">Here you can see where Mozilla will be in the nearer future and what we are going to talk about. If you organise an event and you want a Mozillian to come around, please <a href="https://spreadsheets.google.com/viewform?formkey=dGo5UGpIcG80Rm5wZ1BiTXNTQ2RWaUE6MQ&theme=0AX42CRMsmRFbUy04ZWQwMDYwMS02YjZhLTQ2ZjMtYjcyNy0zYWNlMzlmYTAxNmY&ifq">send us the information via this form</a>. If you are a Mozillian, and speaking at an event that's not listed here, let us know!</p>
<div id="canvas"><div id="map_canvas"></div>
<div id="cal1Container"></div>

<h2>Upcoming conferences</h2>
<table id="upcoming" summary="upcoming conferences with Mozilla speakers">
  <colgroup>
    <col width="20%">
    <col width="15%">
    <col width="10%">
    <col width="15%">
    <col width="40%">
  </colgrouo>
  <thead>
    <th scope="col">Date</th>
    <th scope="col">Conference</th>
    <th scope="col">Location</th>
    <th scope="col">People present</th>
    <th scope="col">Description</th>
  </thead>
  <tbody>
<?php
foreach($csvarray as $k=>$row){
  if($k==0){continue;}
  $r = $row;
  if($r[7]=='no'){
    echo '<tr';
    if($k%2!=0){
      echo ' class="odd"';
    }
    echo '><td>'.$r[4].'</td><td>';
    if($r[3]!=''){
      echo '<a href="'.$r[3].'">';
    }
    echo $r[1];
    if($r[3]!=''){
      echo '</a>';
    }
    echo '</td><td>'.$r[2].'</td><td>'.$r[5].'</td><td>'.$r[6].'</td></tr>';
  }
}
?>
</tbody></table>

<h2>Past conferences</h2>
<table>
  <colgroup>
    <col width="20%">
    <col width="15%">
    <col width="10%">
    <col width="15%">
    <col width="30%">
    <col width="10%">
  </colgrouo>
  <thead>
    <th scope="col">Date</th>
    <th scope="col">Conference</th>
    <th scope="col">Location</th>
    <th scope="col">People present</th>
    <th scope="col">Description</th>
    <th scope="col">Presentation Materials</th>
  </thead>
  <tbody>
<?php
foreach($csvarray as $k=>$row){
  if($k==0){continue;}
  $r = $row;
  if($r[7]=='yes'){
    echo '<tr';
    if($k%2!=0){
      echo ' class="odd"';
    }
    echo '><td>'.$r[4].'</td><td>';
    if($r[3]!=''){
      echo '<a href="'.$r[3].'">';
    }
    echo $r[1];
    if($r[3]!=''){echo '</a>';}
    echo '</td><td>'.$r[2].'</td><td>'.$r[5].'</td><td>'.$r[6].'</td><td>';
    if($r[8]!='n/a'){
      echo '<a href="'.$r[8].'">Presentation info</a>';
    }
    echo '</td></tr>';
  }
}
?>
</tbody></table>
</div>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAijZqBZcz-rowoXZC1tt9iRT5rHVQFKUGOHoyfP_4KyrflbHKcRTt9kQJVST5oKMRj8vKTQS2b7oNjQ" type="text/javascript"></script>
<script src="http://mapstraction.com/mapstraction-js/mapstraction.js"></script>
<script src="geocode.js"></script>
<script>
var mapstraction;
var geocoder;
var address;
var locs = [];
var dates = [];
function initialize() {
  mapstraction = new Mapstraction('map_canvas','google');
  mapstraction.setCenterAndZoom(new LatLonPoint(50,0), 3);
  geocoder = new MapstractionGeocoder(geocode_return, 'google');
  mapstraction.addControls({pan:true,zoom:'small',map_type:true});
  var x = document.getElementById('upcoming');
  var rows = x.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
  for(var i=0;i<rows.length;i++){
    var loc = rows[i].getElementsByTagName('td')[2];
    dates.push(rows[i].getElementsByTagName('td')[0].innerHTML);
    var o = rows[i].innerHTML;
    geocoder.geocode({address:loc.innerHTML},o);
  }
}

function geocode_return(geocoded_location,o) {
  var marker = new Marker(geocoded_location.point);
  marker.setInfoBubble('<ul>'+o.replace(/td>/g,'li>')+'</ul>');
  mapstraction.addMarker(marker);
}

window.addEventListener('load',function(event){
  initialize();
},false);
</script>

</body></html>