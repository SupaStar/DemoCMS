<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Phps/Pdf/fpdf.php" ;
include_once $_SERVER["DOCUMENT_ROOT"]."/Phps/dbConfig.php" ;
$id=$_GET["idC"];
$sql="Select * from pagina where idC=$id";
$datos=$cx->query($sql);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$linea=5;
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);
$header=["ID","Titulo","Url","idC"];
$w = array(40, 35, 40, 45);
for($i=0;$i<count($header);$i++){
    $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
}
$pdf->Ln();
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$fill = false;
while($r=$datos->fetch_array()){
    $id=$r["id"];
    $titulo=$r["titulo"];
    $url=$r["url"];
    $idC=$r["idC"];
    $pdf->Cell($w[0],6,$id,'LR',0,'L',$fill);
    $pdf->Cell($w[1],6,$titulo,'LR',0,'L',$fill);
    $pdf->Cell($w[2],6,$url,'LR',0,'L',$fill);
    $pdf->Cell($w[3],6,$idC,'LR',0,'L',$fill);
    $pdf->Ln();
    $fill = !$fill;
}
$pdf->Output();