<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class Hello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Regex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test command';

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
        /*$name = $this->ask("what is your name");

        $this->info("my name is $name");*/



    }
}
