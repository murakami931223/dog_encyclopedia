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

        return $query->paginate(10);
        }
}
