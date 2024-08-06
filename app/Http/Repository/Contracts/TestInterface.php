<?php

namespace App\Http\Repository\Contracts;

interface TestInterface{
public function info($request);
public function deleteAnimal($request);
public function healthcreate($request);
public function healthedit($request);
public function productioncreate($request);
public function productionedit($request);
public function financerecordcreate($request);
public function financerecordedit($request);
public function feeddelete($request);
public function financedelete($request);
public function healthrecordsdelete($request);
public function productiondelete($request);
}
