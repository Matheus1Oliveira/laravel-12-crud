<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use Carbon\Carbon;

class CompraSeeder extends Seeder
{
    public function run(): void
    {
        Compra::create([
            'formaPgto'   => 'Cartão de Crédito',
            'dataCompra'  => Carbon::now()->subDays(10),
            'dataRecebto' => Carbon::now()->subDays(5),
            'obs'         => 'Primeira compra de teste',
            'foto'        => null,
        ]);

        Compra::create([
            'formaPgto'   => 'Boleto Bancário',
            'dataCompra'  => Carbon::now()->subDays(20),
            'dataRecebto' => Carbon::now()->subDays(15),
            'obs'         => 'Compra recebido com atraso',
            'foto'        => null,
        ]);

        Compra::create([
            'formaPgto'   => 'PIX',
            'dataCompra'  => Carbon::now()->subDays(3),
            'dataRecebto' => null,
            'obs'         => 'Compra ainda não entregue',
            'foto'        => null,
        ]);
    }
}
