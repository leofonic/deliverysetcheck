<?php
/*
Fastcheck for Deliverysets (Order Step 3)
Author: Frank Zunderer (www.zunderer.de)
Version: 1.0 (OXID 4.6.x)
*/
class deliverysetcheck_oxdeliverysetlist extends deliverysetcheck_oxdeliverysetlist_parent{
    public function getDeliverySetData( $sShipSet, $oUser, $oBasket )
    {
        $sActShipSet = null;
        $aActSets    = array();
        $aActPaymentList = array();

        if (!$oUser) {
            return;
        }

        $this->_getList( $oUser, $oUser->getActiveCountry() );

        // if there are no shipsets we dont need to load payments
        if ($this->count() ) {

            // one selected ?
            if ( $sShipSet && !isset( $this->_aArray[$sShipSet] ) ) {
                $sShipSet = null;
            }

            $oPayList = oxRegistry::get("oxPaymentList");
            $oDelList = oxRegistry::get("oxDeliveryList");

            $oCur = oxRegistry::getConfig()->getActShopCurrencyObject();
            $dBasketPrice = $oBasket->getPriceForPayment() / $oCur->rate;
            
            $deldbg .= '<font color="red">'.oxRegistry::get("oxLang")->translateString('DELIVERYSETCHECK_SHIPPINGMETHODS').'</font> ';

            // checking if these ship sets available (number of possible payment methods > 0)
            foreach ( $this as $sShipSetId => $oShipSet ) {
                $deldbg .= '<br /><font color="red">'.$oShipSet->oxdeliveryset__oxtitle.':</font>';
                $aPaymentList = $oPayList->getPaymentList( $sShipSetId, $dBasketPrice, $oUser );
                if ( count( $aPaymentList ) ) {

                    // now checking for deliveries
                    if ( $oDelList->hasDeliveries( $oBasket, $oUser, $oUser->getActiveCountry(), $sShipSetId ) ) {
                        $aActSets[$sShipSetId] = $oShipSet;

                        if ( !$sShipSet || ( $sShipSetId == $sShipSet ) ) {
                            $sActShipSet = $sShipSet = $sShipSetId;
                            $aActPaymentList = $aPaymentList;
                            $oShipSet->blSelected = true;
                        }
                        $deldbg .= oxRegistry::get("oxLang")->translateString('DELIVERYSETCHECK_SHIPPINGMETHOD_OK');
                    }
                    else $deldbg .= oxRegistry::get("oxLang")->translateString('DELIVERYSETCHECK_SHIPPINGRULES_ERROR');
                }
                else $deldbg .= oxRegistry::get("oxLang")->translateString('DELIVERYSETCHECK_PAYMENTS_ERROR');
            }
        }
        else $deldbg .= oxRegistry::get("oxLang")->translateString('DELIVERYSETCHECK_ACTIVESHPPINGESET_ERROR');
        oxRegistry::get("oxUtilsView")->addErrorToDisplay( new oxException( $deldbg ) );
        return array( $aActSets, $sActShipSet, $aActPaymentList );
    }
}