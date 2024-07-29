<?php

namespace App\Console\Commands;

use App\Models\Farm;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use Illuminate\Support\Facades\DB;
class UpdateFarm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:farm';

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
        $request = new Req('GET', 'https://www.test-api.naitsng.com/api/integration/farm-table?page=1&limit=500', $headers);
        $res = $client->sendAsync($request)->wait();
        $body = $res->getBody()->getContents();
        $data = json_decode($body, true);
        $items =  $data['data']['data'];
        foreach ($items as $item) {
        
            $check = Farm::where('farmid', $item['farm_id'])->first();
            if(!$check){
                  $owner = $item['owner'] == null?"nothing":$item['owner'];
                  $farm_type = $item['farm_type'] == null?'nothing':$item['farm_type'];
                  $location = $item['location'] == null? 'no location':$item['location'];
                DB::table('farms')->insert([
                'farmid'=>$item['farm_id'],
                //  'animalid'=>$item['animal_id'],
                'farmname'=>$item['farm_name'],
                //  'event_date'=>$item['date'],
                 'farmtype'=>$farm_type,
                 'location'=>$location,
                 'owner'=>$owner,
                 'size'=>'Nothing',
                 'contact_details'=>$item['contact_details'],
                 'created_at' => now(),
                 'updated_at' => now(),
                ]);

            }

        }
    }
}
