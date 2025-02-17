<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    static public function get_record($request)
    {
        $return = self::select('users.*', 'vendortypes.name as vendor_type_name', 'categories.name as category_name')
            ->join('vendortypes', 'vendortypes.id', '=', 'users.vendor_type_id', 'left')
            ->join('categories', 'categories.id', '=', 'users.category_id', 'left')
            ->orderBy('users.id','desc')
            ->where('users.is_admin','=', 2)
            ->where('users.is_delete','=', 0);
        $return = $return->paginate(10);
        return $return;
    }
    static public function get_single($id)
    {
        return self::find($id);
    }
}
