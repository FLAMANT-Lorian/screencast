<?php

namespace Animal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pet extends Model
{
    protected $fillable = ['name', 'chip', 'gender', 'age', 'breed', 'tattoo', 'description', 'image_path', 'pet_type_id'];

    protected $casts = [
        'tattoo' => 'array'
    ];

    public function losses():HasMany
    {
        return $this->hasMany(Loss::class);
    }

    public function pet_type():BelongsTo
    {
        return $this->belongsTo(PetType::class);
    }

    public function pet_owners(): BelongsToMany
    {
        return $this->belongsToMany(PetOwner::class, 'losses');
    }
}