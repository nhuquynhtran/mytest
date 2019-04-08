<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use Carbon\Carbon;


class AutoPublishPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:publish:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto publish post';

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
     * @return mixed
     */
    public function handle()
    {
        $list_auto_puplish = Post::where('auto_publish','=',1)
        ->where('publish_time','<=',Carbon::now())
        ->get();
        foreach($list_auto_puplish as $post){
            if($post->publish_time==Carbon::now()){
                $validatedData = array('status' => 1);
                Post::whereId($post->id)->update($validatedData);
            }
        }
        
    }
}
