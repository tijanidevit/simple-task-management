<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function project() : BelongsTo {
        return $this->belongsTo(Project::class);
    }


    public function notes() : HasMany {
        return $this->hasMany(TaskNote::class);
    }
}
