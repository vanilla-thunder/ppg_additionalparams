<?php
/**
 * @link      http://www.paramente-gaida.de
 * @package   modules
 * @copyright (C) Paul Gaida 2012
 * @version OXID eShop CE for Ver. 4.7.1
 */

class ppg_additionalparams extends ppg_additionalparams_parent {
    
    public function explodeaddparams($addparams) {
        $addparams = explode("|",$addparams);
        return $addparams;
    }
}

?>