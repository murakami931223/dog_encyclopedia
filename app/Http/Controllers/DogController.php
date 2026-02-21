<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Size;
use App\Models\Origin;
use App\Models\User;

class DogController extends Controller
{
    //トップページ表示処理
    public function showTop(Request $request) {

        $dogs = Dog::with(['size', 'origin'])
                    ->withSort($request->get('sort'))
                    ->get();

        //ソートしたときの動作
        //_list_items.blade.phpだけ読み込ませる
        if ($request->ajax()) {
            return response()->json([
                'html' => view('_list_items', compact('dogs'))->render(),
            ]);
        }

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
        
        $dogs = Dog::searchDog($keyword, $category)
                    ->withSort($request->get('sort'))
                    ->paginate(10)
                    ->withQueryString();
        
        // セッションに検索条件を保存
        $request->session()->put('search', [
            'keyword' => $keyword,
            'category_id' => $category,
        ]);
        
        //ソートしたときの動作
        //_list_items.blade.phpだけ読み込ませる
        if ($request->ajax()) {
            return response()->json([
                'html' => view('_list_items', compact('dogs'))->render(),
                //「○○の犬」を書き換えるためのデータ
                'keyword' => $keyword,
                'search_category_name' => $search_category_name,
            ]);
        }

        return view('list', compact('dogs','keyword','search_category_name'));
    }

    //記事ページ表示処理
    public function showArticle($id) {
        $dog = Dog::with(['size', 'origin'])->findOrFail($id);

        $dog -> view_count += 1;
        $dog -> save();

        return view('article', compact('dog'));
    }
}
