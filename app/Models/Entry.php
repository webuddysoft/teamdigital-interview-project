<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    /**
     * Define fillable columns.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'user_id'
    ];

    /**
     * Define the user association
     *
     * @return BelongsTo
     */
    public function entities(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
