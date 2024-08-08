<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Website;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch',
        'url',
        'nodes',
        'critical',
        'serious',
        'moderate',
        'minor',    
        'score',
        'aria',
        'forms',
        'name-role-value'
    ];


    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }
            
}
