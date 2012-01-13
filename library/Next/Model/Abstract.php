<?php
abstract class Next_Model_Abstract
    extends Zend_Db_Table_Abstract
{
    protected $_uniqueDataCache = null;
    
    const MATCH_TOTAL = 'total';
    const MATCH_UNIQUES = 'uniques';
    const MATCH_NO = 'no';

    public function __construct()
    {
        parent::__construct(Zend_Registry::get('dbd'));
    }

    public function truncate($table=null)
    {
        if (is_null($table)) {
            $table = $this->info('name');
        }
        return $this->getAdapter()->query('TRUNCATE TABLE '.$table);
    }

    public function exists($row)
    {
        if (!is_array($this->_unique)){
            $this->_unique = array($this->_unique);
        }
        if ($this->_uniqueDataCache == null) {
            $sql = $this->select()->from($this->info('name'),$this->_unique);
            $this->_uniqueDataCache = $this->getAdapter()->fetchAll($sql);
        }
        foreach ($this->_uniqueDataCache as $uniqueRow) {
            $ret = false;
            $matches = 0;
            foreach ($uniqueRow as $col => $value) {
                if ($row[$col]==$value) {
                    $matches++;
                }
            }
            if ($matches==count($row)) {
                $ret = true;
            }
        }
        return $ret;
    }

    public function updateByUnique($row)
    {
        return $this->update($row, $this->getWhereByUnique($row));
    }

    public function getWhereByUnique($row)
    {
        if (!is_array($this->_unique)){
            $this->_unique = array($this->_unique);
        }
        $wheres = array();
        foreach ($this->_unique as $field) {
            $wheres[] = $this->getAdapter()->quoteInto($field.'=?', $row[$field]);
        }
        return implode(' AND ', $wheres);
    }

    public function diff($row)
    {
        $match = $mEquipo->exists($row);
        if ( $match == self::MATCH_UNIQUES ) {
            $mEquipo->updateByUnique($row);
        } elseif( $match == self::MATCH_NO ) {
            $mEquipo->insert($row);
        }
    }

    
}
?>
