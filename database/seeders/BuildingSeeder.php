<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = array(
            array('build_name' => 'Общежитие №1','build_adrr' => 'ул. Крылова, 6'),
            array('build_name' => 'Общежитие №6','build_adrr' => 'ул. Троицкая, 108 а'),
            array('build_name' => 'Общежитие №7','build_adrr' => 'ул. Энгельса, 67 б'),
            array('build_name' => 'Общежитие №8','build_adrr' => 'ул. Первомайская, 166 Б','floor_room' => '5','hostel' => '1'),
            array('build_name' => 'Общежитие №9','build_adrr' => 'ул. Первомайская, 166 В','floor_room' => '5','hostel' => '1'),
            array('build_name' => 'Общежитие №10','build_adrr' => 'ул. Троицкая, 126','floor_room' => '5','hostel' => '1'),
            array('build_name' => 'Общежитие №11','build_adrr' => 'ул. Энгельса, 85 а','floor_room' => '5','hostel' => '1'),
            array('build_name' => 'Общежитие №12','build_adrr' => 'ул. Троицкая, 98','floor_room' => '9','hostel' => '1'),
            array('build_name' => 'Главный корпус','build_adrr' => 'ул. Просвещения, 132 А','floor_room' => '1','hostel' => '0'),
            array('build_name' => 'Корпус ЭнФ','build_adrr' => 'ул. Просвещения, 132 Б','floor_room' => '3','hostel' => '0'),
            array('build_name' => 'Горный корпус','build_adrr' => 'ул. Просвещения, 132 В','floor_room' => '4','hostel' => '0'),
            array('build_name' => 'УБК','build_adrr' => 'ул. Просвещения, 132 ГА','floor_room' => '5','hostel' => '0'),
            array('build_name' => 'Корпус ТФ','build_adrr' => 'ул. Просвещения, 132 Г','floor_room' => '4','hostel' => '0'),
            array('build_name' => 'Корпус ТМиР','build_adrr' => 'ул. Просвещения, 132 Д','floor_room' => '4','hostel' => '0'),
            array('build_name' => 'ОКС и СБУ','build_adrr' => 'ул. Просвещения, 132 Ж','floor_room' => '3','hostel' => '0'),
            array('build_name' => 'Лабораторный корпус','build_adrr' => 'ул. Просвещения, 132 Я','floor_room' => '4','hostel' => '0'),
            array('build_name' => 'Манеж','build_adrr' => 'ул. Просвещения, 132 М','floor_room' => '2','hostel' => '0'),
            array('build_name' => 'Спорткомплекс','build_adrr' => 'ул. Просвещения, 132 Щ','floor_room' => '2','hostel' => '0'),
            array('build_name' => 'Бассейн','build_adrr' => 'ул. Просвещения, 132 Э','floor_room' => '3','hostel' => '0'),
            array('build_name' => 'Столовая','build_adrr' => 'ул. Просвещения, 132 Ш','floor_room' => '1','hostel' => '0'),
            array('build_name' => 'ЦЭРС','build_adrr' => 'ул. Просвещения, 132 У','floor_room' => '2','hostel' => '0'),
            array('build_name' => 'НИИ Нанотехнологии','build_adrr' => 'ул. Просвещения, 132 З','floor_room' => '3','hostel' => '0'),
            array('build_name' => 'Западная проходная','build_adrr' => 'ул. Просвещения, 132','floor_room' => '1','hostel' => '0'),
            array('build_name' => 'Южная проходная','build_adrr' => 'ул. Просвещения, 132','floor_room' => '1','hostel' => '0')
        );

          foreach ($buildings as $k) {
            DB::table('buildings')->insert([
                'name' => $k['build_name'],
                'address' => $k['build_adrr'],
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    }
}
