<?php

namespace App\Console\Commands;

use App\Models\JobPost;
use App\Utilities\functions;
use Illuminate\Console\Command;

class EmbedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:embed-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jobPosts = JobPost::whereNull('vector')->with('tags', 'jobType', 'company', 'jobCompany', 'jobCompany.job_group')->limit(20)->get();

        if ($jobPosts->count() == 0) {
            $this->info('Không có dữ liệu để embedding');

            return;
        }

        foreach ($jobPosts as $jobPost) {

            $content = '';

            foreach ($jobPost->content as $item) {
                $row_content = is_array($item['row_content']) ? implode(', ', $item['row_content']) : $item['row_content'];
                $content .= $item['title'].': '.$item['description'].', '.$row_content.'; ';
            }

            $tags = '';

            foreach ($jobPost->tags as $tag) {
                $tags .= $tag->name.', ';
            }

            $texts = 'mã đăng tuyển: '.$jobPost->id.', '.'tiêu đề: '.$jobPost->title.', lương tối thiểu: '.$jobPost->salary_min.' triệu VNĐ, lương tối đa: '.$jobPost->salary_max.' triệu VNĐ, mô tả: '.$jobPost->description.', kinh nghiệm yêu cầu: '.($jobPost->experience ? $jobPost->experience.' năm' : 'Không yêu cầu kinh nghiệm').', nội dung: '.$content.', tags: '.$tags.', mã công ty: '.$jobPost->company_id.', tên công ty: '.$jobPost->company->title.', công việc: '.$jobPost->jobCompany->title.', nhóm công việc: '.$jobPost->jobCompany->job_group->title.', loại hình làm việc: '.$jobPost->jobType->title.', ';

            try {
                $vector = functions::embedByCohere($texts);
            } catch (\Exception $e) {
                $this->error('Job ID '.$jobPost->id.', Lỗi: '.$e->getMessage());

                continue;
            }

            if ($vector) {
                $jobPost->vector = $vector;
                $jobPost->save();
                $this->info('Đã embed thành công Job ID: '.$jobPost->id);
            } else {
                $this->error('Job ID '.$jobPost->id.', Lỗi: API trả về thành công nhưng không có embeddings');
            }
            usleep(200000);

        }

    }
}
