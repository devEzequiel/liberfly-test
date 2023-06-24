<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileType extends BaseModel
{
    use HasFactory;

    protected $table = 'file_types';

    public $timestamps = false;

    protected $fillable = [
        'description'
    ];

    public const TYPES = [
        ['description' => 'physical'],
        ['description' => 'digital']
    ];

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class, 'type_id', 'id');
    }
}
