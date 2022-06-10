<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';
    
    use HasFactory;
    public function sports()
    {
        return $this->hasmany(Sport::class);
    }
}
