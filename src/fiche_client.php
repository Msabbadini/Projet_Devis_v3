<?php
try{
    $db= new PDO('mysql:host=localhost;dbname=lionel','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die($e->getMessage());
}

if(isset($_GET['client']) && $_GET['client'] != ''){

    require '../fpdf/fiche_client_cell.php';
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
    $c_tel_fixe=$data['telephone_fixe_client'];
    $c_tel_port=$data['telephone_portable_client'];
    $c_info=$data['infos_complementaire'];
    $c_date=$data['date_creation'];
    


    $pdf = new ClientCell('P','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','',9);
    $pdf->SetTextColor(0);
    $pdf->AliasNbPages();
    $pdf->setClient($c_nom,$c_pre);

// Header
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(0,10,'Fiche Rendez-vous Client',1,0,'C');
$pdf->Ln(20);
$pdf->cell(80,10,'Information du client ','B1',1,'C');
$pdf->Line(0,80,0,0);
$pdf->cell(10,10,'',0,0);
$pdf->Cell(60,10,$c_civ." ".$c_pre." ".$c_nom,0,1,'L');
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(10,5,'',0,0);
$pdf->Cell(60,5,$c_adresse,0,1,'L');
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(10,5,'',0,0);
$pdf->Cell(60,5,$c_zip.', '.$c_ville,0,1,'L');
$pdf->cell(10,5,'',0,0);
$pdf->cell(80,10,$c_info,0,1,'L');
$pdf->cell(10,5,'',0,0);
$pdf->SetFont('Helvetica','B',11);
$pdf->cell(80,10,$c_tel_fixe."  ".$c_tel_port,0,1,'L');
$pdf->Ln(5);
$pdf->cell(60,10,'Date du rendez vous:',0,0,'L');
$pdf->cell(50,10,'',1,1);
$pdf->Ln(2);
$pdf->cell(60,10,'Type de chantier :',0,0,'L');
$pdf->cell(50,10,'',1,1);
$pdf->Ln(2);
$pdf->cell(60,10,'Surface m'.utf8_decode('²').' :',0,0,'L');
$pdf->cell(50,10,'',1,1);
$pdf->Ln(10);
$pdf->cell(0,15,'Remplir ou cocher la case concern'.utf8_decode('é').'e','B1',1,'C');
$pdf->Ln(5);

$pdf->setFont('Helvetica','',11);
$pdf->cell(100,15,'D'.utf8_decode('é').'pose de tuiles',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de plaques PST',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de faitages',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de rives',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose d\'arretiers',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de noues',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose d\'avant-toit',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de sous-couche',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose d\'iso multi-reflecteur',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de laine de verre',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de chemin'.utf8_decode('é').'e',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de pannes',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de chevrons',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de liteaux',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de contrelattes',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de fermettes',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de solins',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose d\'abergements',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de velux',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de tabati'.utf8_decode('è').'res',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'D'.utf8_decode('é').'pose de goutti'.utf8_decode('è').'res',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'Mise en d'.utf8_decode('é').'charge de tous les d'.utf8_decode('é').'chets',1,0,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'',1,0,'R');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'90% charpente conserv'.utf8_decode('é').'e',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'Contr'.utf8_decode('ô').'le de la charpente',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'Balayage de la charpente',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(100,15,'Charpente : parties endommag'.utf8_decode('é').'es remplac'.utf8_decode('é').'es',1,0,'L');
$pdf->cell(30,15,'OUI',1,0,'C');
$pdf->cell(30,15,'NON',1,0,'C');
$pdf->cell(30,15,'',0,1);

$pdf->cell(130,15,'Pose de pannes en sapin trait'.utf8_decode('é').' section',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de chevrons en sapin trait'.utf8_decode('é').' section 5/7',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de chevrons en sapin trait'.utf8_decode('é').' section 7/7',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de chevrons en sapin trait'.utf8_decode('é').' section 7/11',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose d\'un ecran sous toiture de norme DTU agrafee sur chevrons',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose d\'un ecran sous toiture de norme DTU agrafee sur liteaux',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130, 15, "Pose d'Isolation isoreflecteur multi-couches 12 pro agraf".utf8_decode('é')."e sur chevrons", 1, 0, 'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Ecran sous toiture de norme DTU agrafee sur chevrons',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de laine de verre '.utf8_decode('é').'paisseur 200mm',1,0,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de contrelattes en sapin trait'.utf8_decode('é').' 27x40',1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de liteaux en sapin trait'.utf8_decode('é').' 27x40',1,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,'Pose de tuiles romanes collees en mastic 1 sur trois couleur au choix',1,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de plaques PST fix".utf8_decode('é')."es avec rondelles de goudrons d'".utf8_decode('é')."tanch".utf8_decode('é')."it".utf8_decode('é')."",1,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de tuiles canal rondes coll".utf8_decode('é')."e au mastic en couvert sur plaques couleur au choix",1,0,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de tuiles canal couverture ".utf8_decode('à')." la berg".utf8_decode('è')."re couleur au choix",1,0,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Ex".utf8_decode('é')."cution de faitages en tuiles canal b".utf8_decode('â')."ties au mortier de chaux",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Ex".utf8_decode('é')."cution de rives en tuiles canal",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de tuiles de rives ".utf8_decode('à')." rabat",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Ex".utf8_decode('é')."cution d'arretiers en tuiles cnala b".utf8_decode('â')."ties au mortier de chaux",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Ex".utf8_decode('é')."cution d'avant toit",1,0,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de closoirs en plomb ventil".utf8_decode('é')."s sur arr".utf8_decode('ê')."tiers + collage des ".utf8_decode('é')."tanch".utf8_decode('é')."it".utf8_decode('é')."s \n+ pose de tuiles canal emboitement coll".utf8_decode('é')."es sur closoirs + \nd".utf8_decode('é')."coupe de tuiles en biais sur longueur d'arr".utf8_decode('ê')."tiers",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de closoirs en plomb ventil".utf8_decode('é')."s sur faitages\n+ collages des ".utf8_decode('é')."tanch".utf8_decode('é')."it".utf8_decode('é')."s + pose de tuiles canal coll".utf8_decode('é')."es sur faitages",1,0,"L");
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de noues en inox + ".utf8_decode('é')."tanch".utf8_decode('é')."it".utf8_decode('é')."\nD".utf8_decode('é')."coupe de tuiles en biais en longueur de noues",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de solins en plomb sur baguettes avec joints d'".utf8_decode('é')."tanch".utf8_decode('é')."it".utf8_decode('é')." au mastic",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Ex".utf8_decode('é')."cution d'abergement de chemin".utf8_decode('é')."e (plomb ".utf8_decode('é')."paisseur 2mm)",1,0,'L');
$pdf->cell(30,15,'M2',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de goutti".utf8_decode('è')."res PVC + tubes de descentes + naissances,\ncrochets, coudes et accessoires",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$pdf->cell(130,15,"Pose de goutti".utf8_decode('è')."res ZINC , tubes de descentes + naissances,\ncrochets, coudes et accessoires",1,0,'L');
$pdf->cell(30,15,'ML',1,0,'R');
$pdf->cell(30,15,'HT',1,1,'R');

$nom_file="rdv_".$c_nom.'_'.$c_pre.'_'.$c_date;
$pdf->Output('I', $nom_file);

}


?>