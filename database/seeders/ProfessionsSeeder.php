<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionsSeeder extends Seeder
{
    public function run()
    {
        $professions = [
            'Accountant',
            'Actor',
            'Architect',
            'Artist',
            'Chef',
            'Consultant',
            'Designer',
            'Doctor',
            'Engineer',
            'Farmer',
            'Journalist',
            'Lawyer',
            'Mechanic',
            'Musician',
            'Nurse',
            'Pharmacist',
            'Photographer',
            'Pilot',
            'Police Officer',
            'Professor',
            'Scientist',
            'Software Developer',
            'Teacher',
            'Therapist',
            'Veterinarian',
            'Writer'
        ];

        foreach ($professions as $profession) {
            DB::table('professions')->insert([
                'name' => $profession,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
