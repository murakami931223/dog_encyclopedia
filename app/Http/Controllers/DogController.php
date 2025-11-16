<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Size;
use App\Models\Origin;

class DogController extends Controller
{
    public function showList() {
        $model = new Dog();
        $dogs = $model->getList();

        return view('top',['dogs' => $dogs]);
    }
}
