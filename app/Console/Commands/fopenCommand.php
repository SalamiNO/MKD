<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\Including\GetFileContent;

class fopenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fopen:command1 {fileName}';

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
     * @param string $filename
     * @return string
     */
    public function getFileContent($filename)
    {
        $handle = fopen($filename, "r");
        $string = "";
        while (($line = fgets($handle)) !== false) {
            echo $line;
            $string .= $line;
        };

        return $string;
    }

    /**
     * @param $string
     * @return array
     */

    public function findRegex($string)
    {

        $pattern = '/[a-zA-Z]{2,12}-[0-9]{1,5}/';
        preg_match_all($pattern, $string, $matches, PREG_SET_ORDER, 0);

        $regexFounds = array();
        foreach ($matches as $match) {
            $regexFounds[] = ($match[0]);
        };
        return $regexFounds;
    }



    /**
     * @return array
     */
    private function getJiraKeys()
    {
        return array(
            "BUg-3333" => "www.seznam.cz",
            "bUg-433" => "www.seznam.cz",
            "iNSIDe-137" => "www.seznam.cz",
            "bug-123" => "www.seznam.cz",
            "ahoj" => "www.seznam.cz",
            "blabla" => "www.seznam.cz",
            "blabla-123" => "www.seznam.cz",
            "ahoj-12" => "www.seznam.cz",
            "nic" => "www.seznam.cz",
            "bug-394" => "google.cz",
            "insIDE-125" => "neco.cz"
        );
    }

    /**
     * @param $jiraKeys
     * @param $regexFounds
     * @param $string
     * @return mixed
     */

    public function transformAndReplace($jiraKeys, $regexFounds, $string)
    {

        $jiraKeysUpper = array_change_key_case($jiraKeys, CASE_UPPER);
        $regexFoundsUpper = array_map("strtoupper", $regexFounds);

        $upperCaseRegexString = str_replace($regexFounds, $regexFoundsUpper, $string);

        $regexAndJiraMatches = array();
        $regexAndJiraMatches[] = array_intersect_key($jiraKeysUpper, array_flip($regexFoundsUpper));
        $regexAndJiraMatches = $regexAndJiraMatches[0];

        $replacement = array();
        foreach ($regexAndJiraMatches as $regexAndJiraMatch => $regexAndJiraMatchValue) {
            $replacement[] = "<$regexAndJiraMatchValue|$regexAndJiraMatch>";

        };

        $result = str_replace(array_keys($regexAndJiraMatches), $replacement, $upperCaseRegexString);

        return $result;
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
        $fileContent = $this->GetFileContent("fileName");

        $string = $fileContent;

        //regex
        $regexFind = $this->findRegex($string);
        var_dump($regexFind);

        //jira
        $jiraKeys = $this->getJiraKeys();

        //transform
        $transform = $this->transformAndReplace($jiraKeys, $regexFind, $string);
        $result = $transform;
        var_dump($result);

        //zapis do noveho souboru
        $newFile = $this->resultIntoNewFile($result);

    }
}


        /*
        $pattern = '/[a-zA-Z]{2,12}-[0-9]{1,5}/';
        preg_match_all($pattern, $string, $matches, PREG_SET_ORDER, 0);

        $regexFounds = array();
        foreach ($matches as $match) {
            $regexFounds[] = ($match[0]);
        };*/

        //prevedeni klicu na upper case
        /*$jiraKeysUpper = array_change_key_case($jiraKeys, CASE_UPPER);
        $regexFoundsUpper = array_map("strtoupper", $regexFind);

        $upperCaseRegexString = str_replace($regexFind, $regexFoundsUpper, $string);*/

        // srovnani klicu a replace
        /*$regexAndJiraMatches = array();
        $regexAndJiraMatches[] = array_intersect_key($jiraKeysUpper, array_flip($regexFoundsUpper));
        $regexAndJiraMatches = $regexAndJiraMatches[0];

        $replacement = array();
        foreach ($regexAndJiraMatches as $regexAndJiraMatch => $regexAndJiraMatchValue){
            $replacement[] = "<$regexAndJiraMatchValue|$regexAndJiraMatch>";

        };

        $result = str_replace(array_keys($regexAndJiraMatches), $replacement, $upperCaseRegexString);
        echo $result;*/


        //zápis do nového souboru
        /*$openWrite = fopen ("openWrite.txt", "c");
        $write = fwrite($openWrite, $result, 1500);
        echo $write; //toto otevře soubor se zadanou cestou, přečte, vytvoří nový soubor a přepíše text tam :-)*/

