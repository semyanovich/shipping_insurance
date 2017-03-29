<?php

class Shipping_Insurance_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATCH = "insurance_options/main_section/";

    public function isEnabled(){
        return (Mage::getStoreConfig(self::XML_PATCH . 'is_enable', Mage::app()->getStore()) == 1);
    }

    public function isNewStep(){
        return (Mage::getStoreConfig(self::XML_PATCH . 'is_new_step', Mage::app()->getStore()) == 1);
    }


    public function getAmount(){
        return (Mage::getStoreConfig(self::XML_PATCH . 'amount', Mage::app()->getStore()) == 1);
    }

    public function getType(){
        return (Mage::getStoreConfig(self::XML_PATCH . 'type', Mage::app()->getStore()) == 1);
    }



    /**
     * Retrieve checkout session model
     *
     * @return Mage_Checkout_Model_Session
     */
    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * Retrieve checkout quote model object
     *
     * @return Mage_Sales_Model_Quote
     */
    public function getQuote()
    {
        return $this->getCheckout()->getQuote();
    }

    /**
     * Retrieve value of shipping insurance
     *
     * @return Mage_Sales_Model_Quote
     */
    public function getInsurance()
    {
        if($this->isEnabled()){
            if($amount = $this->getAmount()) {
                if ($this->getType() === '2') {
                    return $this->getCheckout()->getQuote()->getSubtotal() * $amount / 100;
                }
                return $amount;
            }
        } 
        return false;
    }
}   