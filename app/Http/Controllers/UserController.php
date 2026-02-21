<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dog;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //マイページ表示処理
    public function showMypage() {
        $user = Auth::user();
        $favorites = Favorite::with(['dog'])
                                ->where('user_id',$user->id)
                                ->get();

        return view('mypage', compact('favorites','user'));
    }

    //編集権限の切り替え
    public function empowerment(Request $request) {
        $user = User::findOrFail($request->user_id);

        //現在の値を反転させる処理
        $user->is_admin = !$user->is_admin;
        $user->save();

        return response()->json([
                                'success' => true,
                                'is_admin' => $user->is_admin
                                ]);
    }
}
