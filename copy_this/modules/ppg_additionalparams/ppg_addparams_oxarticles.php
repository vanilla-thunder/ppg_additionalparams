<?php
/**
 * @link      http://www.paramente-gaida.de
 * @package   ppg_additionalparams
 * @copyright (C) Paul Gaida 2012
 */

class ppg_addparams_oxarticles extends ppg_addparams_oxarticles_parent {
    
    public function explodeaddparams($addparams) {
        $addparams = explode("|",$addparams);
        return $addparams;
    }
}

?>