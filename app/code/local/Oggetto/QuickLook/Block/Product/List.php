<?php
class Oggetto_Label_Block_Product_List extends Mage_Catalog_Block_Product_List
{
 
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $layer = Mage::getSingleton('catalog/layer');
            /* @var $layer Mage_Catalog_Model_Layer */
            if ($this->getShowRootCategory()) {
                $this->setCategoryId(Mage::app()->getStore()->getRootCategoryId());
            }

            // if this is a product view page
            if (Mage::registry('product')) {
                // get collection of categories this product is associated with
                $categories = Mage::registry('product')->getCategoryCollection()
                    ->setPage(1, 1)
                    ->load();
                // if the product is associated with any category
                if ($categories->count()) {
                    // show products from this category
                    $this->setCategoryId(current($categories->getIterator()));
                }
            }

            $origCategory = null;
            if ($this->getCategoryId()) {
                $category = Mage::getModel('catalog/category')->load($this->getCategoryId());
                if ($category->getId()) {
                    $origCategory = $layer->getCurrentCategory();
                    $layer->setCurrentCategory($category);
                }
            }
            $this->_productCollection = $layer->getProductCollection()
                    ->addAttributeToSelect('is_label')
                    ->addAttributeToSelect('is_enabled_label')
                    ->addAttributeToSelect('label_display')
                    ->addAttributeToSelect('label_position')
                    ->addAttributeToSelect('label_image')
                    ;

            $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());

            if ($origCategory) {
                $layer->setCurrentCategory($origCategory);
            }
        }
        return $this->_productCollection;
    }

   
}
