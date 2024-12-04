<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Scopes\PostScope;
use Illuminate\Console\Command;

class AcceptPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:accept-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accepting posts Automatically during 2 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts=Post::withoutGlobalScope(PostScope::class)->where('status','0')->get();
        foreach($posts as $post)
        {
        $post->status='1';
        $post->save();
        }
    }
}
