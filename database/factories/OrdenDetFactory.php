<?php

namespace Database\Factories;

use App\Models\Orden;
use App\Models\OrdenDet;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenDetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrdenDet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productos = ['Cepillos taza tipo record Incale Record','Alicates PMA AI-2','Alicates PMA AI-5', 'Tenazas articuladas Bahco','Alicates cortantes Bahco','Alicates Bahco Ergo','Alicate ergonomico Peygran','Alicates para ceramica Perygran'];
        return [
            'orden_id' => Orden::all()->random()->id,
            'producto_descripcion' => $this->faker->unique()->randomElement($productos),
            'cantidad' => mt_rand(1, 10),
            'estado' => $this->faker->randomElement(['I', 'A'])
        ];
    }
}
