<?php


namespace App\Console\Commands\Including;


class TransformAndReplace {

    private $regexAndJiraMatches = array();

    private $replacement = array();

    private $result = "";

    /**
     * @param $jiraKeys
     * @return array
     */

    public function jiraUpper($jiraKeys) {

        return array_change_key_case($jiraKeys, CASE_UPPER);

    }

    /**
     * @param $regexFounds
     * @return array
     */

    public function regexUpper ($regexFounds) {

        return array_map("strtoupper", $regexFounds);

    }

    /**
     * @param $regexFounds
     * @param $string
     * @return mixed
     */

    public function upperCaseRegexString ($regexFounds, $string) {

        return str_replace($regexFounds, $this->regexUpper($regexFounds), $string);

    }

    /**
     * @param $jiraKeys
     * @param $regexFounds
     * @param $string
     * @return mixed|string
     */

    public function TransformAndReplace ($jiraKeys, $regexFounds, $string) {
        $this->jiraUpper($jiraKeys);
        //$jiraKeysUpper = array_change_key_case($jiraKeys, CASE_UPPER);

        $this->regexUpper($regexFounds);
        //$regexFoundsUpper = array_map("strtoupper", $regexFounds);

        $this->upperCaseRegexString($regexFounds, $string);
        //$upperCaseRegexString = str_replace($regexFounds, $this->regexUpper($regexFounds), $string);


        $this->regexAndJiraMatches[] = array_intersect_key($this->jiraUpper($jiraKeys), array_flip($this->regexUpper($regexFounds)));
        $this->regexAndJiraMatches = $this->regexAndJiraMatches[0];


        foreach ($this->regexAndJiraMatches as $regexAndJiraMatch => $regexAndJiraMatchValue){
            $this->replacement[] = "<$regexAndJiraMatchValue|$regexAndJiraMatch>";

        };

        $this->result = str_replace(array_keys($this->regexAndJiraMatches), $this->replacement, $this->upperCaseRegexString($regexFounds, $string));

        return $this->result;
    }

}