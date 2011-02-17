<?php
require_once Mage::getModuleDir('controllers', 'Mage_Catalog').DS.'ProductController.php';
class Oggetto_QuickLook_ProductController extends Mage_Catalog_ProductController{

    
   /**
     * Product view action
     */
    public function viewAction()
    {
        if ($product = $this->_initProduct()) {
            Mage::dispatchEvent('catalog_controller_produc1t_view', array('product'=>$product));

            if ($this->getRequest()->getParam('options')) {
                $notice = $product->getTypeInstance(true)->getSpecifyOptionMessage();
                Mage::getSingleton('catalog/session')->addNotice($notice);
            }

            Mage::getSingleton('catalog/session')->setLastViewedProductId($product->getId());
            $this->_initProductLayout($product);
            $this->_initLayoutMessages('catalog/session');
            $this->_initLayoutMessages('tag/session');
            $this->_initLayoutMessages('checkout/session');
            $this->renderLayout();
        }
        else {
            if (isset($_GET['store'])  && !$this->getResponse()->isRedirect()) {
                $this->_redirect('');
            } elseif (!$this->getResponse()->isRedirect()) {
                $this->_forward('noRoute');
            }
        }
    }
    
}
