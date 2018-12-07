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

    $this->Cell(0,20,iconv( 'UTF-8','TIS-620','รายงานการขายสินค้าประจำวันที่ '),0,1,"C");
    // $this->Cell(0,20,$timeset,1,1,"C");
}

//Simple table
function BasicTable()
{
    require('src/connect.php');

    $sqlcatagory = "SELECT product_category FROM orderall GROUP BY product_category  ";
    $categoryquery = $connect->query($sqlcatagory);
    $sum_priceall = 0;
    $sum_numberall = 0;
    while($cate = $categoryquery->fetch_array()){

        $catehead = $cate["product_category"];


        $sqlshow = "SELECT *,SUM(product_number) AS product_number, SUM(product_totalprice) AS product_total,SUM(discount) AS discount
        FROM orderall WHERE DATE(timeorder)='$ordertime' AND product_category='$catehead' GROUP BY product_name";
        $showquery = $connect->query($sqlshow);
        $count = 1;
        $sum_number = 0;
        $sum_price = 0;
        while($row = $showquery->fetch_array()){
            if($row["order_code"] != ''){

                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$count++),1,0,'C');
                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$row['product_category']),1,0,'C');
                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$row['product_name']),1,0,'C');
                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$row['product_number']),1,0,'C');
                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$row['discount']),1,0,'C');
                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$row['product_price']),1,0,'C');
                    $this->Cell(15,7,iconv('UTF-8','TIS-620',$row['product_total']),1,0,'C');
                    $sum_number += $row['product_number'];
                    $sum_numberall += $row['product_number'];
                    $sum_price += $row['product_total'];
                    $sum_priceall += $row['product_total'];  
                    
            }
        }
        $this->Cell(15,7,iconv('UTF-8','TIS-620','สรุปรายการทั้งหมด'),1,0,'C');
        $this->Cell(15,7,iconv('UTF-8','TIS-620',$sum_number),1,0,'C');
        $this->Cell(15,7,iconv('UTF-8','TIS-620',$sum_price),1,0,'C');
    }
    echo "<tr>";
    echo "<td colspan='3'><p class='text-sum right-align'>รวมทั้งหมด</p></td>";
    echo "<td><span class='text-sum'>".$sum_numberall."</span></td>";
    echo "<td colspan='2'></td>";
    echo "<td ><span class='text-sum'>".$sum_priceall."</span></td>";
    // echo "<td></td>";
    echo "</tr>";
	
    $this->Cell(105,7,iconv('UTF-8','TIS-620','สรุปรายการซื้อสินค้าทั้งหมด'),1,0,'C');
    $this->Cell(25,7,iconv('UTF-8','TIS-620',$sum_number),1,0,'C');
    $this->Cell(20,7,iconv('UTF-8','TIS-620',''),1,0,'C');
    $this->Cell(25,7,iconv('UTF-8','TIS-620',$sum_price),1,0,'C');

}

}

$pdf = new PDF();



// define('FPDF_FONTPATH','font/');
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->SetFont('THSarabunNew','',14);

//*** Table 1 ***//
$pdf->SetMargins(15,5);
$pdf->AddPage('P','A4');
$pdf->BasicTable();
$pdf->Output("MyPDF/report.pdf","F");
// $pdf->Output("MyPDF/report.pdf","F");


echo "<script>";
// echo "window.location='MyPDF/report.pdf'";
echo "window.open('MyPDF/report.pdf','_blank')";
echo "</script>";
echo "<script>";
// echo "window.location='qf20001.php'";
echo "</script>";
?>

</body>
</html>