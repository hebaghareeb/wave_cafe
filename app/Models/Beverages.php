<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverages extends Model
{

    use HasFactory;
    protected $table = 'beverages';
    public function category()
    {
        return $this->belongesTo(category::class);
    }
}
