<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
//require_once('/xampp/htdocs/tcpdf/config/tcpdf_config.php');
require_once('/xampp/htdocs/tcpdf/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
//$pdf->setLanguageArray($l);
// set document information
// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'ajimlala', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$pdf->SetCreator(PDF_CREATOR);
$tbl = '
<table cellspacing="0" cellpadding="1" border="0">
<thead>
<tr>
      <th scope="col" width=35% style="text-align:left" >Type of Activity </th>
      <th scope="col"  style="text-align:left" >Number of Activity</th>
    
       
</tr> 
</thead>
<tr>
 <td> </td>  <td> </td>  <td> </td>
 <td> S</td>  <td>P </td>  <td>R</td> <td>MS</td>  <td>N</td>  <td>AHP</td>
 </tr>

 <tr><td>Simulators - High Fidelity</td><td>a</td><td>a</td><td>a</td>
<td>a</td><td>a</td>
<td>a</td><td>a</td>
<td>a</td>
    </tr>
  
</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');
ob_end_clean();
$pdf->Output('activity_log_for_acs.pdf', 'I');
?>
<body>
</body>
</html>