<?php
/*
Schnellcheck für Versandarten (Bestellung Step 3)
Autor: Frank Zunderer (www.zunderer.de)
Version: 1.0 (OXID 4.4.x)
*/
class versandcheck extends versandcheck_parent{
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

            $oPayList = oxPaymentList::getInstance();
            $oDelList = oxDeliveryList::getInstance();

            $oCur = $this->getConfig()->getActShopCurrencyObject();
            $dBasketPrice = $oBasket->getPriceForPayment() / $oCur->rate;
            
            $deldbg .= "<font color='red'>Versandarten:</font> ";

            // checking if these ship sets available (number of possible payment methods > 0)
            foreach ( $this as $sShipSetId => $oShipSet ) {
                $deldbg .= "<br /><font color='red'>$oShipSet->oxdeliveryset__oxtitle:</font> ";
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
                        $deldbg .= "OK";
                    }
                    else $deldbg .= "keine g&uuml;ltige Versandkostenregel zugeordnet";
                }
                else $deldbg .= "keine g&uuml;ltige Zahlungsart zugeordnet";
            }
        }
        else $deldbg .= "Keine g&uuml;ltige Versandart gefunden";
        oxUtilsView::getInstance()->addErrorToDisplay( new oxException( $deldbg ) );
        return array( $aActSets, $sActShipSet, $aActPaymentList );
    }
}