<?php
namespace App\Http\Controllers;

use App\Http\Requests\animaldetailsreq;
use App\Http\Requests\animallocationreq;
use App\Http\Requests\breedreq;
use App\Http\Requests\farminforeq;
use App\Http\Requests\feedingschedulereq;
use App\Http\Requests\feedreq;
use App\Http\Requests\financialrecordreq;
use App\Http\Requests\healthrecordreq;
use App\Http\Requests\productionreq;
use App\Http\Requests\reproductionreq;
use App\Http\Requests\speciesreq;
use App\Models\Animal;
use App\Models\AnimalLocation;
use App\Models\Breed;
use App\Models\Farm;
use App\Models\Farmdetails;
use App\Models\Feed;
use App\Models\FeedingSchedule;
use App\Models\FinancialRecord;
use App\Models\genealogy;
use App\Models\HealthRecord;
use App\Models\Production;
use App\Models\Reproduction;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\Contracts\TestInterface;
use App\Http\Repository\Contracts\FarmInterface;
class PostController extends Controller
{
     protected $testinterface;
     protected $farminterface;
    public function __construct(TestInterface $testinterface, FarmInterface $farmInterface)
    {
        $this->testinterface = $testinterface;
        $this->farminterface = $farmInterface;
    }


    public function showtest(Request $request){
     $this->testinterface->info($request);
    }

     public function farminfo(farminforeq $request){
       return $this->farminterface->farminfo($request);


     }


     public function animaldetails(animaldetailsreq $request){
       return $this->farminterface->animaldetails($request);


     }


     public function species(speciesreq $request){
        return $this->farminterface->species($request);
     }

     public function breed(breedreq $request){
       return $this->farminterface->breed($request);
     }

     public function healthrecord(healthrecordreq $request){
       return $this->farminterface->healthrecord($request);
     }

      public function reproduction(reproductionreq $request){
       return $this->farminterface->reproduction($request);
      }

      public function production(productionreq $request){
         return $this->farminterface->production($request);
      }

      public function feed(feedreq $request){
        return $this->farminterface->feed($request);
      }

      public function feedingschedule(feedingschedulereq $request){
        return $this->farminterface->feedingschedule($request);
      }

      public function financialrecord(financialrecordreq $request){
        return $this->farminterface->financialrecord($request);
      }

      public function animallocation(animallocationreq $request){
        return $this->farminterface->animallocation($request);
      }

      public function genealogy(Request $request){
       return $this->farminterface->genealogy($request);
      }
}



