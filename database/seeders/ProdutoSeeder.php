<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use Carbon\Carbon;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::create([
            'formaPgto'   => 'Cartão de Crédito',
            'dataCompra'  => Carbon::now()->subDays(10),
            'dataRecebto' => Carbon::now()->subDays(5),
            'obs'         => 'Primeira compra de teste',
            'foto'        => null,
        ]);

        Produto::create([
            'formaPgto'   => 'Boleto Bancário',
            'dataCompra'  => Carbon::now()->subDays(20),
            'dataRecebto' => Carbon::now()->subDays(15),
            'obs'         => 'Produto recebido com atraso',
            'foto'        => null,
        ]);

        Produto::create([
            'formaPgto'   => 'PIX',
            'dataCompra'  => Carbon::now()->subDays(3),
            'dataRecebto' => null,
            'obs'         => 'Compra ainda não entregue',
            'foto'        => null,
        ]);
    }
}
