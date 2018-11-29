<?php

class FindRegex {

    const PATTERN = "/[a-zA-Z]{2,12}-[0-9]{1,5}/";

    private $string;

    private $jiraKeys;

    private $regexFounds;

    private $regexAndJiraMatches = array();

    private $replacement = array();

    private $result = "";

    /**
     * FindRegexInc constructor.
     * @param $string
     */
    public function __construct($string)
    {
        $this->setString($string);
    }


    /**
     * @param $string
     * @return array
     */

    public function getRegex() 
    {

        if ($this->regexFounds === null) {

            $this->regexFounds = array();

            preg_match_all(static::PATTERN, $this->getString(), $matches, PREG_SET_ORDER, 0);

            foreach ($matches as $match) {
                $this->regexFounds[] = ($match[0]);
            };
        }

        return $this->regexFounds;

    }

    /**
     * @return mixed
     */
    private function getString()
    {

        return $this->string;
    }

    /**
     * @param mixed $string
     */
    private function setString($string)
    {

        $this->string = $string;
    }

    /**
     * @param $jiraKeys
     * @return array
     */


    public function jiraUpper()
    {

        return array_change_key_case($this->jiraKeys, CASE_UPPER);

    }

    /**
     * @param $regexFounds
     * @return array
     */

    public function regexUpper()
    {

        return array_map("strtoupper", $this->regexFounds);

    }

    /**
     * @param $regexFounds
     * @param $string
     * @return mixed
     */

    public function upperCaseRegexString($regexFounds, $string)
    {

        return str_replace($regexFounds, $this->regexUpper(), $string);

    }

    /**
     * @param $jiraKeys
     * @param $regexFounds
     */
    public function RegexAndJiraMatchArray()
    {

        $this->regexAndJiraMatches[] = array_intersect_key($this->jiraUpper(), array_flip($this->regexUpper()));
        $this->regexAndJiraMatches = $this->regexAndJiraMatches[0];
    }

    /**
     *
     */
    public function ArrayReplace()
    {

        foreach ($this->regexAndJiraMatches as $regexAndJiraMatch => $regexAndJiraMatchValue) {
            $this->replacement[] = "<$regexAndJiraMatchValue|$regexAndJiraMatch>";

        };

    }

    public function ReplaceString()
    {

        $this->result = str_replace(array_keys($this->regexAndJiraMatches), $this->replacement, $this->upperCaseRegexString($this->getRegex(), $this->getString()));

        return $this->result;
    }

    /*public function getResult() {

        return $this->result;

    }*/
}


