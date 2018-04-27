<?php

namespace App\Models\Foundation;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TCG\Voyager\Traits\VoyagerUser;
use TCG\Voyager\Contracts\User as UserInterface;
class User extends Authenticatable implements UserInterface
{
    use VoyagerUser;
    use Notifiable;
    //
    protected $table = 'users';

    protected $fillable = [
      'name',
      'email',
      'password'
    ];
}
