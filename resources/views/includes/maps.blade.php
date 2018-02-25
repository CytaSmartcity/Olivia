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

                                        var locations = [
                                            @foreach($fuel as $fuel_location)
                                                ["{{ $fuel_location->fuel_company_name.' '.$fuel_location->fuel_price.'€' }}",     {{ $fuel_location->latitude }} , {{ $fuel_location->longitude }}],
                                            @endforeach
                                            ];

                                        function initMap(){

                                            var infowindow = new google.maps.InfoWindow(); /* SINGLE */
                                            var map = new google.maps.Map(document.getElementById('map'), {
                                                zoom: 8,
                                                center: new google.maps.LatLng(35.1677652, 32.85651)
                                            });

                                            function placeMarker( loc ) {
                                                var latLng = new google.maps.LatLng( loc[1], loc[2]);
                                                var marker = new google.maps.Marker({
                                                    position : latLng,
                                                    map      : map
                                                });
                                                google.maps.event.addListener(marker, 'click', function(){
                                                    infowindow.close(); // Close previously opened infowindow
                                                    infowindow.setContent( "<div id='infowindow'>"+ loc[0] +"</div>");
                                                    infowindow.open(map, marker);
                                                });
                                            }

                                            // ITERATE ALL LOCATIONS
                                            // Don't create functions inside for loops
                                            // therefore refer to a previously created function
                                            // and pass your iterating location as argument value:
                                            for(var i=0; i<locations.length; i++) {
                                                placeMarker( locations[i] );
                                            }
                                        }
                                        google.maps.event.addDomListener(window, 'load', initMap);
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
