<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test1 {var=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test command in laravel!';

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
        echo $this->argument('var');
        return 'test';
    }
}
