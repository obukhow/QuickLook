<?php

class Oggetto_Label_Block_Product_Result extends Mage_CatalogSearch_Block_Result
{
  
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $this->_productCollection = Mage::getSingleton('catalogsearch/layer')->getProductCollection()
                    ->addAttributeToSelect('is_label')
                    ->addAttributeToSelect('is_enabled_label')
                    ->addAttributeToSelect('label_display')
                    ->addAttributeToSelect('label_position')
                    ->addAttributeToSelect('label_image');
        }

        return $this->_productCollection;
    }
}