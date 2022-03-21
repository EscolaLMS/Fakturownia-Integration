<?php

namespace EscolaLms\FakturowniaIntegration\Database\Factories;

use EscolaLms\FakturowniaIntegration\Models\FakturowniaOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class FakturowniaOrderFactory extends Factory
{
    protected $model = FakturowniaOrder::class;

    public function definition(): array
    {
        return [
            'fakturownia_id' => 1,
        ];
    }
}
