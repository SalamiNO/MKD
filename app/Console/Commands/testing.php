<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        /*$filename = $this->argument("fileName");
        $handle = fopen($filename, "r");
        $string = "";
        while (($line = fgets($handle)) !== false) {
            echo $line;
            $string .= $line;
        };

        */
        $pattern = '/[a-zA-Z]{2,12}-[0-9]{1,5}/';
        $string = "Finish release-18-05-28-bug-123
                ahoj-12
                bug-123 
                INSIDE-125 - Vypis neprelozenych BTF
                [INSIDE-13000000000000] - Intercom na loading page
                [INSIDE-137] - Pod cfpor
                [INSIDEeeeeeeeeeeeee-137] - blabla-123
                [INSIDE-13444-12.radek bug-3333
            ";


        $jiraKeys = array(
            "bug-3333" => "www.seznam.cz",
            "bug-433" => "www.seznam.cz",
            "INSIDE-137" => "www.seznam.cz",
            "bug-123" => "www.seznam.cz",
            "ahoj" => "www.seznam.cz",
            "blabla" => "www.seznam.cz",
            "blabla-123" => "www.seznam.cz",
            "ahoj-12" => "www.seznam.cz",
            "nic" => "www.seznam.cz"
        );

        preg_match_all($pattern, $string, $matches, PREG_SET_ORDER, 0);


        $regexFounds = array();
        foreach ($matches as $match) {
            $regexFounds[] = ($match[0]);

        };

        $regexAndJiraMatches = array();
        $regexAndJiraMatches[] = array_intersect_key($jiraKeys, array_flip($regexFounds));
        $regexAndJiraMatches = $regexAndJiraMatches[0];
        var_dump($regexAndJiraMatches);

        $specialMatch = array();
        foreach ($regexAndJiraMatches as $regexAndJiraMatch => $regexAndJiraMatchValue){
            $specialMatch[] = "<$regexAndJiraMatchValue|$regexAndJiraMatch>";
            var_dump($specialMatch);
        };

        $strResult = str_replace(array_keys($regexAndJiraMatches), $specialMatch, $string);
        echo $strResult;

        }


}



// }}}




