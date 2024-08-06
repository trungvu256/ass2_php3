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
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
    ];

    public function insertDataUser($params){
        $params['role'] = 1;
        $res = User::query()->create($params);
        return $res;
    }
    public function loadAllRole(){
        return $this->belongsTo(Role::class,'role');
    }
    public function loadListUser(){
        $query = User::query()
            ->with('loadAllRole')
            ->orderBy('id')
            ->paginate(5);
        return $query;
    }
    public function loadIdUser($id){
        $res = User::query()->find($id);
        return $res;
    }
    public function updateDataUser($request,$id){
        $res = User::query()->find($id)->update($request);
        return $res;
    }

}
