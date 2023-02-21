<?php

namespace Tests\Unit;

use App\Exceptions\DataInicioFuturaException;
use App\Exceptions\DatasIguaisException;
use App\Models\User;
use App\Models\Ambiente;
use App\Models\Reserva;
use App\Services\ReservaService;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservaServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testCriaReserva(): void
    {
        Carbon::setTestNow(Carbon::create(2023,2,22,0,0,0));
        $usuario = User::factory()->create();
       
        $ambiente = Ambiente::factory()->create();

       $dataInicio = Carbon::create(2023,2,22,5,10,10);
       $dataFim = Carbon::create(2023,2,23,5,10,10);

       $sut = new ReservaService();
       $sut->setAmbiente($ambiente)
       ->setUsuario($usuario)
       ->criar($dataInicio, $dataFim);
       
        $this->assertDatabaseHas(Reserva::class, [
        'id_ambiente'=> $ambiente->id,
        'id_usuario'=> $usuario->id,
        'data_inicio'=>$dataInicio->toDatetimeString(),
        'data_fim'=>$dataFim->toDateTimeString(),
        ]);
    }


    public function testImpedeReservaDataInicioEFimIguais(): void
    {
        Carbon::setTestNow(Carbon::create(2022,12,28,0,0,0));
        $usuario = User::factory()->create();
       
        $ambiente = Ambiente::factory()->create();

       $dataInicio = Carbon::create(2023,1,1,5,10,10);
       $dataFim = Carbon::create(2023,1,1,5,10,10);

       $this->expectException(DatasIguaisException::class);
       $sut = new ReservaService();
       $sut->setAmbiente($ambiente)
       ->setUsuario($usuario)
       ->criar($dataInicio, $dataFim);
        
        $this->assertDatabaseEmpty(Reserva::class);

    }

    public function testImpedeDataInicioMenorQueAgora(): void
    {
        Carbon::setTestNow(Carbon::create(2023,1,2,0,0,0));
       $usuario = User::factory()->create();
       
       $ambiente = Ambiente::factory()->create();

       $dataInicio = Carbon::create(2023,1,1,5,10,10);
       $dataFim = Carbon::create(2023,1,2,5,10,10);

       $this->expectException(DataInicioFuturaException::class);
       $sut = new ReservaService();
       $sut->setAmbiente($ambiente)
       ->setUsuario($usuario)
       ->criar($dataInicio, $dataFim);
        
        $this->assertDatabaseEmpty(Reserva::class);

    }
}
