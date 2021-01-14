<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $begin = new \DateTime( '-6 month' );
        $end = new \DateTime( 'now' );

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval, $end);

        $days = [];

        foreach($daterange as $date){
            $days[] = [
                'temp' => rand(-30, 30),
                'date_at' => $date->format("Y-m-d")
            ];
        }

        DB::table('history')->insert($days);
    }
}
