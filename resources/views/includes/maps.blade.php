@include('includes.header')

<body class="">
    <div class="wrapper ">
    <div class="sidebar" data-color="orange">
            <div class="logo">
                <a href="https://www.facebook.com/Olivia-221586811741271/" class="simple-text logo-normal">
                    Olivia
                </a>
            </div>
            @include('includes.sidebar')
        </div>
        <div class="main-panel">
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header ">
                                Petrol Stations
                            </div>
                            <div class="card-body ">
                                <div id="map" class="map">
                                <script>
                                    var map;
                                    function initMap() {
                                        map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 2,
                                        center: new google.maps.LatLng(2.8,-187.3),
                                        mapTypeId: 'terrain'
                                        });

                                        // Create a <script> tag and set the USGS URL as the source.
                                        var script = document.createElement('script');
                                        // This example uses a local copy of the GeoJSON stored at
                                        // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
                                        script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
                                        document.getElementsByTagName('head')[0].appendChild(script);
                                    }

                                    // Loop through the results array and place a marker for each
                                    // set of coordinates.
                                    window.eqfeed_callback = function(results) {
                                        for (var i = 0; i < results.features.length; i++) {
                                        var coords = results.features[i].geometry.coordinates;
                                        var latLng = new google.maps.LatLng(coords[1],coords[0]);
                                        var contentString = '<div id="content">'+
                                        '<div id="siteNotice">'+
                                        '</div>'+
                                        '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
                                        '<div id="bodyContent">'+
                                        '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
                                        'sandstone rock formation in the southern part of the '+
                                        'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
                                        'south west of the nearest large town, Alice Springs; 450&#160;km '+
                                        '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
                                        'features of the Uluru - Kata Tjuta National Park. Uluru is '+
                                        'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
                                        'Aboriginal people of the area. It has many springs, waterholes, '+
                                        'rock caves and ancient paintings. Uluru is listed as a World '+
                                        'Heritage Site.</p>'+
                                        '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
                                        'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
                                        '(last visited June 22, 2009).</p>'+
                                        '</div>'+
                                        '</div>';

                                         var infowindow = new google.maps.InfoWindow({
                                            content: contentString
                                        });
                                        var marker = new google.maps.Marker({
                                            position: latLng,
                                            map: map,
                                            title: 'Uluru (Ayers Rock)'
                                        });
                                        marker.addListener('click', function() {
                                            infowindow.open(map, marker);
                                        });
                                        }
                                    }
                                </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
@include('includes.footer')