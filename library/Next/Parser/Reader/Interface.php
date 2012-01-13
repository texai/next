<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author texai
 */
interface Next_Parser_Reader_Interface {
    
    /**
     * Read
     *
     * @throws Exception If reading cannot be performed
     * @return boolean
     */
    public function read($name);
}
?>
