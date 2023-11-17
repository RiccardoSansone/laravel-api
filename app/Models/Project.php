<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'description', 
        'authors',
        'thumb',
        'projectlink',
        'projectgithub',
        'type_id'
    ];

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class);
    }

    public function technologies(): BelongsToMany {
        return $this->belongsToMany(Technology::class, 'project_technology');
    }
}

