<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MstPublished extends Model
{
    protected $table = 'mst_published';

    protected $fillable = [
        'status',
        'publishable_type',
        'publishable_id',
    ];

    public function publishable()
    {
        return $this->morphTo();
    }
}
