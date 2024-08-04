<?php

namespace App\Http\Repository\Contracts;

interface TestInterface{
public function info($request);
public function deleteAnimal($request);
public function healthcreate($request);
public function healthedit($request);
}
