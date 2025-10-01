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
        'role',
        'level',
        'xp',
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

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function xpToNextLevel()
    {
        // Masalan: har level uchun 100 XP kerak
        return $this->level * 100;
    }

    public function currentProgress()
    {
        $needed = $this->xpToNextLevel();
        $progress = ($this->xp / $needed) * 100;

        return min($progress, 100); // 100% dan oshmasin
    }

    public function addXp(int $xp)
    {
        // $this->xp — hozirgi progress (XP toward next level)
        $this->xp += $xp;

        // Level uchun kerakli XP har levelga qarab oshadi (masalan: level * 100)
        while ($this->xp >= ($this->level * 100)) {
            // avvalgi level uchun kerakli miqdorni olib tashlaymiz
            $this->xp -= ($this->level * 100);
            $this->level++;
        }

        $this->save();
    }


}
