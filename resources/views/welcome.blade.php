<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="robots" content="noindex"/>

        <title>Nextbike History</title>

        <script src="{{ mix('js/app.js') }}"></script>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-light">

        <div class="container">
            <main>
                <div class="py-5 text-center">
                    <h2>Nextbike History</h2>
                    <p class="lead">Diese Seite steht in keinem Zusammenhang mit der nextbike GmbH.
                        Sie wird privat betrieben.</p>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="table-responsive col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fahrrad</th>
                                    <th>Letzte Aktualisierung</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bikes as $bike)
                                    <tr>
                                        <td>
                                            <a href="{{route('bike', ['id' => $bike->id])}}">
                                                Bike {{$bike->id}}
                                            </a>
                                        </td>
                                        <td>{{$bike->updated_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </main>

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
