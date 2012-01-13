<?php
interface Next_Parser_Writer_Interface
{
    
    /**
     * Write
     *
     * @throws Exception If writing cannot be performed
     * @return boolean
     */
    public function write($data);
}