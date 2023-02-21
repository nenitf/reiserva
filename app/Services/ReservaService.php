<?php

namespace App\Services;

use App\Exceptions\DataInicioFuturaException;
use App\Exceptions\DatasIguaisException;
use App\Models\Ambiente;
use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class ReservaService
{
    public readonly Ambiente $ambiente;
    public readonly User $usuario;

    public function criar(CarbonInterface $dataInicio, CarbonInterface $dataFim)
    {
        if ($dataInicio->gte($dataFim)){
            throw new DatasIguaisException();
        }
        if ($dataInicio->isPast()){
            throw new DataInicioFuturaException();
        }

        $reserva = new Reserva();
        $reserva->id_ambiente = $this->ambiente->id;
        $reserva->id_usuario = $this->usuario->id;
        $reserva->data_inicio = $dataInicio;
        $reserva->data_fim = $dataFim;
        $reserva->save();
    
    }
    public function setAmbiente(Ambiente $ambiente): self
    {
        $this->ambiente = $ambiente;
        return $this;
    }

    public function setUsuario(User $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }
}