<?php

try{
    $db= new PDO('mysql:host=localhost;dbname=lionel','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die($e->getMessage());
}

if(isset($_GET['client']) && $_GET['client'] != ''){
    require 'cell.php';
    $id_client= htmlspecialchars($_GET['client']);
    $req = $db->prepare('SELECT * FROM clients WHERE id_client= ?');
    $req->execute([$id_client]);
    $data=$req->fetch();
    $c_nom=$data['nom_client'];
    $c_pre=$data['prenom_client'];
    $c_civ=$data['civilite_client'];
    $c_adresse=$data['adresse_postal'];
    $c_zip=$data['code_postal'];
    $c_ville=$data['ville_client'];
    $c_info=$data['infos_complementaire'];
    $c_date=$data['date_creation'];
    


    $pdf = new CellPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','',9);
    $pdf->SetTextColor(0);
    $pdf->AliasNbPages();

// Header
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(185,10,'Fiche Client',1,0,'C');
$pdf->cell(30,10,'',1,0);
$pdf->Cell(60,5,$c_civ." ".$c_pre." ".$c_nom,1,1,'L');
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(30,10,'',1,0);
$pdf->Cell(60,5,$c_adresse,0,1,'C');
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(30,10,'',1,0);
$pdf->Cell(60,5,$c_zip.', '.$c_ville,0,1,'C');
$pdf->cell(125,10,'',0,0);
$pdf->cell(60,5,$c_info,0,0);
$pdf->Ln(10);

$nom_file="devis_".$c_nom.'_'.$c_pre.'_'.$c_date;
$pdf->Output('I', $nom_file);

}


?>