<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['name','state_id'])]
class Municipality extends Model
{
   public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
