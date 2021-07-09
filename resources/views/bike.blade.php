<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="robots" content="noindex"/>

        <title>Fahrrad {{$bike->id}} | Nextbike History</title>

        <script src="{{ mix('js/app.js') }}"></script>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-light">

        <div class="container">
            <main>
                <div class="py-5 text-center">
                    <h2>Fahrrad {{$bike->id}} | Nextbike History</h2>
                    <p class="lead">Diese Seite steht in keinem Zusammenhang mit der nextbike GmbH.
                        Sie wird privat betrieben.</p>
                    <a href="/" class="btn btn-primary">Zurück zur Übersicht</a>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div id="map" style="height: 500px;"></div>
                    <div class="col-md-3"></div>
                </div>
            </main>

            <script>
                $(document).ready(loadMap);

                function loadMap() {
                    let map = L.map('map').setView([52.374457, 9.738619], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    @foreach($locations as $location)
                    L.marker([{{$location->latitude}}, {{$location->longitude}}]).addTo(map)
                        .bindPopup('{{$location->created_at->diffForHumans()}}');
                    @endforeach

                    let latlngs = [
                            @foreach($locations as $location)
                        [{{$location->latitude}}, {{$location->longitude}}],
                        @endforeach
                    ];

                    let polyline = L.polyline(latlngs, {color: '#257eca'}).addTo(map);
                    map.fitBounds(polyline.getBounds());
                }
            </script>

            <footer class="my-5 pt-5 text-muted text-center text-small">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://github.com/MrKrisKrisu/nextbike-history">Source
                            Code</a></li>
                    <li class="list-inline-item"><a href="https://k118.de/imprint">Legal</a></li>
                </ul>
            </footer>
        </div>
    </body>
</html>
