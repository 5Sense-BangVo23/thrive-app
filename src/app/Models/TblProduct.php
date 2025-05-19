<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblProduct extends Model
{
    protected $table = 'tbl_product';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'created_at',
        'updated_at'
    ];
   
    public function category()
    {
        return $this->belongsTo(TblCategory::class, 'category_id');
    }

}
