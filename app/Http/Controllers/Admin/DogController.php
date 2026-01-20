<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Dog;
use App\Models\Size;
use App\Models\Origin;
use App\Models\User;

use App\Http\Requests\DogRequest;

class DogController extends Controller
{
    //新規追加画面表示処理
    public function showCreate() {
        $dog = Dog::with(['size', 'origin'])->get();
        return view('admin.create', compact('dog'));
    }

    //新規登録処理
    public function store(DogRequest $request) {

        try {
            // トランザクション開始
            DB::beginTransaction();
            // 登録処理呼び出し
            Dog::registerDog($request);
            DB::commit();

            return redirect()->route('admin.create')->with('success', '登録しました');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
    } 

    //更新画面表示
    public function showEdit($id) {
        $dog = Dog::with(['size', 'origin'])->findOrFail($id);
        return view('admin.edit', compact('dog'));
    }

    //更新処理
    public function update(DogRequest $request,$id) {

        try {
            // トランザクション開始
            DB::beginTransaction();
            // 登録処理呼び出し
            Dog::editDog($request,$id);
            DB::commit();

            return redirect()->route('admin.create')->with('success', '更新しました');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
    }

    //削除処理
    public function delete($id){
        $dog = Dog::findOrFail($id);
        try {
            // トランザクション開始
            DB::beginTransaction();
            // 登録処理呼び出し
            Dog::deleteDog($id);
            DB::commit();

            $getUrl = url()->previous();

            //犬の記事画面の時だけトップ画面に遷移するようにする。
            if (str_contains($getUrl, 'article')) {
                return redirect()->route('top')->with('success','削除しました');
            }

            //非同期処理で削除したときの処理
            if (request()->ajax()) {
                return response()->json(['success' => true,
                                        'message' => '削除しました']);
            }

            return back()->with('success', '削除しました'); //予備

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }
    }
}
