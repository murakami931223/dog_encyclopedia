<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // すべてのビューで $search 変数を利用可能にする
        $searchData = Session::get('search', ['keyword' => '', 'category_id' => '']);
        
        View::share('search', $searchData);

        //パラメーターに入っている値を参照し、なければ$searchData内を参照する。
        $currentCategory = request('category_id', $searchData['category_id']);
        View::share('currentCategory', $currentCategory);

        // 検索バー用データの共有
        View::share('sizes', \App\Models\Size::all());
        View::share('origins', \App\Models\Origin::all());

    }
}
