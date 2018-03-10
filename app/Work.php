<?php

namespace App;
use App\Client;

use Illuminate\Database\Eloquent\Model;


class Work extends Model 
{

    protected $table = 'works';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'tarea', 'fecha_limite', 'cliente_id', 'prioridad','estado'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Client', 'cliente_id');
    }

    

}
