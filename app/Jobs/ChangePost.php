<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ChangePost implements ShouldQueue
{
    use Queueable;

    public $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post  $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->post->photo = 'bigfile/bigfile.zip';
        $this->post->save();
    }
}
