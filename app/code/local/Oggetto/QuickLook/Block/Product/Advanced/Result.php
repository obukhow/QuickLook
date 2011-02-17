<?php

class Oggetto_Label_Block_Product_Advanced_Result extends Mage_CatalogSearch_Block_Advanced_Result
{

    protected function _getProductCollection()
    {
        return $this->getSearchModel()->getProductCollection()
                ->addAttributeToSelect('is_label')
                ->addAttributeToSelect('is_enabled_label')
                ->addAttributeToSelect('label_display')
                ->addAttributeToSelect('label_position')
                ->addAttributeToSelect('label_image')
        ;
    }

}
