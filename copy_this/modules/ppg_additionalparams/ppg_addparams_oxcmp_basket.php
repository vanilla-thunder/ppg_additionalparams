<?php
/**
 * @link      http://www.paramente-gaida.de
 * @package   ppg_additionalparams
 * @copyright (C) Paul Gaida 2012
 */
 
class ppg_addparams_oxcmp_basket extends ppg_addparams_oxcmp_basket_parent {
    
    /**
     * Collects and returns array of items to add to basket. Product info is taken not only from
     * given parameters, but additionally from request 'aproducts' parameter
     *
     * @param string $sProductId product ID
     * @param double $dAmount    product amount
     * @param array  $aSel       product select lists
     * @param array  $aPersParam product persistent parameters
     * @param bool   $blOverride amount override status
     *
     * @return mixed
     */
    protected function _getItems( $sProductId = null, $dAmount = null, $aSel = null, $aPersParam = null, $blOverride = false )
    {
        // collecting items to add
        $aProducts = oxConfig::getParameter( 'aproducts' );

        // collecting specified item
        $sProductId = $sProductId?$sProductId:oxConfig::getParameter( 'aid' );
        if ( $sProductId ) {

            // additionally fething current product info
            $dAmount = isset( $dAmount ) ? $dAmount : oxConfig::getParameter( 'am' );

            // select lists
            $aSel = isset( $aSel )?$aSel:oxConfig::getParameter( 'sel' );

            // persistent parameters
            if ( empty($aPersParam) ) {
                $aPersParam = oxConfig::getParameter( 'persparam' );
                /*if ( !is_array($aPersParam) || empty($aPersParam['details']) ) {
                    $aPersParam = null;
                } */
            }

            $sBasketItemId = oxConfig::getParameter( 'bindex' );

            $aProducts[$sProductId] = array( 'am' => $dAmount,
                                             'sel' => $aSel,
                                             'persparam' => $aPersParam,
                                             'override'  => $blOverride,
                                             'basketitemid' => $sBasketItemId
                                           );
        }

        if ( is_array( $aProducts ) && count( $aProducts ) ) {

            if (oxConfig::getParameter( 'removeBtn' ) !== null) {
                //setting amount to 0 if removing article from basket
                foreach ( $aProducts as $sProductId => $aProduct ) {
                    if ( isset($aProduct['remove']) && $aProduct['remove']) {
                        $aProducts[$sProductId]['am'] = 0;
                    } else {
                        unset ($aProducts[$sProductId]);
                    }
                }
            }

            return $aProducts;
        }

        return false;
    }
    
    /**
     * Adds all articles user wants to add to basket. Returns
     * last added to basket item.
     *
     * @param array $aProducts products to add array
     *
     * @return  object  $oBasketItem    last added basket item
     */
    protected function _addItems ( $aProducts )
    {
        $oActView   = $this->getConfig()->getActiveView();
        $sErrorDest = $oActView->getErrorDestination();

        $oBasket = $this->getSession()->getBasket();
        $oBasketInfo = $oBasket->getBasketSummary();

        foreach ( $aProducts as $sAddProductId => $aProductInfo ) {

            $sProductId = isset( $aProductInfo['aid'] ) ? $aProductInfo['aid'] : $sAddProductId;

            // collecting input
            $aProducts[$sAddProductId]['oldam'] = isset( $oBasketInfo->aArticles[$sProductId] ) ? $oBasketInfo->aArticles[$sProductId] : 0;

            $dAmount = isset( $aProductInfo['am'] )?$aProductInfo['am']:0;
            $aSelList = isset( $aProductInfo['sel'] )?$aProductInfo['sel']:null;
            $aPersParam = ( isset( $aProductInfo['persparam'] ) && is_array( $aProductInfo['persparam'] ) )?$aProductInfo['persparam']:null;
            $blOverride = isset( $aProductInfo['override'] )?$aProductInfo['override']:null;
            $blIsBundle = isset( $aProductInfo['bundle'] )?true:false;
            $sOldBasketItemId = isset( $aProductInfo['basketitemid'] )?$aProductInfo['basketitemid']:null;

            try {
                $oBasketItem = $oBasket->addToBasket( $sProductId, $dAmount, $aSelList, $aPersParam, $blOverride, $blIsBundle, $sOldBasketItemId );
            } catch ( oxOutOfStockException $oEx ) {
                $oEx->setDestination( $sErrorDest );
                // #950 Change error destination to basket popup
                if ( !$sErrorDest  && $this->getConfig()->getConfigParam( 'iNewBasketItemMessage') == 2) {
                    $sErrorDest = 'popup';
                }
                oxRegistry::get("oxUtilsView")->addErrorToDisplay( $oEx, false, (bool) $sErrorDest, $sErrorDest );
            } catch ( oxArticleInputException $oEx ) {
                //add to display at specific position
                $oEx->setDestination( $sErrorDest );
                oxRegistry::get("oxUtilsView")->addErrorToDisplay( $oEx, false, (bool) $sErrorDest, $sErrorDest );
            } catch ( oxNoArticleException $oEx ) {
                //ignored, best solution F ?
            }
            if ( !$oBasketItem ) {
                $oInfo = $oBasket->getBasketSummary();
                $aProducts[$sAddProductId]['am'] = isset( $oInfo->aArticles[$sProductId] ) ? $oInfo->aArticles[$sProductId] : 0;
            }
        }

        //if basket empty remove posible gift card
        if ( $oBasket->getProductsCount() == 0 ) {
            $oBasket->setCardId( null );
        }

        // information that last call was tobasket
        $this->_setLastCall( $this->_getLastCallFnc(), $aProducts, $oBasketInfo );

        return $oBasketItem;
    }

}
?>