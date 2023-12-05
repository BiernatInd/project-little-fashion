<?php

namespace App\Models\Koszyk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koszyk extends Model
{

    protected $table = 'koszyk';
    
    protected $fillable = ['produkt_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
