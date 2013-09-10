<?php

/**
 * @category    Inchoo
 * @package     Inchoo_UrlRewriteImporter
 * @author      Branko Ajzele <ajzele@gmail.com>
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_UrlRewriteImporter_Model_Observer {

    public function injectImportUrlRewritesButton($observer) {
        if ($observer->getEvent()->getBlock() instanceof Mage_Adminhtml_Block_Urlrewrite) {
            $observer->getEvent()->getBlock()->addButton('importProductRewrites', array(
                'label' => Mage::helper('catalog')->__('Import URL Rewrites'),
                'onclick' => "setLocation('{$observer->getEvent()->getBlock()->getUrl('*/Inchoo_UrlRewriteImporter_Import/new')}')",
                'class' => 'add'
            ), 0, 1);
        }
    }

}
