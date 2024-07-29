<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use App\Models\Breed;
use App\Models\Species;
use Illuminate\Support\Facades\DB;
class UpdateBreed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:breed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $client = new Client();
        $headers = [
          'Content-Type' => 'application/json',
          'Accept' => 'application/json',
          'client-id' => 'CLIENT_17212271759974Q9XG61BT3WQCR6S6WD4AWQZY4',
          'api-key' => 'y6brycnm2mso1mqlbbmc3cz4mjkf810jqem2661u'
        ];
        $request = new Req('GET', 'https://www.test-api.naitsng.com/api/integration/breed-table?page=1&limit=1000', $headers);
        $res = $client->sendAsync($request)->wait();
        $body = $res->getBody()->getContents();
        $data = json_decode($body, true);
        $items =  $data['data']['data'];
        foreach ($items as $item) {
            $check = Breed::where('breedid', $item['breed_id'])->first();
            if(!$check){
                DB::table('breeds')->insert([
                // 'species_speciesid'=>$item['species_id'],
                 'breedname'=>$item['breed_name'],
                 'breedid'=>$item['breed_id'],
                 'created_at' => now(),
                 'updated_at' => now(),
                ]);

            }

        }



    }
}
