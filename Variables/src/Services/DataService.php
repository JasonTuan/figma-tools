<?php

namespace Jasontuan\FigmaImport\Services;

class DataService
{
    public function __construct(
        public string $filename,
    )
    {
        if (empty($this->filename) || !file_exists($this->filename))
        {
            throw new \Exception("File $this->filename was not loaded");
        }
    }

    public function readDataByLine()
    {    
        $file = fopen($this->filename, "r");
        while(!feof($file)) {
            $line = fgets($file);
            if (trim($line) != '') {
                yield trim($line);
            }
        }
        fclose($file);
    }
}
