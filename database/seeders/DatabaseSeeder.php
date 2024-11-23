<?php

namespace Database\Seeders;

use App\Enums\EducationalInstitutionEnum;
use App\Enums\EducationalLevelEnum;
use App\Models\Career;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        Career::create([
            'name' => 'Licenciatura en Informatica',
            'educational_institution' => EducationalInstitutionEnum::UASD->value,
            'educational_level' => EducationalLevelEnum::GRADE->value,
        ]);

    }
}
