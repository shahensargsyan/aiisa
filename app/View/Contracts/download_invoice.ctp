<?php 
App::import('Vendor','tcpdf/tcpdf');  
$tcpdf = new TCPDF(); 

$tcpdf->SetAuthor("Contracts"); 
$tcpdf->SetAutoPageBreak( false ); 

$tcpdf = new TCPDF('P', 'in', array(8.5,11), true, 'UTF-8', false);
$tcpdf->SetPrintHeader(false);
$tcpdf->SetPrintFooter(false);
$tcpdf->SetMargins(0.25, 0.25, 0.25);
$tcpdf->AddPage('P', array(8.5,11));

/***/
$img_file =  WWW_ROOT .'img/logo.png';
$tcpdf->Image($img_file, 0.3, '', '', '', '', '', '', true, 600, '', false, false, 0, '', '',true);

$html = ' 
        <p style="font-size: 18px; color: #cccccc;">INVOICE #2001 '.date('d-m-Y').'</p>  
        ';
        $tcpdf->writeHTMLCell(5, '', 0.3, 0.8, $html, 0, 0, false, false, '', true);
        
$html = ' 
        <p style="font-size: 10px; color: #adacac;">LegalForms.ae</p>  
        ';
        $tcpdf->writeHTMLCell('', '', 7.21, 0.3, $html, 0, 0, false, false, '', true);
$html = ' 
        <p style="font-size: 10px; color: #adacac;">Address, City</p>  
        ';
        $tcpdf->writeHTMLCell('', '', 7.31, 0.57, $html, 0, 0, false, false, '', true);
$html = ' 
        <p style="font-size: 10px; color: #adacac;">Country</p>  
        ';
        $tcpdf->writeHTMLCell('', '', 7.65, 0.84, $html, 0, 0, false, false, '', true);
        
$tbl1 = '    
    <table cellspacing="0" cellpadding="4px">        
        <tr>
            <td style="color: #37465d; height: 19px; background-color: #e7e7e7; width: 65%; font-size: 11px;"><b>Client Name '.$userDb['User']['first_name'].'</b></td>
            <td style="color: #37465d; height: 19px; background-color: #e7e7e7; width: 35%; font-size: 11px; text-align: right"><b>BALANCE DUE</b></td>
        </tr>
        <tr>
            <td style="color: #37465d; height: 19px; background-color: #e7e7e7; width: 65%; font-size: 11px;">Address '.$userDb['User']['address'].'</td>
            <td style="color: #37465d; height: 19px; background-color: #e7e7e7; width: 35%; font-size: 11px; text-align: right">Upon Receipt</td>
        </tr>
        <tr>
            <td style="color: #37465d; height: 19px; background-color: #e7e7e7; width: 65%; font-size: 11px;">City, State, Zip '.$userDb['User']['state'].' '.$userDb['User']['city'].' '.$userDb['User']['postal'].'</td>
            <td rowspan="2" style="color: #9dc02e; background-color: #e7e7e7; width: 35%; font-size: 24px; text-align: right">AED '.$price.'00</td>
        </tr>
        <tr>
            <td style="background-color: #e7e7e7; height: 19px; color: #37465d; width: 65%; font-size: 11px;">Country '.$userDb['User']['country'].'</td>
        </tr>
        <tr>
            <td style="height: 19px; background-color: #e7e7e7; width: 65%; color: #37465d; font-size: 11px;">Phone / Fax '.$userDb['User']['phone_number'].'</td>
            <td rowspan="2" style="height: 19px; background-color: #e7e7e7; width: 35%; color: #37465d; font-size: 11px; text-align: right"></td>
        </tr>
    </table><br><br><br>
    ';
$tcpdf->writeHTMLCell('', '', 0.3, 1.5, $tbl1, 0, 0, false, false, '', true);      

$tbody = '';
$total = 0;
foreach ($data as $key => $value) {
    $total+= $value['amount'];
    $tbody.= '
        <tr>
            <td style="color: #777; width: 74%; border: 1px solid #c2c2c2;">'.$value['name'].'</td>
            <td style="color: #777; width: 26%; text-align: center; border: 1px solid #c2c2c2;">AED '.$value['amount'].'</td>
        </tr>';
}

$tbl = '
    <table  cellspacing="0" cellpadding="10px">
        <thead>
            <tr>
                <th style="border: 1px solid #47566c; text-align: center; color: #ffffff; background-color: #47566c; width: 74%;">
                    Description
                </th> 
                <th style="border: 1px solid #47566c;  text-align: center; color: #ffffff; background-color: #47566c; width: 26%;">
                    Amount
                </th>
            </tr> 
        </thead>
        
        <tbody>
           '.$tbody.'
            <tr>
                <td style="color: #777; text-align: right; width: 74%; background-color: #e7e7e7; border-left: 1px solid #c2c2c2; border-bottom: 1px solid #c2c2c2"><b>Total:</b></td>
                
                <td style="width: 26%; color: #777; text-align: center; background-color: #e7e7e7; border-right: 1px solid #c2c2c2; border-bottom: 1px solid #c2c2c2;"><b>AED '.$total.'</b></td>
            </tr>
        </tbody>
    </table>';
$tcpdf->writeHTMLCell('', '', 0.3, 4.1, $tbl, 0, 0, false, false, '', true);

echo $tcpdf->Output('filen321321ame.pdf', 'I'); 
die;
?>