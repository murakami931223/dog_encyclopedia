<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FavoriteController extends Controller
{
    public function favoriteJudge(Request $request) {
        $dogId = $request->dog_id;
        $user = Auth::user();

        $result = $user->favorite_dogs()->toggle($dogId);

        $isDeleted = count($result['detached']) > 0;

        $isMypage = str_contains(url()->previous(), 'mypage');

        return  response()->json([
            'deleteOK' => ($isDeleted && $isMypage)
        ]);
    }
}
