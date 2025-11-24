<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Size;
use App\Models\Origin;

class DogController extends Controller
{
    public function showTop() {

        $dogs = Dog::with(['size', 'origin'])->get();
        return view('top', compact('dogs'));
    }

    public function showList(Request $request) {
        $keyword = $request->input('keyword','');
        $category = $request->input('category_id','');

    //     dd([
    //     'Keyword from Form' => $keyword,
    //     'Category from Form' => $category,
    //     'Old Session Data' => $request->session()->get('search'),
    // ]);

        $dogs = Dog::searchDog($keyword, $category);

        // セッションに検索条件を保存
        $request->session()->put('search', [
            'keyword' => $keyword,
            'category_id' => $category,
        ]);

        return view('list', compact('dogs'));
    }
}
