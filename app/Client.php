<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'grado_importancia',
    ];

    public function tareas()
    {
        return $this->hasMany('App\Work', 'cliente_id');
    }

}
