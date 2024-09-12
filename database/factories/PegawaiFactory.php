<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pegawai>
 */
class PegawaiFactory extends Factory
{
    protected $model = \App\Models\pegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();

        return [
            'nama' => $faker->name,
            'alamat' => $faker->address,
            'tanggal_lahir' => $faker->date,
            'foto' => 'default.jpg',
        ];
    }
}
