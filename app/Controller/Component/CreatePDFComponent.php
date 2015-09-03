<?php
//App::import('Vendor', 'phpdocx', array('file' => 'classes'.DS.'DocxUtilities.inc'));


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
    
    
    public function download($name,$print = null){

        require_once '../Vendor/phpdocxCorporate/classes/TransformDoc.inc';
        require_once('../Vendor/phpdocxCorporate/classes/CreateDocx.inc'); 

        $pdf = new TransformDoc();
        $pdf->setStrFile($name);
        $pdfname = '';
        if($print){
            $pdfname = $pdf->generatePrintPDF('system/print_documents/'); 
            
        }else{
            $pdf->generatePDF();
        }
        @unlink($name);
        return $pdfname;
    }
    
    public function replace($variables = NULL,$document = NUll){
        require_once '../Vendor/phpdocxCorporate/classes/TransformDoc.inc';
        require_once('../Vendor/phpdocxCorporate/classes/CreateDocx.inc'); 
        $docx = new CreateDocxFromTemplate('system/documents/'.$document);

        // templete $first_nem$
       
        $options = array('parseLineBreaks' =>true);
        $docx->replaceVariableByText($variables, $options);
        $name = md5(microtime());
        $docx->createDocx($name);
        return $name;
    }
}