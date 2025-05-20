<?php

namespace App\Models;

use App\Traits\HasPublishStatus;
use App\Traits\Search;
use Illuminate\Database\Eloquent\Model;

class TblCategory extends Model
{
    use HasPublishStatus;

    protected $table = 'tbl_categories';
  
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
    
    public function products()
    {
        return $this->hasMany(TblProduct::class, 'category_id');
    }   
}
