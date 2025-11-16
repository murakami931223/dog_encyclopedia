<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function dog() {
        return $this->hasMany(Dog::class, 'size_id', 'id');
    }
}
