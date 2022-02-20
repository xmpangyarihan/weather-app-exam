<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request){
        $city = $request->collect('city');
        
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city[0] . ', jp',
            'APPID' => '35677bf9bb8b09d6bba28417e067ea6f'
        ]);

        return response($response);
    }
}
