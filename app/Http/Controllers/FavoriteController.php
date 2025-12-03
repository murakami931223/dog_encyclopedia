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

        if (!$user -> is_favorite($dogId)) {
            $user -> favorite_dogs() -> attach($dogId);
        }else{
            $user -> favorite_dogs() -> detach($dogId);
        }

        return  response()->json();
    }
}
