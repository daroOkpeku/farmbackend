<?php
namespace App\Http\Controllers;

use App\Http\Requests\Animaldetailsrequest;
use App\Http\Requests\Animallocationrequest;
use App\Http\Requests\Breedrequest;
use App\Http\Requests\Farminforequest;
use App\Http\Requests\Feedingschedulerequest;
use App\Http\Requests\Feedrequest;
use App\Http\Requests\Financialrecordrequest;
use App\Http\Requests\Healthrecordrequest;
use App\Http\Requests\Productionrequest;
use App\Http\Requests\Reproductionrequest;
use App\Http\Requests\Speciesrequest;
use Illuminate\Http\Request;
use App\Http\Repository\Contracts\TestInterface;
use App\Http\Repository\Contracts\FarmInterface;
use App\Http\Requests\Deleterequest;
use App\Http\Requests\FeedCreateRequest;
use App\Http\Requests\FinanceRecordrequest;
use App\Http\Requests\HealthRecordCreateRequest;
use App\Http\Requests\Photorequest;
use App\Http\Requests\ProductionCreateRequest;

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

     public function farminfo(Farminforequest $request){
       return $this->farminterface->farminfo($request);


     }


     public function animaldetails(Animaldetailsrequest $request){
       return $this->farminterface->animaldetails($request);
     }

     public function editanimaldetails(Animaldetailsrequest $request){
      return $this->farminterface->editanimaldetails($request);
     }


     public function species(Speciesrequest $request){
        return $this->farminterface->species($request);
     }

     public function breed(Breedrequest $request){
       return $this->farminterface->breed($request);
     }

     public function healthrecord(Healthrecordrequest $request){
       return $this->farminterface->healthrecord($request);
     }

      public function reproduction(Reproductionrequest $request){
       return $this->farminterface->reproduction($request);
      }

      public function production(Productionrequest $request){
         return $this->farminterface->production($request);
      }

      public function feed(Feedrequest $request){
        return $this->farminterface->feed($request);
      }

      public function feedingschedule(Feedingschedulerequest $request){
        return $this->farminterface->feedingschedule($request);
      }

      public function financialrecord(Financialrecordrequest $request){
        return $this->farminterface->financialrecord($request);
      }

      public function animallocation(Animallocationrequest $request){
        return $this->farminterface->animallocation($request);
      }

      public function genealogy(Request $request){
       return $this->farminterface->genealogy($request);
      }

      public function deleteAnimal(Deleterequest $request){
        return $this->testinterface->deleteAnimal($request);
      }

      public function photo(Photorequest $request){
        return $this->farminterface->photo($request);
      }

      public function feedcreate(FeedCreateRequest $request){
        return $this->farminterface->feedcreate($request);
      }

      public function feededit(FeedCreateRequest $request){
        return $this->farminterface->feededit($request);
      }

      public function healthrecord_create(HealthRecordCreateRequest $request){
        return $this->testinterface->healthcreate($request);
      }

      public function healthedit(HealthRecordCreateRequest $request){
        return $this->testinterface->healthedit($request);
      }

      public function productioncreate(ProductionCreateRequest $request){
        return $this->testinterface->productioncreate($request);
      }

      public function productionedit(ProductionCreateRequest $request){
        return $this->testinterface->productionedit($request);
      }

      public function financerecordcreate(FinanceRecordrequest $request){
        return $this->testinterface->financerecordcreate($request);
      }

      public function financerecordedit(FinanceRecordrequest $request){
        return $this->testinterface->financerecordedit($request);
      }


}



