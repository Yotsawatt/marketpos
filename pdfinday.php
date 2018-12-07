<html>
<head>
<meta charset="utf-8">

</head>
<body>
<?php

require('fpdf/fpdf_thai.php');

$ordertime = $_GET['ordertime'];


class PDF extends FPDF
{
function Header(){

    global $timeset;
    $this->Cell(0,20,iconv( 'UTF-8','TIS-620','รายงานการขายสินค้าประจำวันที่ ').$timeset,0,1,"C");
    // $this->Cell(0,20,$timeset,1,1,"C");
}
//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}


//Simple table
function BasicTable($header,$data)
{
    
	//Header
	$w=array(15,40,50,25,20,25);
	//Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,iconv('UTF-8','TIS-620',$header[$i]),1,0,'C');
	$this->Ln();
	//Data
    $count = 1;
    $sum_number = 0;
    $sum_price = 0;
	foreach ($data as $eachResult) 
	{
		if($eachResult["product_name"] != "Reset_queue"){
            // $pdf->Cell(0,20,iconv( 'UTF-8','TIS-620','สวัสดีๆๆๆ'),0,1,"C");
		$this->Cell(15,7,iconv('UTF-8','TIS-620',$count++),1,0,'C');
        $this->Cell(40,7,iconv('UTF-8','TIS-620',$eachResult["product_category"]),1,0,'C');
        $this->Cell(50,7,iconv('UTF-8','TIS-620',$eachResult["product_name"]),1,0,'C');
        $this->Cell(25,7,iconv('UTF-8','TIS-620',$eachResult["product_number"]),1,0,'C');
        $this->Cell(20,7,iconv('UTF-8','TIS-620',$eachResult["product_price"]),1,0,'C');
        $this->Cell(25,7,iconv('UTF-8','TIS-620',$eachResult["product_total"]),1,0,'C');

        $this->Ln();
        $sum_number += $eachResult['product_number'];
        $sum_price += $eachResult['product_total']; 
        }
    }
    $this->Cell(105,7,iconv('UTF-8','TIS-620','สรุปรายการซื้อสินค้าทั้งหมด'),1,0,'C');
    $this->Cell(25,7,iconv('UTF-8','TIS-620',$sum_number),1,0,'C');
    $this->Cell(20,7,iconv('UTF-8','TIS-620',''),1,0,'C');
    $this->Cell(25,7,iconv('UTF-8','TIS-620',$sum_price),1,0,'C');

}

}

$pdf = new PDF();
//Column titles
$timeset = date('d-m-Y',strtotime($ordertime));

$header=array('ลำดับ','หมวดหมู่','รายการสินค้า','จำนวน','ราคา','ราคารวม');

//Data loading

//*** Load MySQL Data ***//
require("src/connect.php");
$strSQL = "SELECT *,SUM(product_number) AS product_number, SUM(product_totalprice) AS product_total
FROM orderall WHERE DATE(timeorder)='$ordertime' GROUP BY product_name ORDER BY product_category ASC";
$objQuery = mysqli_query($connect,$strSQL);
$resultData = array();
for ($i=0;$i<mysqli_num_rows($objQuery);$i++) {
	$result = mysqli_fetch_array($objQuery);
	array_push($resultData,$result);
}
//************************//

// define('FPDF_FONTPATH','font/');
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->SetFont('THSarabunNew','',14);

//*** Table 1 ***//
$pdf->SetMargins(15,5);
$pdf->AddPage('P','A4');
$pdf->BasicTable($header,$resultData);
$pdf->Output("MyPDF/report.pdf","F");


echo "<script>";
echo "window.location='MyPDF/report.pdf'";
// echo "window.open('MyPDF/report.pdf','_blank')";
echo "</script>";
echo "<script>";
// echo "window.location='qf20001.php'";
echo "</script>";
?>

</body>
</html>