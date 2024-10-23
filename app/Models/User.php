<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRedirectRoute(): string
    {
        // return match((int)$this->role_id) {
        return match ($this->role) {
            'admin' => 'user-list',
            'user' => 'device/' . $this->username,
            // ...
        };
    }

    // Correct relationship with the 'settings' table, through the 'user_settings' pivot table
    public function settings(): BelongsToMany
    {
        return $this->belongsToMany(Setting::class, 'user_settings')
                    ->withPivot('value'); // 'value' is the custom field in the pivot table
    }

    // Event to handle default settings on user creation
    protected static function booted()
    {
        static::created(function ($user) {
            // Fetch all default settings
            $settings = Setting::all();

            // Loop through each setting and attach it to the user with default values
            foreach ($settings as $setting) {
                $defaultValue = $setting->default_value;

                // Ensure notifications are stored as JSON if necessary
                if ($setting->name === 'notifications') {
                    $defaultValue = json_encode($defaultValue);
                }

                // Attach the setting with the default value to the user
                $user->settings()->attach($setting->id, ['value' => $defaultValue]);
            }
        });
    }
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
