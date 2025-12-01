<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Size;
use App\Models\Origin;

class DogController extends Controller
{
    //トップページ表示処理
    public function showTop() {

        $dogs = Dog::with(['size', 'origin'])->get();
        return view('top', compact('dogs'));
    }

    //検索機能
    public function showList(Request $request) {
        $keyword = $request->input('keyword','');
        $category = $request->input('category_id','');

        
        $search_category_name = null;
        if(!empty($category)){
            $parts = explode('_', $category);
            $prefix = $parts[0] ?? null;
            $id = $parts[1] ?? null;
            
            if ($prefix === 's' && $id !== null){
                $size = Size::find((int)$id);
                $search_category_name = $size -> type ?? null;
            }elseif ($prefix === 'o' && $id !== null){
                $origin = Origin::find((int)$id);
                $search_category_name = $origin -> country_name ?? null;
            }
        }
        
        $dogs = Dog::searchDog($keyword, $category);
        
        // セッションに検索条件を保存
        $request->session()->put('search', [
            'keyword' => $keyword,
            'category_id' => $category,
        ]);
        
        //     dd([
        //     'Keyword from Form' => $keyword,
        //     'Category from Form' => $category,
        //     'Old Session Data' => $request->session()->get('search'),
        // ]);
        return view('list', compact('dogs','keyword','search_category_name'));
    }

    //記事ページ表示処理
    public function showArticle($id) {
        $dog = Dog::with(['size', 'origin'])->findOrFail($id);

        return view('article', compact('dog'));
    }
}
