<?php
namespace App;

//namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ClientResetPasswordNotification;
class Client extends Authenticatable
{
    protected $guard = 'clients';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'midname', 'lastname', 'email', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
     public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }
    public function nocbilling()
    {
        return $this->hasMany('App\NocBilling','state','conn_state');
    }

     public function place_bid()
    {
        return $this->hasMany('App\PlaceBid','client_id','id');
    }
    public function sms(){
        return $this->hasMany('App\SmsLog','client_id','id');
    }

    public function email(){
        return $this->hasMany('App\EmailLog','client_id','id');
    }

    public function exchangedata(){
       return $this->hasOne('App\Exchange', 'client_id', 'id');
    }

   }
