<?php

namespace App\Services;

use App\Models\JobPost;
use App\Models\ViewJobPostHistory;
use App\Utilities\functions;

class JobPostService
{
    public function getJobPostsSimilar($embed = [], $take = 10, $excludeId = null)
    {
        if ($excludeId == null) {
            $jobs = JobPost::IsShow()->whereNotNull('vector')->get();
        } else {
            $jobs = JobPost::IsShow()->whereNotNull('vector')->where('id', '!=', $excludeId)->get();
        }
        $jobSearch = $jobs->map(function ($q) use ($embed) {
            $q->similarity = functions::cosineSimilarity($q->vector, $embed);

            return $q;
        });

        $jobSearch = $jobSearch->sortByDesc('similarity')->take($take);

        return $jobSearch;
    }

    public function getJobPostAverageSimilarity($userId, $take = 3)
    {
        $views = ViewJobPostHistory::where('user_id', $userId)->orderBy('created_at', 'desc')->take($take)->with('jobPost')->get();
        if ($views->isEmpty()) {
            return null;
        }
        $dimNumber = count($views[0]->jobPost->vector);
        $result = array_fill(0, $dimNumber, 0);

        foreach ($views as $view) {
            $vector = $view->jobPost->vector;
            for ($i = 0; $i < $dimNumber; $i++) {
                $result[$i] += $vector[$i];
            }
        }

        $result = array_map(function ($q) use ($views) {
            return $q / $views->count();
        }, $result);

        return $result;
    }
}
