<?php

use App\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the database table.
        // ------------------------------------------------------------------------------------
        $table = DB::table('countries');
        $table->delete();

        // The api call for data.
        // -------------------------------------------------------------------------------------
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => 'https://restcountries.eu/rest/v1/all',
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if(! $response) { // If an error occur just log them.
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }

        // Insert the data to the database.
        // ---------------------------------------------------------------------------------------
        foreach (json_decode($response) as $country) {
            // Country insert
            Country::create([
                'name'       => $country->name,
                'capital'    => $country->capital,
                'alpha2code' => $country->alpha2Code,
                'alpha3code' => $country->alpha3Code
            ]);
        }

    }
}
