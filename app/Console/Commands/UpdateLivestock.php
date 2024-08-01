<?php

namespace App\Console\Commands;

use App\Models\Livestock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class UpdateLivestock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:livestock';

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
        // 'name',
        // 'sex',
        // 'age',
        // 'breed',
        // 'weight',
        // 'tag_id',
        // 'health_status',
        // 'farm_farmid'
        $livestocks = Livestock::all();

        foreach($livestocks as $livestock){

         DB::table('animal_livestocks')->insert([
                'name'=>$livestock->livestock_type,
                'sex'=>$livestock->gender,
                'age'=>1,
                'breed'=>$livestock->livestock_breed,
                'weight'=>$livestock->weight,
                'tag_id'=>$livestock->tag_id,
                'health_status'=>$livestock->health_status,
                'farm_farmid'=>$livestock->owner_id,
                'created_at'=>now(),
                'updated_at'=>now()
                ]);
        }


    }
}
