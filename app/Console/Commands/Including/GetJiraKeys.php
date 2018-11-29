<?php

class GetJiraKeys {

    private $jiraKeys = array(
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

     /**
     * @return array
     */
    public function GotJiraKeys()
    {
        return $this->jiraKeys;
    }

}
