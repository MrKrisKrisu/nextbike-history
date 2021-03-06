<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\Bike;
use App\Models\BikeState;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class NextBikeController extends Controller {

    /**
     * @throws GuzzleException
     */
    public static function fetchBikes(): void {
        $client = new Client();
        $data   = $client->get('https://maps.nextbike.net/maps/nextbike-live.json?city=87&domains=dh', [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36',
            ]
        ]);

        $json = json_decode($data->getBody());
        foreach($json->countries[0]->cities[0]->places as $place) {
            $latitude  = $place->lat;
            $longitude = $place->lng;
            foreach($place->bike_list as $bikeData) {
                $bike = Bike::updateOrCreate(
                    ['id' => $bikeData->number],
                    ['updated_at' => Carbon::now()->toIso8601String()]
                );
                BikeState::create([
                                      'bike_id'   => $bike->id,
                                      'latitude'  => $latitude,
                                      'longitude' => $longitude,
                                      'active'    => $bikeData->active,
                                      'state'     => $bikeData->state,
                                  ]);
                echo "* Bike " . $bike->id . " fetched. ($latitude / $longitude)" . PHP_EOL;
            }
        }
    }

    public function renderMainPage(): View {
        return view('welcome', [
            'bikes' => Bike::orderByDesc('updated_at')->orderBy('id')->get()
        ]);
    }

    public function renderBike(int $id): View {
        $bike = Bike::findOrFail($id);

        $locations = $bike->states()
                          ->groupBy(['latitude', 'longitude'])
                          ->select(['latitude', 'longitude', DB::raw('MAX(created_at) AS created_at')])
                          ->orderBy(DB::raw('MAX(created_at)'))
                          ->get();

        return view('bike', [
            'bike'      => $bike,
            'locations' => $locations,
        ]);
    }
}
