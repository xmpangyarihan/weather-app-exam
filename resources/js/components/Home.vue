<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card text-white bg-secondary">
                    <div class="card-header"><h3>Japan Travel Information</h3></div>
                    <div class="card-body">
                        <label for="cities" class="form-label">Select a city</label>
                        <select class="form-select" id="cities" @change="getWeather()">
                            <option selected disabled>--</option>
                            <option>Tokyo</option>
                            <option>Yokohama</option>
                            <option>Kyoto</option>
                            <option>Osaka</option>
                            <option>Sapporo</option>
                            <option>Nagoya</option>
                        </select>
                    </div>
                </div>
                <br />
                <div class="card text-white" id="weatherInfo">
                    <div class="card-body card-body-2">
                        <h4 class="card-title">Weather Information</h4>
                        <p class="card-text">Main weather: {{ weatherMain }}</p>
                        <p class="card-text">Weather Description: {{ weatherDescription }}</p>
                        <p class="card-text">Temperature: {{ mainTempKelvin }}{{ mainTempCelsius}}{{ mainTempFahrenheit }}</p>
                    </div>
                </div>
                <br />
                <div class="card text-white" id="placeInfo">
                    <div class="card-body card-body-2">
                        <h4 class="card-title">Place Information</h4>
                        <p>Latitude: {{ latitude }}</p>
                        <p>Longitude: {{ longitude }}</p>
                        <p>Showing {{ numberOfNearbyPlaces }} nearby places...</p>
                        <table class="table" style="color: white;">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Name of place</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="place in places">
                                    <td>{{ place.categories[0].name }}</td>
                                    <td>{{ place.name }}</td>
                                    <td>{{ place.location.formatted_address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'; 

    export default {
        data(){
            return{
                weatherMain: '',
                weatherDescription: '',
                mainTempKelvin: '',
                mainTempCelsius: '',
                mainTempFahrenheit: '',
                latitude: 0,
                longitude: 0,
                numberOfNearbyPlaces: 0,
                places: [],
                place: '',
            }
        },

        methods: {
            getWeather(){
                let inputCity = document.getElementById("cities").value;

                axios.get('api/weather', {
                    params: {
                        city: inputCity
                    }
                })
                .then((response) => {
                    this.weatherMain = response.data.weather[0].main;
                    this.weatherDescription = response.data.weather[0].description;
                    this.mainTempKelvin = response.data.main.temp + 'K, ';
                    this.mainTempCelsius = ((response.data.main.temp - 273.15).toFixed(2)) + '℃, ';
                    this.mainTempFahrenheit = (((response.data.main.temp - 273.15) * 9/5 + 32).toFixed(2)) + '℉';
                    this.latitude = response.data.coord.lat;
                    this.longitude = response.data.coord.lon;

                    this.getVenue();
                })
                .catch(error => console.log(error));
            },

            getVenue(){
                axios.get('api/venues', {
                    params: {
                        ll: this.latitude + ',' + this.longitude
                    }
                })
                .then((response) => {
                    this.numberOfNearbyPlaces = (response.data.results).length;
                    this.places = response.data.results;
                })
                .catch(error => console.log(error));
            }
        }
    }
</script>
