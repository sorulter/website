<?php

namespace App;

use App\Model\Flows;
use App\Model\Pacs;
use App\Model\Ports;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function port()
    {
        return $this->hasOne('App\Model\Ports');
    }

    public function flows()
    {
        return $this->hasOne('App\Model\Flows');
    }

    public function pacs()
    {
        return $this->hasOne('App\Model\Pacs');
    }

    public function activate()
    {
        if ($this->pacs == null) {
            // Create pacs item.
            $pacs = new Pacs;
            $pacs->user_id = $this->id;
            $pacs->rules = '{}';
            $pacs->global = 0;
            $pacs->save();
        }

        // Create flows item.
        if ($this->flows == null) {
            $flows = new Flows;
            $flows->user_id = $this->id;
            $flows->save();
        }

        // Select a port.
        if ($this->port == null) {
            $port = Ports::orderByRaw('RAND()')->where('user_id', '=', '0')->first();
            if ($port == null) {
                return "No enough port to use, please add.";
            }
            Ports::where('id', '=', $port->id)->update(['user_id' => $this->id]);
        }

        $this->activate = 1;
        $this->save();
    }
}
