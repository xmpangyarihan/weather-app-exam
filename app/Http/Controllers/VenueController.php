<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class VenueController extends Controller
{
    public function getVenues(Request $request){
        $ll = $request->collect("ll");

        $response = Http::withHeaders([
            'Authorization' => 'fsq34ul209bbPSwtkKx13HC9BUBJxCaFTuPNdTMrB6ivJ7U='
        ])->get('http://api.foursquare.com/v3/places/nearby', [
            'll' => $ll[0],
            'limit' => 20
        ]);

        return response($response);
    }
}
