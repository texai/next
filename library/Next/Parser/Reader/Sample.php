<?php
class Next_Parser_Reader_Sample
    extends Next_Parser_Reader_Abstract
    implements Next_Parser_Reader_Interface, Next_Parser_Interface
{
    public static $_interface = 'sample';
    public static $_displayName = 'Sample W =)';
    
    public function read($name) {
        return true;
    }

}