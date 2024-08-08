<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;
use App\Models\Status;

class Violation extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_id',
        'batch',
        'page_url',
        'timestamp',
        'violation_id',
        'impact',
        'tags',
        'description',
        'help',
        'help_url',
        'node_id',
        'node_impact',
        'node_html',
        'target',
        'failure_summary',
    ];





    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
