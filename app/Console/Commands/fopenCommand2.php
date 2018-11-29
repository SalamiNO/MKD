<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

include "Including/autoload.php";

class fopenCommand2 extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fopen:command2 {fileName}';

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
    public function __construct() {
        parent::__construct();
    }


    /**
     * @param $result
     * @return bool|int
     */

    public function resultIntoNewFile($result) {
        $openWrite = fopen ("openWrite.txt", "c");
        $write = fwrite($openWrite, $result, 1500);

        return $write;

    }

    public function handle()
    {
        //line by line
        /*$fileContent = $this->getFileContent($this->argument("fileName"));
        $string = $fileContent;*/

        $getFileContent = new \GetFileContent($this->argument("fileName"));

        $result = ""; //vysledek do noveho souboru
        $getFileContent->openFile();

        while ($string = $getFileContent->readLine()){

            //jira
            $jiraKeysArray = new \GetJiraKeys();
            $jiraKeys = $jiraKeysArray->GotJiraKeys();
            
            //FindAndReplace
            $regexFind = new \FindRegex($string);
            $result = $regexFind->ReplaceString();

            echo $result;

            //var_dump($regexFind);

        }

        //zapis do noveho souboru
        $newFile = $this->resultIntoNewFile($result);


    }

}


