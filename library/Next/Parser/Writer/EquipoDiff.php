<?php
class Next_Parser_Writer_EquipoDiff
    extends Next_Parser_Writer_Abstract
    implements Next_Parser_Writer_Interface, Next_Parser_Interface
{
    public static $_interface = 'equipo';
    public static $_displayName = 'Equipos (Delta)';

    public function write($data) {
        $mEquipo = new Next_Model_Equipo();
        foreach($data as $rowdata){
            $row = $this->map($rowdata);
            $mEquipo->diff($row);
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