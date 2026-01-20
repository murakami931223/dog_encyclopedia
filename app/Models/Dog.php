<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dog extends Model
{
    protected $fillable = [
        'dog_name',
        'size_id', 
        'origin_id', 
        'description', 
        'dog_img', 
    ];

        public function size()
        {
            return $this->belongsTo(Size::class, 'size_id', 'id');
        }

        public function origin()
        {
            return $this->belongsTo(Origin::class, 'origin_id', 'id');
        }

        public function favorites()
        {
            return $this->hasMany(Favorite::class);
        }

        //検索機能
        public static function searchDog($keyword, $category){
        $searchConditions = [];

        if (!empty($category)) {
            $parts = explode('_', $category);
            
            $prefix = $parts[0] ?? null;
            $id = $parts[1] ?? null;

            if ($prefix === 's' && $id !== null) {
                // 犬種が選択された場合
                $searchConditions['size_id'] = (int)$id;
                
            } elseif ($prefix === 'o' && $id !== null) {
                // 原産国が選択された場合
                $searchConditions['origin_id'] = (int)$id;
            }
        } 
        
        $query = self::with(['size', 'origin']);

        if (isset($searchConditions['size_id'])) {
            $query->where('size_id', $searchConditions['size_id']);
        } elseif (isset($searchConditions['origin_id'])) {
            $query->where('origin_id', $searchConditions['origin_id']);
        }

        if (!empty($keyword)) {
            $query->where('dog_name', 'like', '%' . $keyword . '%');
        }

        return $query;
        }

        //登録処理
        public static function registerDog($request) {
            $dog = new self();
            $dog -> dog_name = $request -> dogName;
            $dog -> size_id = $request -> sizeId;
            $dog -> origin_id = $request -> originId;
            $dog -> description = $request -> description;
            //ファイルアップロード処理
            self::upLoadFile($request, $dog);

            $dog -> save();
        }

        //更新処理
        public static function editDog($request,$id) {
            $dog = self::findOrFail($id);
            $dog -> dog_name = $request -> dogName;
            $dog -> size_id = $request -> sizeId;
            $dog -> origin_id = $request -> originId;
            $dog -> description = $request -> description;
            //ファイルアップロード処理
            self::upLoadFile($request, $dog);

            $dog -> save();
        }

        //ファイルアップロード処理
        private static function upLoadFile($request, $dog){
            $file = $request -> file('dogImg');
            if(!empty($file)){
                if ($file -> isValid()){
                    //ファイルが有効であれば保存処理を行う
                    $filename = $file -> getClientOriginalName();
                    $path = $file -> storeAs('public/img', $filename);

                    $dog -> dog_img = 'storage/img/'.$filename;
                }
            }
        }

        //削除処理
        public static function deleteDog($id) {
            $dog = self::findOrFail($id);
            return $dog->delete();
        }

        //ソート機能
        public function scopeWithSort($query, $sortType)
        {
            switch ($sortType) {
                case 'size-asc':
                    return $query->orderBy('size_id', 'asc');
                case 'size-desc':
                    return $query->orderBy('size_id', 'desc');
                case 'viewCounts-desc':
                    return $query->orderBy('view_count', 'desc');
                default:
                    return $query->orderBy('id','asc');
            }
        }
}
