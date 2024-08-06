<?php


namespace App\Http\Repository\Contracts;


interface FarmInterface{
    public function farminfo($request);
    public function animaldetails($request);
    public function species($request);
    public function breed($request);
    public function healthrecord($request);
    public function reproduction($request);
    public function production($request);
    public function feed($request);
    public function feedingschedule($request);
    public function financialrecord($request);
    public function animallocation($request);
    public function genealogy($request);
    public function editanimaldetails($request);
    public function photo($request);
    public function feedcreate($request);
    public function feededit($request);
    public function documentupload($request);
}
