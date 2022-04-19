<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OtpCode
 *
 * @property int $id
 * @property int $otp_code
 * @property int $user_id
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OtpCodeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode whereOtpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpCode whereUserId($value)
 * @mixin \Eloquent
 */
class OtpCode extends Model
{
    use HasFactory;


    protected $fillable = [
        'otp_code',
        'user_id',
    ];


    protected $dates = [
        'expires_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
