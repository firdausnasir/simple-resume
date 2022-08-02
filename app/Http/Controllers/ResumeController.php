<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Resume;
use App\Models\WorkHistory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResumeController extends Controller
{
    public function __invoke(Resume $resume)
    {
        $work_histories = $resume->workHistories->sortKeysDesc()->map(fn (WorkHistory $history) =>
            [
                'title' => $history->title,
                'company' => $history->company,
                'detail' => $history->detail,
                'start' => $history->started_working_at->format('m/Y'),
                'end' => $history->ended_working_at ? $history->ended_working_at->format('m/Y') : 'Present',
            ]
        )->values();

        $education = $resume->educations->sortKeysDesc()->map(fn (Education $education) =>
            [
                'institute' => $education->institutional_name,
                'major' => $education->education_major,
                'start' => $education->started_study_at->format('m/Y'),
                'end' => $education->ended_study_at ? $education->ended_study_at->format('m/Y') : 'Present',
            ]
        )->values();

        return Inertia::render('Resume', [
            'resume' => $resume,
            'work_histories' => $work_histories,
            'educations' => $education
        ]);
    }
}
