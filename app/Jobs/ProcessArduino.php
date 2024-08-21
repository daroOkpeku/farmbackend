<?php

namespace App\Jobs;

use App\Models\Arduinodata;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessArduino implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public  $voltage;
  public  $current;
  public  $frequency;
  public  $power;
  public  $energy;
  public  $runtime;
  public  $temperature;
  public  $oil_level;
  public  $oil_quality;
  public  $fuel_level;
  public  $rpm;
  public $gyration;
  public  $health_status;
  public  $id;
    /**
     * Create a new job instance.
     */
    public function __construct(
        $voltage,
        $current,
        $frequency,
        $power,
        $energy,
        $runtime,
        $temperature,
        $oil_level,
        $oil_quality,
        $fuel_level,
        $rpm,
        $gyration,
        $health_status,
        $id
        )
    {
        $this->voltage = $voltage;
        $this->current = $current;
        $this->frequency = $frequency;
        $this->power = $power;
        $this->energy = $energy;
        $this->runtime = $runtime;
        $this->temperature = $temperature;
        $this->oil_level = $oil_level;
        $this->oil_quality = $oil_quality;
        $this->fuel_level = $fuel_level;
        $this->rpm = $rpm;
        $this->gyration = $gyration;
        $this->health_status = $health_status;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Arduinodata::create([
            'voltage'=>$this->voltage,
            'current'=>$this->current,
            'frequency'=>$this->frequency,
            'power'=>$this->power,
            'energy'=>$this->energy,
            'runtime'=>$this->runtime,
            'temperature'=>$this->temperature,
            'oil_level'=>$this->oil_level,
            'oil_quality'=>$this->oil_quality,
            'fuel_level'=>$this->fuel_level,
            'rpm'=>$this->rpm,
            'gyration'=>$this->gyration,
            'health_status'=>$this->health_status,
            'arduinodatas_id'=>$this->id
        ]);
    }
}
