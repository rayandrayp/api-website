<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'pages';
    protected $fillable = [
        'pagename',
        'judul',
        'parent_id',
        'description'
    ];

    public function parent()
    {
        return $this->belongsTo('Pages', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Pages', 'parent_id');
    }
}
