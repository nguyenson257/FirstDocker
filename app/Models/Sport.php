<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Sport extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    public function category()
    {
        return $this->hasone(Category::class, 'id', 'category_id');
    }
    public function price()
    {
        return $this->hasone(Price::class, 'id', 'price_id');
    }
    public function image()
    {
        return $this->hasmany(Image::class);
    }
    public $sortable = ['id', 'name', 'category_id', 'price_id','updated_at'];
}
