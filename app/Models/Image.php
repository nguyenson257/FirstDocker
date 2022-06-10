<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public function sports()
    {
        return $this->hasone(Sport::class, 'id', 'price_id');
    }
}
