<?php

namespace App\Console\Commands;

use App\Models\HealthRecord;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use Illuminate\Support\Facades\DB;
class UpdateHealth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:health';

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
        $request = new Req('GET', 'https://www.test-api.naitsng.com/api/integration/health-table?page=1&limit=1000', $headers);
        $res = $client->sendAsync($request)->wait();
        $body = $res->getBody()->getContents();
        $data = json_decode($body, true);
        $items =  $data['data']['data'];
        foreach ($items as $item) {
            $check = HealthRecord::where('recordid', $item['record_id'])->first();
            if(!$check){
                DB::table('health_records')->insert([
                'recordid'=>$item['record_id'],
                 'animal_animalid'=>$item['animal_id'],
                 'event_date'=>$item['date'],
                 'type_event'=>$item['type_of_health'],
                 'details'=>$item['details'],
                 'created_at' => now(),
                 'updated_at' => now(),
                ]);

            }

        }

    }
}
