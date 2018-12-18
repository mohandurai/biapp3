  <!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <title>KML Layers</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0iw9ZnZxsfUZIx3ooFih29F5dDrEhDuE&callback=initMap">
    </script>
    <script src="togeojson.js"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
          var file="1---21---21.kml"
    
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: 41.876, lng: -87.624}
        });
        
           $.ajax(file).done(function(xml)
            {

              conversion = toGeoJSON.kml(xml);
              layer=map.data.addGeoJson(conversion);
              
              
            });
         }
      
      
    </script>
   
  </body>
</html>
 