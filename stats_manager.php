<?php

class StatsManager 
{
    // A manager to handle insertion of stats into the db
    public function __construct()
    {
        $this->tbl_def = array(
            ":title"=>"", 
            ":artist"=>"", 
            ":genre"=>"", 
            ":link"=>"", 
            ":date"=>"", 
            ":location"=>"", 
            ":amount"=>"",
            ":currency"=>"",
            ":has_label"=>"",
            ":label"=>""
        );
    }

    public function gatherStats($data)
    {
        // assemble the data from the csv into an array which will be used
        // to create an insert statement for the db
        foreach ($data as $val) {
            $k = key($this->tbl_def);
            $this->tbl_def[$k] = $val;
            next($this->tbl_def);
        }

        // Get rid of currency symbol from amount
        $amount = preg_replace("/[^\d\.\,\s]+/", "", $this->tbl_def[":amount"]);
        $this->tbl_def[":amount"] = $amount;

        // Convert has_label to sql boolean
        if ($this->tbl_def[":has_label"] == "True") {
            $this->tbl_def[":has_label"] = 1;
        } else {
            $this->tbl_def[":has_label"] = 0;
        }

        reset($this->tbl_def);
    }

    private function printStats($stats)
    {
        // insert stats arr into db
        foreach ($stats as $item) {
            echo $item;
        }
        echo "<br>";
    }
}

?>