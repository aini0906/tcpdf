<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

class HtmlToPdfHelper
{
    function opinionPaper(Array $contents)
    {
        $essayTitle = '商品预归类申请表';
// create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle($essayTitle);
// set default header data
        $pdf->SetHeaderData('', '', '', '', '', array(255, 255, 255));
        $pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));
// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
        $pdf->SetFont('simfang', '', 12);
        $pdf->AddPage();
// Set title
        $pdf->Cell(0, 0, $essayTitle, 0, 1, 'C', 0, '', 0);
        $txt = '商品预归类申请表商品预归类申请表商品预归类申请表商品预归类申请表商品预归类申请表商品预归类申请表';
        $pdf->SetFont('simfang', '', 9);
        $high = $pdf->getNumLines($txt,30);
        $pdf->MultiCell(30, $high, $txt, 1, 'J', 0, 0, '10', '', true, 0, false, true, 0, 'M');
        $pdf->MultiCell(60, $high, $txt, 1, 'J', 0, 0, '40', '', true, 0, false, true, 0, 'M');
        $pdf->MultiCell(25, $high, $txt, 1, 'J', 0, 0, '100', '', true, 0, false, true, 0, 'M');
        $pdf->MultiCell(50, $high, $txt, 1, 'J', 0, 0, '125', '', true, 0, false, true, 0, 'M');



        $pdf->Output('example_001.pdf', 'I');
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------
//测试数据
$contents = array();
$test = new HtmlToPdfHelper();
$test->opinionPaper($contents);

