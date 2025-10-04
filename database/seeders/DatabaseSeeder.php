<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use App\Models\MataKuliah;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 osen
        $dosens = Dosen::factory()->count(10)->create();

        //  Buat 50 mata kuliah dan kaitkan ke dosen yang ada secara acak
        MataKuliah::factory()->count(50)->make()->each(function ($mk) use ($dosens) {
            $mk->dosen_id = $dosens->random()->id;
            $mk->save();
        });
    }
}
