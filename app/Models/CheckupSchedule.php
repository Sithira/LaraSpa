<?php

namespace App\Models;

use App\Models\Scopes\ScopeIsActive;
use Illuminate\Database\Eloquent\Model;

class CheckupSchedule extends Model
{
    protected $guarded = ["id"];

//    /**
//     * Get the optician belongs to the checkup.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function optician()
//    {
//        return $this->belongsTo(User::class, 'optician_id', 'id');
//    }
//
//    /**
//     * Get the user belongs to the chekup.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function user()
//    {
//        return $this->belongsTo(User::class, 'user_id', 'id');
//    }
}
