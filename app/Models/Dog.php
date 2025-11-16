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
            return $this->belongsToMany(User::class, 'favorites');
        }

        public function getList() {
            $dogs = DB::table('dogs') -> get();

            return $dogs;
        }
}
