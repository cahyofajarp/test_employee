<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'department_id' => 1,
            'first_name' => 'Super',
            'last_name' => 'Man',
            'gender' => 'M',
            'position' => 'Tester',
            'salary' => '75000'
        ]);
        Employee::create([
            'department_id' => 1,
            'first_name' => 'Jessica',
            'last_name' => 'Marine',
            'gender' => 'F',
            'position' => 'Architect',
            'salary' => '6000'
        ]);

        Employee::create([
            'department_id' => 2,
            'first_name' => 'Stacy',
            'last_name' => 'Tracy',
            'gender' => 'F',
            'position' => 'Sales Engineer',
            'salary' => '76000'
        ]);
    }
}
