<?php
class Next_Parser_Writer_EquipoReset
    extends Next_Parser_Writer_Abstract
    implements Next_Parser_Writer_Interface, Next_Parser_Interface
{
    public static $_interface = 'equipo';
    public static $_displayName = 'Equipos (Resetear)';

    public function write($data) {
        $mEquipo = new Next_Model_Equipo();
        $mEquipo->truncate();
        foreach($data as $rowdata){
            $mEquipo->insert($this->map($rowdata));
        }
        return true;
    }

    protected function map($rowdata){
        return array(
            'nombre' => $rowdata[0],
            'codigo' => $rowdata[1],
            'tipo' => strtolower($rowdata[2])
        );
    }


}