<?php

/**
 * @category    Inchoo
 * @package     Inchoo_UrlRewriteImporter
 * @author      Branko Ajzele <ajzele@gmail.com>
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_UrlRewriteImporter_Block_Adminhtml_UrlRewriteImporter_Edit_Tab_Import extends Mage_Adminhtml_Block_Widget_Form {

    public function __construct() {
        parent::__construct();
    }

    public function initForm() {
        $form = new Varien_Data_Form();

        $csvOptionsFieldset = $form->addFieldset('csv_options_fieldset', array(
            'legend' => Mage::helper('customer')->__('CSV Parser Options'),
        ));

        $csvOptionsFieldset->addField('length', 'text', array(
            'name' => 'length',
            'label' => 'Length',
            'value' => '0',
            'after_element_html' => '<small>fgetcsv $length param, defaults to: 0</small>',
            'class' => 'required-entry',
            'required' => true,
        ));

        $csvOptionsFieldset->addField('delimiter', 'text', array(
            'name' => 'delimiter',
            'label' => 'Delimiter',
            'value' => ',',
            'after_element_html' => '<small>fgetcsv $delimiter param, defaults to: ,</small>',
            'class' => 'required-entry',
            'required' => true,
        ));

        $csvOptionsFieldset->addField('enclosure', 'text', array(
            'name' => 'enclosure',
            'label' => 'Enclosure',
            'value' => '"',
            'after_element_html' => '<small>fgetcsv $enclosure param, defaults to: "</small>',
            'class' => 'required-entry',
            'required' => true,
        ));

        $csvOptionsFieldset->addField('escape', 'text', array(
            'name' => 'escape',
            'label' => 'Escape',
            'value' => '\\\\',
            'after_element_html' => '<small>fgetcsv $escape param, defaults to: \\\</small>',
            'class' => 'required-entry',
            'required' => true,
        ));
        
        $csvOptionsFieldset->addField('skipline', 'checkbox', array(
            'name' => 'skipline',
            'label' => 'Skip Line',
            'value' => '1',
            'after_element_html' => '<small>Skip a first line of CSV file (headers)</small>',
        ));

        $csvFileFieldset = $form->addFieldset('csv_file_fieldset', array(
            'legend' => Mage::helper('customer')->__('CSV File')
        ));

        $csvFileFieldset->addField('file', 'file', array(
            'name' => 'file',
            'label' => 'File',
            'class' => 'required-entry',
            'required' => true,
            'after_element_html' => '<small>*.csv</small>',
        ));

        $this->setForm($form);
        return $this;
    }

}
