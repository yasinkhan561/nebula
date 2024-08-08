<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Website;
use App\Models\Status;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_id',
        'batch',
        'page',
        'url',
        'issue_link',
        'description',
        'status_id',
        'criterion',
        'issue_reference',
        'element',
        'check_type',
        'responsibility',
        'severity',
        'complexity',
        'date',
    ];
 



    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
