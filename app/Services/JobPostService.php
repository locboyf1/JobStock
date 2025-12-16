<?php

namespace App\Services;

use App\Models\JobPost;
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
}
