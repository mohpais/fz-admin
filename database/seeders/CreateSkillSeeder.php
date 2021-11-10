<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class CreateSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['PHP', 'Python', 'SQLServer', 'PostgreSQL'];
        $skills = array();
        foreach ($data as $item) {
            $obj = (object)array(
                'name' => $item
            );
            array_push($skills, $obj);
        }
        
        Skill::factory()->create($data);
    }
}
