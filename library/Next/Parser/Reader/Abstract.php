<?php
abstract class Next_Parser_Reader_Abstract
    extends  Next_Parser_Abstract
{

    protected function _readCsv($file, $length=0, $delimiter = ',') {
        $arr = array();
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, $length, $delimiter)) !== FALSE) {
                $arr[] = $data;
            }
            fclose($handle);
        }
        return $arr;
    }

    protected function _quitarFilaInicio(&$data, $n = 1) {
        foreach(range(1,$n) as $x)
            array_shift($data);
    }
    

}