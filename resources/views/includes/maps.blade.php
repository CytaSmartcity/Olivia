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
                                    function initMap() {
                                        var uluru = {lat: -25.363, lng: 131.044};
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 4,
                                        center: uluru
                                        });
                                        var marker = new google.maps.Marker({
                                        position: uluru,
                                        map: map
                                        });
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