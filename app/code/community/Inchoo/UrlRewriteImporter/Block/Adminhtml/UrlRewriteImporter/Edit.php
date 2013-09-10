<?php

/**
 * @category    Inchoo
 * @package     Inchoo_UrlRewriteImporter
 * @author      Branko Ajzele <ajzele@gmail.com>
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_UrlRewriteImporter_Block_Adminhtml_UrlRewriteImporter_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_UrlRewriteImporter';
        $this->_blockGroup = 'inchoo_urlrewriteimporter';

        parent::__construct();

        $this->_updateButton('back', 'onclick', "setLocation('{$this->getUrl('*/urlrewrite/index')}')");
        $this->_removeButton('reset');
    }

    public function getHeaderText() {
        return 'New import';
    }

}
