<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


        // Define a scope for searching with conditions
        public function scopeSearch($query, $conditions)
        {
            return $query->where(function ($query) use ($conditions) {
                // Add your where conditions here based on $conditions array
                if (isset($conditions['search']['value'])) {
                    $search = $conditions['search']['value'];
                    $query->where(function ($query) use ($search) {
                            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                                ->orWhere('mobile', $search)
                                ->orWhere('email', $search);
                    });
                }

                if (isset($conditions['from']) &&  isset($conditions['to'])) {
                    $query->where(function ($query) use ($conditions) {
                        $startDate = $conditions['from'].' 00:00:00';
                        $endDate = $conditions['to'].' 23:59:59';
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    });
                }

                // Add more conditions as needed...
            });
        }
}
