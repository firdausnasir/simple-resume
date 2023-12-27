<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Resume;
use App\Models\User;
use App\Models\WorkHistory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::factory()->create();

        $currentJobTitle = fake()->jobTitle();

        /* @var Resume $resume */
        $resume = $user
            ->resume()
            ->save(
                new Resume([
                    'name'         => $user->name,
                    'position'     => $currentJobTitle,
                    'contact_info' => [
                        'phone' => fake()->phoneNumber(),
                        'email' => fake()->email(),
                    ],
                    'summary' => implode("\n", fake()->paragraphs(2))
                ])
            );

        $work_to_insert = [
            [
                'title'              => fake()->jobTitle(),
                'company'            => fake()->company(),
                'started_working_at' => Carbon::parse('July 2020'),
                'ended_working_at'   => Carbon::parse('July 2021'),
                'detail'             => implode("\n", fake()->paragraphs(5)),
            ],
            [
                'title'              => $currentJobTitle,
                'company'            => fake()->company(),
                'started_working_at' => Carbon::parse('August 2021'),
                'ended_working_at'   => null,
                'detail'             => implode("\n", fake()->paragraphs(5)),
            ],
        ];

        $work = [];
        foreach ($work_to_insert as $item) {
            $work[] = new WorkHistory($item);
        }

        $resume
            ->workHistories()
            ->saveMany($work);

        $resume
            ->educations()
            ->save(
                new Education([
                    'institutional_name' => fake()->company(),
                    'education_major'    => fake()->bs(),
                    'started_study_at'   => Carbon::parse('June 2016'),
                    'ended_study_at'     => Carbon::parse('May 2020'),
                    'detail'             => implode("\n", fake()->paragraphs(5)),
                ])
            );
    }
}
