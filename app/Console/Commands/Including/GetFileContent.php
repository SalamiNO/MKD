<?php

class GetFileContent {

    private $file;

    private $string;

    private $handler;

    public function __construct($file) {
        $this->file = $file;
    }


    /**
     * @return string
     * @throws \Exception
     */
    public function getFileContent()
    {
        $string = "";

        $this->openFile();
        while ($line = $this->readLine() !== FALSE) {
            $string .=  $line;
        }
        $this->closeFile();
        return $string;
    }

    /**
     * @return bool|string
     */
    public function readLine()
    {
        $line = fgets($this->handler);
        return $line;
    }

    /**
     * @throws \Exception
     */
    public function openFile()
    {
        $handler = fopen($this->file, "r");
        if($handler === false){
            throw new \Exception("File open failed");
        }
        $this->handler = $handler;
    }

    public function closeFile()
    {
        fclose($this->handler);
    }

}