<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Size;
use App\Models\Origin;
use App\Models\User;

class DogController extends Controller
{
    //新規追加画面表示処理
    public function showCreate() {
        $dog = Dog::with(['size', 'origin'])->get();
        return view('admin.create', compact('dog'));
    }

    //新規登録処理
    public function store(Request $request) {

        try {
            // トランザクション開始
            DB::beginTransaction();
            // 登録処理呼び出し
            $dog = new Dog();
            $dog->registerDog($request);
            DB::commit();

            return redirect()->route('admin.create')->with('success', '登録しました');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
    } 


    //記事ページ表示処理
    public function showEdit($id) {
        $dog = Dog::with(['size', 'origin'])->findOrFail($id);
        return view('admin.edit', compact('dog'));
    }
}
