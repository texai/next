<?php
class Next_Parser_Writer_Sample
    extends Next_Parser_Writer_Abstract
    implements Next_Parser_Writer_Interface, Next_Parser_Interface
{
    public static $_interface = 'sample';
    public static $_displayName = 'Sample R (=';
    public static $_tables = array();

    public function write($data) {
        return true;
    }

}