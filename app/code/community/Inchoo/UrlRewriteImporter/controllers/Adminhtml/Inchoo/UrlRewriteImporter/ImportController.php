<?php

/**
 * @category    Inchoo
 * @package     Inchoo_UrlRewriteImporter
 * @author      Branko Ajzele <ajzele@gmail.com>
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_UrlRewriteImporter_Adminhtml_Inchoo_UrlRewriteImporter_ImportController extends Mage_Adminhtml_Controller_Action {

    protected function _getSession() {
        return Mage::getSingleton('adminhtml/session');
    }

    private function _allowedType($type) {
        $mimes = array(
            'text/csv',
            'text/plain',
            'application/csv',
            'text/comma-separated-values',
            'application/excel',
            'application/vnd.ms-excel',
            'application/vnd.msexcel',
            'text/anytext',
            'application/octet-stream',
            'application/txt',
        );

        if (in_array($type, $mimes)) {
            return true;
        }

        return false;
    }

    public function saveAction() {
        if ($this->getRequest()->isPost()) {

            $filename = $_FILES['file']['tmp_name'];

            if (!file_exists($filename)) {
                $this->_getSession()->addError('Unable to upload the file!');
                $this->_redirectReferer();
                return;
            }

            if ($this->_allowedType($_FILES['file']['type']) == false) {
                $this->_getSession()->addError('Sorry, mime type not allowed!');
                $this->_redirectReferer();
                return;
            }

            $length = $this->getRequest()->getParam('length', 0);
            $delimiter = $this->getRequest()->getParam('delimiter', ',');
            $enclosure = $this->getRequest()->getParam('enclosure', '"');
            $escape = $this->getRequest()->getParam('escape', '\\');
            $skipline = $this->getRequest()->getParam('skipline', false);

            $total = 0;
            $totalSuccess = 0;
            $logException = '';

            if (($fp = fopen($filename, 'r'))) {
                while (($line = fgetcsv($fp, $length, $delimiter, $enclosure, $escape))) {

                    $total++;
                    if ($skipline && ($total == 1)) {
                        continue;
                    }

                    $requestPath = $line[0];
                    $targetPath = $line[1];

                    $rewrite = Mage::getModel('core/url_rewrite');

                    $rewrite->setIdPath(uniqid())
                            ->setTargetPath($targetPath)
                            ->setOptions('RP')
                            ->setDescription('Inchoo_UrlRewriteImporter')
                            ->setRequestPath($requestPath)
                            ->setIsSystem(0)
                            ->setStoreId(0);

                    try {
                        $rewrite->save();
                        $totalSuccess++;
                    } catch (Exception $e) {
                        $logException = $e->getMessage();
                        Mage::logException($e);
                    }
                }
                fclose($fp);
                unlink($filename);

                if ($total === $totalSuccess) {
                    $this->_getSession()->addSuccess(sprintf('All %s URL rewrites have been successfully imported.', $total));
                } elseif ($totalSuccess == 0) {
                    $this->_getSession()->addError('No URL rewrites have been imported.');
                    if (!empty($logException)) {
                        $this->_getSession()->addError(sprintf('Last logged exception: %s', $logException));
                    }
                    $this->_redirectReferer();
                    return;
                } else {
                    $this->_getSession()->addNotice(sprintf('%s URL rewrites have been imported.', $total - $totalSuccess));
                    if (!empty($logException)) {
                        $this->_getSession()->addError(sprintf('Last logged exception: %s', $logException));
                    }
                }
            }
        }
        $this->_redirect('*/urlrewrite/index');
        return;
    }

    public function editAction() {
        $this->loadLayout();

        $this->_addContent($this->getLayout()->createBlock('inchoo_urlrewriteimporter/adminhtml_UrlRewriteImporter_edit'));
        $this->_addLeft($this->getLayout()->createBlock('inchoo_urlrewriteimporter/adminhtml_UrlRewriteImporter_edit_tabs'));

        $this->_setActiveMenu('catalog/urlrewrite');

        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

}
