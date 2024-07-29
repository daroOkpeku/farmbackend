<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;
class UpdateAnimal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:animal';

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
    $request = new Req('GET', 'https://www.test-api.naitsng.com/api/integration/animal-table?page=1&limit=500', $headers);
    $res = $client->sendAsync($request)->wait();
    $body = $res->getBody()->getContents();
    $data = json_decode($body, true);
    $items =  $data['data']['data'];
    foreach ($items as $item) {
        $check = Animal::where('animalid', $item['animal_id'])->first();
        if(!$check){
            DB::table('animals')->insert([
            'animalid'=>$item['animal_id'],
            // 'species_speciesid'=>$item['species_id'],
            'breed_breedid'=> $item['breed_id'],
            'tagnumber'=>$item['tag_number'],
            'sex'=>$item['sex'],
            'date_of_birth'=>$item['date_of_birth'],
            'acquisition_date'=>$item['acquisition_date'],
            'created_at' => now(),
            'updated_at' => now(),
            ]);

        }

    }

    }
}
