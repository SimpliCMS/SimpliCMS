<?php

namespace Modules\Core\Resources\Database\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(\Konekt\Address\Seeds\Countries::class);
        $this->call(\Konekt\Address\Seeds\StatesOfUsa::class);
        $this->call(\Konekt\Address\Seeds\StatesOfGermany::class);
    }

}
