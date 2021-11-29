<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RequestDtl extends Model {
    use HasFactory;
    
    protected $table = 'request_dtls';

    protected $fillable = [
        'request_hdr_id', 
        'product_id', 
        'quantity', 
        'comments'
    ];

    public function request_hdr()
    {
        return $this->belongsTo(RequestHdr::class);
    }    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }    

}