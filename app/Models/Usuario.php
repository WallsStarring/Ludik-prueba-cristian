<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function avgPartidas()
    {
        return $this->partidas()->selectRaw('SUM(DATEDIFF(fechaFin , fechaInicio)) AS minutes')->first();
    }

    public function partidas()
    {
        return $this->hasMany(Partida::class, 'idJugador');
    }
}
