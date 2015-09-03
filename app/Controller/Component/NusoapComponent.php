<?php
App::import('Vendor', 'twitteroauth', array('file' => 'nusoap-0.9.5'.DS.'lib'.DS.'nusoap.php'));
/**
 * Create a DOCX file. Transform DOCX to PDF
 *
 * @category   Phpdocx
 * @package    examples
 * @subpackage easy
 * @copyright  Copyright (c) 2009-2011 Narcea Producciones Multimedia S.L.
 *             (http://www.2mdc.com)
 * @license    LGPL
 * @version    2.0
 * @link       http://www.phpdocx.com
 * @since      File available since Release 2.0
 */
//require_once '../../classes/TransformDoc.inc';




class CreatePDFComponent extends Component {
    /**
     *
     * @var Codebird
     */
    public $components = array('Session');
    public $controller = null;
    function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->controller = $controller;
    }
    public function test(){        
        $document = new TransformDoc();
        $document->setStrFile('/system/documents/new.docx');
        $document->generatePDF();
    }
}