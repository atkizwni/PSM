<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<script>
function generatePdfA(){
   document.forms['getcsvpdf'].action = 'report_pdf.php';
   document.forms['getcsvpdf'].submit();
}
</script>
       <form name="getcsvpdf" action="report_csvA.php" method="POST"> 
         <input type="submit" name="submit" value="Download CSV file" class="input-button" />
          <input type="submit" name="submitpdf" value="Download pdf file" class="input-button"  onclick="generatePdfA();" />
      </form>
<body>
</body>
</html>