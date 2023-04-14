<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Define fillable columns.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'subscribed_to_newsletter'
    ];

    /**
     * Define the entities association
     *
     * @return HasMany
     */
    public function entities(): HasMany
    {
        return $this->hasMany(Entry::class, 'user_id');
    }

    /**
     * Get the last Entry of the user
     *
     * @return Entry | null
     */
    public function getLastEntryAttribute(): mixed
    {
        return $this->entities()
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }
}
