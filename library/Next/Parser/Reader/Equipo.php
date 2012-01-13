<?php
class Next_Parser_Reader_Equipo
    extends Next_Parser_Reader_Abstract
    implements Next_Parser_Reader_Interface, Next_Parser_Interface
{
    public static $_interface = 'equipo';
    public static $_displayName = 'Equipos (CSV)';
    
    public function read($name) {
        $data = $this->_readCsv($name);
        $this->_quitarFilaInicio($data);
        return $data;
    }

}