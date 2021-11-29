<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Location extends Model {
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'max_qty', 
        'area', 
        'zone', 
        'aisle', 
        'bay', 
        'level', 
        'position', 
        'id_group'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}