<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    public function dog() {
        return $this->hasMany(Dog::class, 'origin_id', 'id');
    }
}
