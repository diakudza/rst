<?php

namespace App\Jobs;

use App\Helpers\TaskHashHelper;
use App\Helpers\TaskHelper;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    protected $i;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, $i)
    {
        $this->task = $task;
        $this->i = $i;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            $hash = TaskHashHelper::makeHash($this->task);
            $this->task->update(['status' => $this->i, 'hash' => $hash]);
    }
}
