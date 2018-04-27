<?php

namespace App\Console\Commands\Vshijian;

use Carbon\Carbon;
use Illuminate\Console\Command;

class Bar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Vshijian:bar {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description ';

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
        //
        $count = $this->option('count');    //执行的总数量
        if (empty($count)){
            $count = 10000;
        }
        #开始设置进度条
        $bar = $this->output->createProgressBar($count);
        #记录开始事件
        $beginAt = Carbon::now();
        $total = 0;
        $currentId = 0;
        for ($i = 0 ; $i <= $count ; $i++){
            $currentId = $i;
            $total++;
            $bar->advance();
        }
        #计算花费的时间
        $costSeconds = Carbon::now()->diffInSeconds($beginAt);
        #计算操作的速度
        $rate        = $costSeconds > 0 ? round(($total-1) / $costSeconds, 2) : $total-1;
        echo "\n LastID: {$currentId}, Speed: {$rate}/s ,Time: {$costSeconds}s .\n";

//        User::chunk(100,
//            function($users) use (&$bar, $beginAt, &$total) {
//                #记录当前id
//                $currentId = 0;
//                foreach($users as $user) {
//                    $total ++;
//                    #逻辑处理
//
//                    #更改当前的id
//                    $currentId = $user->id;
//                    $bar->advance();
//                }
//                #计算花费的时间
//                $costSeconds = Carbon::now()->diffInSeconds($beginAt);
//                #计算操作的速度
//                $rate        = $costSeconds > 0 ? round(($total-1) / $costSeconds, 2) : $total-1;
//                echo "\n LastID: {$currentId}, Speed: {$rate}/s ,Time: {$costSeconds}s .\n";
//            }
//        );
    }
}
