<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Ambiente;
use App\Models\Reserva;
use App\Services\ReservaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservaServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testExample(): void
    {
       //Necessário: usuário, ambiente, executar a ação de criar uma reserva 
       //Usuário
       $usuario = new User([
        'name' => 'adm',
        'email' =>'cristhian@cristhian.com',
        'password'=> '123',
       ]);
       $usuario->save();

       //Ambiente
       $ambiente = new Ambiente([
        'nome' => 'academia'
       ]);
       $ambiente->save();
    
       //Action de criar reserva

       $sut = new ReservaService();
       $sut->criar($ambiente, $usuario);
       
        $this->assertDatabaseHas(Reserva::class, [
        'id_ambiente'=> $ambiente->id,
        'id_usuario'=> $usuario->id
        ]);
    }
}
