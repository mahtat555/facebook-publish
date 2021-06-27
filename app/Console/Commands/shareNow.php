<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Post;
use App\Http\Controllers\PostsController;

class shareNow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sharenow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =
        "Share the posts exist in the scheduler on Facebook.";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::where("scheduled", "1")->get();
        $posts_controller = new PostsController;
        // For each post in the Database,
        foreach ($posts as $post) {
            // Share it if it's the time for that
            if ($post->created_at <= now()) {
                $posts_controller->share_fb($post);
            }
        }
    }
}
