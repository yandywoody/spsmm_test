<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model {
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'detail', 
        'location_id', 
        'stock', 
        'satuan'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }    

}