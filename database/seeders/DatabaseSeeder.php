<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Resume;
use App\Models\User;
use App\Models\WorkHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Firdaus Nasir',
            'email' => 'firdaus@gmail.com',
        ]);

        $resume = new Resume();
        $resume->name = $user->name;
        $resume->position = 'Junior Software Engineer';
        $resume->contact_info = [
            'phone' => '+60137641124',
            'email' => $user->email,
        ];
        $resume->summary = 'Dedicated and result-oriented software engineer with 2 years of experience in developing and maintaining various web apps written in PHP and Laravel.';

        /* @var Resume $resume */
        $resume = $user->resume()->save($resume);

        $lorem_ipsum = Http::get('https://loripsum.net/api')->body();

        $work_to_insert = [
            [
                'title' => 'System Engineer',
                'company' => 'Digital Hustlaz Technologies Sdn Bhd',
                'started_working_at' => Carbon::parse('July 2020'),
                'ended_working_at' => Carbon::parse('July 2021'),
                'detail' => $lorem_ipsum,
            ],
            [
                'title' => 'Software Engineer',
                'company' => 'Involve Asia Technologies Sdn Bhd',
                'started_working_at' => Carbon::parse('August 2021'),
                'ended_working_at' => null,
                'detail' => $lorem_ipsum,
            ],
        ];

        $work = [];
        foreach ($work_to_insert as $item) {
            $temp = new WorkHistory();
            foreach ($item as $key => $value) {
                $temp->{$key} = $value;
            }

            $work[] = $temp;
        }

        $resume->workHistories()->saveMany($work);

        $education = new Education();
        $education->institutional_name = 'Multimedia University';
        $education->education_major = 'BEng (Hons) Electronics majoring in Computer';
        $education->started_study_at = Carbon::parse('June 2016');
        $education->ended_study_at = Carbon::parse('May 2020');
        $education->detail = 'CGPA: 3.46';

        $resume->educations()->save($education);
    }
}
