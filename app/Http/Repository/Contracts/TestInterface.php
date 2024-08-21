<?php

namespace App\Http\Repository\Contracts;

interface TestInterface{
public function info($request);
public function deleteAnimal($id);
public function healthcreate($request);
public function healthedit($request);
public function productioncreate($request);
public function productionedit($request);
public function financerecordcreate($request);
public function financerecordedit($request);
public function feeddelete($id);
public function financedelete($id);
public function healthrecordsdelete($id);
public function productiondelete($id);
public function documentdelete($id);
public function updatearduino($id, $request);
}
