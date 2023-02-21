<?php

namespace App\Services;

use App\Models\Ambiente;
use App\Models\Reserva;
use App\Models\User;

class ReservaService
{
    public function criar(Ambiente $ambiente, User $usuario)
    {
        $reserva = new Reserva();
        $reserva->id_ambiente = $ambiente->id;
        $reserva->id_usuario = $usuario->id;
        $reserva->save();
    
    }
}