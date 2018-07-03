<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Quotation</title>
</head>

<?php
    //Page header
    



//require_once('/xampp/htdocs/tcpdf/config/tcpdf_config.php');
require_once('C:\xampp\htdocs\E-Quotation\tcpdf\tcpdf.php');
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

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->Image('C:\xampp\htdocs\admin.png');

$pdf->SetCreator(PDF_CREATOR);

$tbl ='<h1><font align= "right">E-Quotation Management</font></h1>
			
        <div><font align= "right">Address:<br/>


 Hang Tuah Jaya,<BR/>76100 Durian Tunggal<BR/> Malacca, Malaysia</div>





        <div><font align= "right">Phone : +60 6-555 2000<BR/>
Fax : +606-331 6247 </div></font>
        <div><font align= "right"><a href="http://www.utem.edu.my/">http://www.utem.edu.my/</a></font></div>
		<div><font align= "right"><h4>Date : '.$_POST['date'].'</h4></font></div>
		
      </div>
		<hr>
      </div>
	   
       <h1>Vendor Information </h1>

	   <h4><font color="black">Information below are authentic. This record can be use as references only. </font></h4>
	   <BR/><BR/><BR/><BR/>
    <table> 
              </tr>
			<table width="510" height="60" border="0" class="easy_share" bgcolor="#FFF">
              <tr>
			 
			  <tr>
                <td width="219" height="10"><font color="black">Identification Number</font></td>
				<td width="30" height="10"><font color="black">:</font></td>
                <td width="281">'.$_POST['IC'].'</td>
              </tr>
			  <tr>
                <td width="219" height="10"><font color="black">Full Name</font></td>
				<td width="30" height="10"><font color="black">:</font></td>
                <td width="281">'.$_POST['name'].'</td>
              </tr>
			  
                <td width="219" height="10"><font color="black">Address </font></td>
				<td width="30" height="10"><font color="black">:</font></td>
                <td width="281">'.$_POST['bloodLevel'].'</td>
              </tr>
			  <tr>
                <td width="219" height="10"><font color="black">Handphone</font></td>
				<td width="30" height="10"><font color="black">:</font></td>
                <td width="281">'.$_POST['status'].'</td>
              </tr>
			  
			  <tr>
                <td width="219" height="10"><font color="black">Vendor Company</font></td>
				<td width="30" height="10"><font color="black">:</font></td>
                <td width="281">'.$_POST['suggest'].'</td>
              </tr>
			 
			  
			  
              
			 <br><br><br><br>
			  
			  
			  
            
          
          
           
      
        
</body>
</html>
         
';
$pdf->writeHTML($tbl, true, false, false, false, '');
ob_end_clean();
$pdf->Output('download.pdf', 'I');
?>
</body>
</body>
</html>