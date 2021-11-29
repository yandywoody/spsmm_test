<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RequestHdr extends Model {
    use HasFactory;
    
    protected $table = 'request_hdrs';

    protected $fillable = [
        'doc_num', 
        'doc_date', 
        'user_id', 
        'approve', 
        'comments'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request_dtl()
    {
        return $this->hasMany(RequestDtl::class);
    }    



}