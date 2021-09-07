<?php
include '../../Connections/RootSistemas_Conexion_masterWeb.php';
/**
 * MUNICIPALIDAD DE BABAHOYO
 * @package /urbanismo
 * @abstract TCPDF - certificados
 * @author MUNICIPALIDAD DE BABAHOYO
 * @since 2016-05-01
 */
/**************************************************************/
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
if (!isset($_GET['Doc'])) {
	header('Location: ../../index.php');
}
$idDoc=$_GET['Doc'];
$_SESSION['iddd']=$idDoc;
/**************************************************************/
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//$//numeroMes = date("m")-1;

$Data_Base=mysql_query("SELECT 	bbh_id_cert_lin_fab, 
								bbh_num_ofic_fab, 
								bbh_solicitante_fab, 
								bbh_zona_fab, 
								bbh_parroquia_fab, 
								bbh_calle_fab, 
								bbh_interseccion_fab, 
								bbh_barrio_urbanizacion_fab, 
								bbh_clave_catastral_fab, 
								bbh_superficie_fab, 
								bbh_manzana_fab, 
								bbh_lote_fab, 
								bbh_frente_fab, 
								bbh_imagen_croquis_fab, 
								bbh_tipo_img_fab, 
								bbh_usuario_id_fab, 
								bbh_fecha_fab, 
								bbh_hota_fab, 
								bbh_zonif_id, 
								bbh_calle_fab_md, 
								bbh_interseccion_fab_md, 
								bbh_agua, 
								bbh_electricida, 
								bbh_calzada, 
								bbh_bordillos, 
								bbh_alcantarillado, 
								bbh_telefono, 
								bbh_aceras, 
								bbh_relleno,
								bbh_zonificacion.bbh_nomenclatura_zon
								FROM 
								bbh_certificado_lin_fab, bbh_zonificacion
								WHERE bbh_zonificacion.bbh_id_zonificacion=bbh_certificado_lin_fab.bbh_zonif_id
								AND bbh_id_cert_lin_fab=$idDoc")or die(mysql_error());

$GetData=mysql_fetch_assoc($Data_Base);
setlocale(LC_ALL, 'es-ES');
$date=$GetData['bbh_fecha_fab'];
$f = explode('-', $date);
$f0=$f[0];
$f1=$f[1]-1;
$f2=$f[2];
$fecha='Babahoyo, '.$f2.' '.$mes[$f1].' '.$f0; 
$fecha2=$f2.' de '.$mes[$f1].' del '.$f0; 

$ids=$GetData['bbh_id_cert_lin_fab'];
$num_dcl_ph=$GetData['bbh_num_ofic_fab'];
$solicitante=strtoupper($GetData['bbh_solicitante_fab']);
$Parroquia=$GetData['bbh_parroquia_fab'];
$calle=$GetData['bbh_calle_fab'];
$bbh_calle_fab_md=$GetData['bbh_calle_fab_md'];
$Interseccion=$GetData['bbh_interseccion_fab'];
$bbh_interseccion_fab_md=$GetData['bbh_interseccion_fab_md'];
$barrioUrbanizacion=$GetData['bbh_barrio_urbanizacion_fab'];
$clave=$GetData['bbh_clave_catastral_fab'];
$manzana=$GetData['bbh_manzana_fab'];
$lote=$GetData['bbh_lote_fab'];
$superficie=$GetData['bbh_superficie_fab'];
$frente=$GetData['bbh_frente_fab'];
$solar=$GetData['bbh_frente_fab'];
$Selec=$GetData['bbh_nomenclatura_zon'];
$imagen=$GetData['bbh_tipo_img_fab'];

$agua='';
$agua1='';
$calzada='';
$calzada1='';
$electricidad='';
$electricidad1='';
$bordillos='';
$bordillos1='';
$alcantarillado='';
$alcantarillado1='';
$aceras='';
$aceras1='';
$telefono='';
$telefono1='';
$relleno='';
$relleno1='';

$serv1=$GetData['bbh_agua'];
if ($serv1=='on') {
	$agua='X';
}else{
	$agua1='X';
}

$serv2=$GetData['bbh_electricida'];
if ($serv2=='on') {
	$electricidad='X';
}else{
	$electricidad1='X';
}

$serv3=$GetData['bbh_calzada'];
if ($serv3=='on') {
	$calzada='X';
}else{
	$calzada1='X';
}

$serv4=$GetData['bbh_bordillos'];
if ($serv4=='on') {
	$bordillos='X';
}else{
	$bordillos1='X';
}

$serv5=$GetData['bbh_alcantarillado'];
if ($serv5=='on') {
	$alcantarillado='X';
}else{
	$alcantarillado1='X';
}

$serv6=$GetData['bbh_telefono'];
if ($serv6=='on') {
	$telefono='X';
}else{
	$telefono1='X';
}

$serv7=$GetData['bbh_aceras'];
if ($serv7=='on') {
	$aceras='X';
}else{
	$aceras1='X';
}

$serv8=$GetData['bbh_relleno'];
if ($serv8=='on') {
	$relleno='X';
}else{
	$relleno1='X';
}


/**************************************************************/


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Municipalidad Babahoyo');
$pdf->SetTitle('DTGT 2016');
$pdf->SetSubject('DTGT 2016');
$pdf->SetKeywords('DTGT 2016');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea
$pdf->setPrintFooter(false); //no imprime el pie ni la linea 
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//	require_once(dirname(__FILE__).'/lang/eng.php');
//	$pdf->setLanguageArray($l);
//}

// ---------------------------------------------------------



//$serie=$GETEntrega['serie'];
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$numeroMes = date("m")-1;

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write(10, 'CERTIFICADO DE LINEA DE FÁBRICA', '', 0, 'L', true, 0, false, false, 0);


$pdf->SetFont('dejavusans', '', 12);
$html = '

Señor:<br>
DIRECTOR TECNICO DE GESTION DEL TERRITORIO.<br><br>
Yo, '.$solicitante.'.<br>

Solicito se me confiera el CERTIFICADO DE LINEA DE FÁBRICA, correspondiente a mí:

<br><br>
Propiedad Ubicada en:<br>
<table width="100%" border="0">
<tr>
<td width="35%"><b>Zona:</b></td>
<td>BABAHOYO</td>
<td></td>

</tr>
<tr>
<td width="35%"><b>Parroquia:</b></td>
<td colspan = "2">'.$Parroquia.'</td>

</tr>
<tr>
<td width="35%"><b>Calle:</b></td>
<td>'.$calle.'</td>
<td></td>
</tr>
<tr>
<td width="35%"><b>Intersección Calle:</b></td>
<td>'.$Interseccion.'</td>
<td><b>Manzana No. </b>'.$manzana.'</td>
</tr>
<tr>
<td width="35%"><b>Barrio o Urbanización:</b></td>
<td>'.$barrioUrbanizacion.'</td>
<td><b>Lote No: </b>'.$lote.'</td>
</tr>
<tr>
<td width="35%"><b>Clave Catastral:</b></td>
<td>'.$clave.'</td>
<td></td>
</tr>
<tr>
<td width="35%"><b>Superficie:</b> '.$superficie.'</td>
<td><b>Frente: </b>'.$frente.' ml</td>
<td></td>
</tr>
<tr>
<td width="35%"></td>
<td></td>
<td></td>
</tr>

<tr>
<td width="35%"></td>
<td>CROQUIS DE UBICACIÓN</td>
<td></td>
</tr>
<tr>
<td width="35%"></td>
<td></td>
<td></td>
</tr>
</table>

<img src="../'.$imagen.'" width="900px" height="340px">

';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', '', 7); 
$html1="<b>CROQUIS: </b>Ubicar el predio con referencias claras de calles y edificios existentes en los alrededores de la propiedad. No es necesario. Usar escala y puede dibujarse a mano alzada.";
$pdf->writeHTML($html1, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 8);

$html1='<br><br><br><br><br>
<table width="100%" border="0">
	<tr>
		
		<td>______________________________________</td>
		
	</tr>
	<tr>
		
		<td>RESPONSABLE TECNICO</td>
		
	</tr>
</table>
<br>
';
$pdf->writeHTML($html1, true, false, true, false, 'C');


$pdf->SetFont('dejavusans', '', 8);

$html1='<br><br>
<table width="100%" border="0">
	<tr>
		<td width="10%"><b>NOTAS: </b></td>
		<td width="90%">1. Los Datos de superficie, frente y linderos deben estar de acuerdo a las escrituras del predio.</td>
	</tr>
	<tr>
		<td></td>
		<td>2. Datos erróneos o dolosos causarán la anulación del presente trámite.</td>
	</tr>
</table>
';
$pdf->writeHTML($html1, true, false, true, false, 'J');
// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
// add a page
$pdf->AddPage();

$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write(8, 'PLAN REGULADOR', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('dejavusans', '', 12);

$html0 = '
'.$num_dcl_ph.' <br>
Fecha: '.$fecha.'<br><br>
Señor:<br>
DIRECTOR TECNICO DE GESTION DEL TERRITORIO.<br><br>
Yo, '.$solicitante.'.<br><br>

Solicito se me confiera el CERTIFICADO DE PLAN REGULADOR, correspondiente a mi.

<br><br>
<table width="100%" border="0">
<tr>
<td colspan="3" width="100%"> Propiedad ubicada en:</td>

</tr>
<tr>
<td width="35%"><b>Zona:</b></td>
<td>BABAHOYO</td>
<td></td>
</tr>

<tr>
<td width="35%"><b>Parroquia:</b></td>
<td>'.$Parroquia.'</td>
<td></td>
</tr>

<tr>
<td width="35%"><b>Calle:</b></td>
<td>'.$calle.'</td>
<td></td>
</tr>
<tr>
<td width="35%"><b>Intersección Calle:</b></td>
<td>'.$Interseccion.'</td>
<td><b>Manzana No. </b>'.$manzana.'</td>
</tr>
<tr>
<td width="35%"><b>Barrio o Urbanización:</b></td>
<td>'.$barrioUrbanizacion.'</td>
<td><b>Solar No: </b>'.$lote.'</td>
</tr>
<tr>
<td width="35%"><b>Clave Catastral:</b></td>
<td>'.$clave.'</td>
<td></td>
</tr>
</table>
<br>

';

// output the HTML content
$pdf->writeHTML($html0, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Write(8, 'CERTIFICADO DE PLAN REGULADOR', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('dejavusans', '', 11);
$html2='
<table width="100%" border="1">
<tr>
<td>
<br><br>
&nbsp;&nbsp;
<!--***********************************************************-->
<table width="98%" border="">
<tr>
<td>

<table width="100%" border="">

<tr>
<td>'.$num_dcl_ph.'</td>

<td></td>
</tr>
<tr>
<td>FECHA .'.$fecha2.'</td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td> SI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NO: &nbsp;&nbsp;&nbsp; <b>X</b>                    </td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2">Se encuentra afectado el predio en mención por el PLAN REGULADOR de Desarrollo Urbano De Babahoyo.</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
<tr>
<td colspan="2">............................................................................................................................</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUPERVISOR</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIRECTOR</td>
</tr>

</table>
</td>
</tr>
</table>
<!--***********************************************************-->
&nbsp;&nbsp;
</td>
</tr>
</table>
';

$pdf->writeHTML($html2, true, false, true, false, 'J');
$pdf->SetFont('dejavusans', '', 7); 
$html1="<b>NOTA: </b>Este documento tiene validez de UN AÑO y no autoriza la ejecución de ningún trabajo. Cualquier alteración o enmendadura lo Anulará; no significa título legal alguno que pueda hacerse valer contrra terceros ni que vaya en su contra.";
$pdf->writeHTML($html1, true, false, true, false, 'J');

// add a page
$pdf->AddPage();


$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('dejavusans', '', 8); 
$html11='
<table width="100%" border="0">
<tr>
<td><b>Informe No:</b> '.$num_dcl_ph.'</td>
<td><b>Clave Catastral #</b> 06-10-044-52</td>
<td><b>Fecha: </b> '.$fecha.'</td>
</tr>
<tr>
<td><b>ZONIFICACION</b></td>
<td></td>
<td></td>
</tr>
</table>
';

$pdf->writeHTML($html11, true, false, true, false, 'J');

/****************************************VBB**********************************************************/

$z0='
<table width="100%" border="1">
<tr>
<td>CÓDIGO V.B.B DENSIDAD BRUTA.....180...(H/Ha)</td>
<td>DENSIDAD NETA....300....(H/Ha)</td>
</tr>

</table>
';

$z1='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE POR UNIDAD..................................167..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................100..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE..........................................................6.00.................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................50..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S...................................120..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA DE PISOS........................................3</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2">RETIROS FRONTAL .......2.5............M1.</td>
</tr>

<tr>
<td colspan="2">LATERAL.....................0.00.........M1&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  POSTERIOR..............0.00.....M1.</td>
</tr>

<tr>
<td colspan="2">LATERAL.....................0.00.........M2</td>
</tr>



<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN.............1.20.M</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ALTURA DESDE NIVEL DE ACERA A 1er ALTO.................................3.50.M</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; AIRE Y LUZ</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; LOCAL HABITABLE: MIN......................................12.00..M2(POZO DE LUZ)</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>LOCAL NO HABITABLE y ESPECIELES: MIN........1.00..M2</b></td>
</tr>

<tr>
<td colspan="2"><b>VANOS O VENTANAS EN ADOSAMIENTO:................NO</b></td>
</tr>

<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO</td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI  &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; <b>X</b></td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI  &nbsp; &nbsp; NO &nbsp;  <b>X</b></td>
</tr>

<tr>
<td colspan="3">
<b>USOS PERMITIDOS.......</b> VIVIENDA UNIFAMILIAR Y BIFAMILIAR PAREADA
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';


/****************************************VBB**********************************************************/

/****************************************CUV**********************************************************/

$z2='
<table width="100%" border="1">
<tr>
<td>CÓDIGO C.U.V DENSIDAD BRUTA.....350...(H/Ha)</td>
<td>DENSIDAD NETA....583....(H/Ha)</td>
</tr>
</table>
';

$z3='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA....................................85..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................255..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE..........................................................9.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................65..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S...................................200..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA DE PISOS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   VARIABLE............</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL ........................0.00.........M1.</td>
<td>LATERAL ....................0.00.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................1.50.........M1.</td>
<td>LATERAL.....................1.50.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................2.50.........M1.</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............1.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................12.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN........1.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO</td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; </td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI  <b>X</b> &nbsp; &nbsp; NO &nbsp;  </td>
</tr>

<tr>
<td colspan="3">
<b>USOS PERMITIDOS.......</b> COMERCIO URBANO Y VIVIENDA MULTIFAMILIAR
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************CUV**********************************************************/


/****************************************CZV**********************************************************/

$z4='
<table width="100%" border="1">
<tr>
<td>CÓDIGO C.Z.V DENSIDAD BRUTA.....250...(H/Ha)</td>
<td>DENSIDAD NETA....417....(H/Ha)</td>
</tr>

</table>
';

$z5='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA.................................120..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................240..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE..........................................................9.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................60..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S...................................200..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   VARIABLE............</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL ........................0.00.........M1.</td>
<td>LATERAL ....................0.00.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................2.50.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............1.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........0.00.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................12.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN........1.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO</td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; </td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI   &nbsp; &nbsp; NO &nbsp;  <b>X</b></td>
</tr>

<tr>
<td colspan="3">
<b>USOS PERMITIDOS.......</b> COMERCIO URBANO Y VIVIENDA MULTIFAMILIAR
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************CZV**********************************************************/


/****************************************VUA**********************************************************/

$z6='
<table width="100%" border="1">
<tr>
<td>CÓDIGO V.U.A DENSIDAD BRUTA.....200...(H/Ha)</td>
<td>DENSIDAD NETA....333....(H/Ha)</td>
</tr>

</table>
';

$z7='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA.................................150..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................150..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE..........................................................6.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................50..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S...................................100..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................2</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL ........................0.00.........M1.</td>
<td>LATERAL ....................0.00.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........0.00.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................12.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN........1.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO</td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; </td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI  <b>X</b> &nbsp; &nbsp; NO &nbsp;  </td>
</tr>

<tr>
<td colspan="3">
<b>USOS PERMITIDOS.......</b> COMERCIO URBANO Y VIVIENDA MULTIFAMILIAR
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************VUA**********************************************************/


/****************************************VUC**********************************************************/

$z8='
<table width="100%" border="1">
<tr>
<td>CÓDIGO V.U.C. DENSIDAD BRUTA.....150...(H/Ha)</td>
<td>DENSIDAD NETA....250....(H/Ha)</td>
</tr>

</table>
';

$z9='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA..................................200..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................200..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE..........................................................7.50..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................50..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S...................................80...................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................3</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL ........................3.00.........M1.</td>
<td>LATERAL ....................1.50.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........1.20.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................12.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN........1.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO</td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI <b>X</b> &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; </td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI  <b>X</b> &nbsp; &nbsp; NO &nbsp;  </td>
</tr>

<tr>
<td>
<b>USOS PERMITIDOS.</b></td>
<td colspan="2"> _VIVIENDA UNIFAMILIAR PAREADA. <br> _EsSTABLECIMIENTOS DE EQUIPAMIENTOS COMUNITARIOS DE CARACTER LOCAL, EDUCACIONALES, DE SALUD, CULTURALES, RELIGIOSO, RECREACIONALES. ETC. <br> _INSTALACIONES DE UTILIDAD PÚBLICA.
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************VUC**********************************************************/



/****************************************VUE**********************************************************/


$z10='
<table width="100%" border="1">
<tr>
<td>CÓDIGO V.U.E. DENSIDAD BRUTA...80...(H/Ha)</td>
<td>DENSIDAD NETA....133....(H/Ha)</td>
</tr>

</table>
';

$z11='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA..................................375..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................375..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE.......................................................12.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................35..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S..................................100...................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................3</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL ........................5.00.........M1.</td>
<td>LATERAL ....................1.50.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................1.50.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........1.20.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................12.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN..............1.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI  &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp;  <b>X</b></td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI  &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; <b>X</b></td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI  <b>X</b> &nbsp; &nbsp; NO &nbsp;  </td>
</tr>

<tr>
<td>
<b>USOS PERMITIDOS.</b></td>
<td colspan="2"> VIVIENDA UNIFAMILIAR AISLADA
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************VUE**********************************************************/

/****************************************VUD**********************************************************/


$z12='
<table width="100%" border="1">
<tr>
<td>CÓDIGO V.U.D. DENSIDAD BRUTA...100...(H/Ha)</td>
<td>DENSIDAD NETA....167....(H/Ha)</td>
</tr>

</table>
';

$z13='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA..................................300..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO............................................................300..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE.......................................................9.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................40..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S..................................100...................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................3</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL ........................3.00.........M1.</td>
<td>LATERAL ....................1.50.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........1.20.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................12.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN..............1.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="2"><b>ADOSAMIENTOS</b></td>
</tr>

</table>

<table width="100%" border="1">
<tr>
<td><b>LATERAL</b> &nbsp; &nbsp; &nbsp; SI  &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp;  <b>X</b></td>
<td><b>LATERAL</b> &nbsp; &nbsp;  SI  &nbsp; &nbsp; &nbsp; &nbsp; NO &nbsp; <b>X</b></td>
<td><b>POSTERIOR</b> &nbsp; &nbsp;  SI  <b>X</b> &nbsp; &nbsp; NO &nbsp;  </td>
</tr>

<tr>
<td>
<b>USOS PERMITIDOS.</b></td>
<td colspan="2"> VIVIENDA UNIFAMILIAR AISLADA
</td>
</tr>

<tr>
<td colspan="3"></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************VUD**********************************************************/


/****************************************I**********************************************************/


$z14='
<table width="100%" border="1">
<tr>
<td>CÓDIGO I. DENSIDAD BRUTA.........(H/Ha)</td>
<td>DENSIDAD NETA...........(H/Ha)</td>
</tr>

</table>
';

$z15='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA.......................................................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO...........................................................1000..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE......................................................20.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................40..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S...................................60...................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................2</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL .......................10.00.........M1.</td>
<td>LATERAL ....................5.00.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........0.00.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>



<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................0.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN..............0.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************I**********************************************************/

/****************************************CE*********************************************************/


$z16='
<table width="100%" border="1">
<tr>
<td>CÓDIGO C.E. DENSIDAD BRUTA.........(H/Ha)</td>
<td>DENSIDAD NETA...........(H/Ha)</td>
</tr>

</table>
';

$z17='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA.......................................................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO...........................................................500..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE......................................................12.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................40..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S..................................160...................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................5</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL .......................10.00.........M1.</td>
<td>LATERAL ....................3.00.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................5.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........0.00.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................0.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN..............0.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>




<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************CE**********************************************************/

/****************************************PN*********************************************************/


$z18='
<table width="100%" border="1">
<tr>
<td>CÓDIGO P.N. DENSIDAD BRUTA.........(H/Ha)</td>
<td>DENSIDAD NETA...........(H/Ha)</td>
</tr>

</table>
';

$z19='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA.......................................................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO.........................................................10000..................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE......................................................40.00..................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................0..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S..................................0...................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ........................</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL .....................................M1.</td>
<td>LATERAL .................................M1.</td>
</tr>

<tr>
<td>POSTERIOR..................................M1.</td>
<td>LATERAL..................................M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........0.00.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.0.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................0.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN..............0.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************PN**********************************************************/



/****************************************S*********************************************************/


$z20='
<table width="100%" border="1">
<tr>
<td>CÓDIGO S. DENSIDAD BRUTA.........(H/Ha)</td>
<td>DENSIDAD NETA...........(H/Ha)</td>
</tr>

</table>
';

$z21='
<table width="100%" border="1">
<tr>
<td colspan="2"><b>CARACTERISTICAS BASICAS DEL SECTOR URBANO</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE MINIMA POR UNIDAD DE VIVIENDA.......................................................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; SUPERFICIE DEL LOTE MINIMO................................................................................M2.</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; LONGITUD MINIMA DEL FRENTE.............................................................................M1.</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2"><b>INDICES DE OCUPACION</b></td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE OCUPACION DEL SUELO, C.O.S......................................20..................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; COEFICIENTE DE UTILIZACION DEL SUELO, C.U.S..................................40....................%</td>
</tr>

<tr>
<td colspan="2">&nbsp; &nbsp; ALTURA MAXIMA (PISOS) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; .......................3</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>RETIROS</b></td>
<td></td>
</tr>

<tr>
<td>FRONTAL .......................10.00.........M1.</td>
<td>LATERAL ....................5.00.........M1.</td>
</tr>

<tr>
<td>POSTERIOR.....................10.00.........M1.</td>
<td>LATERAL.....................0.00.........M1.</td>
</tr>

<tr>
<td colspan="2">SOPORTAL......................0.00.........M1 o de acuerdo al sector...</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE FRABRICA.............0.00.M</td>
</tr>

<tr>
<td colspan="2">VOLADOS PERMITIDOS SOBRE LINEA DE CONSTRUCCIÓN...........0.00.M</td>
</tr>

<tr>
<td colspan="2">ALTURA DESDE NIVEL DE ACERA A 1er ALTO.......................3.50.M</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td><b>AIRE Y LUZ</b></td>
<td></td>
</tr>

<tr>
<td colspan="2">LOCAL HABITABLE: MIN...........................................0.00..M2 (POZO DE LUZ)</td>
</tr>

<tr>
<td colspan="2">LOCAL NO HABITABLE y ESPECIELES: MIN..............0.00..M2</td>
</tr>

<tr>
<td colspan="2">VANOS O VENTANAS EN ADOSAMIENTO:................NO</td>
</tr>

<tr>
<td></td>
<td></td>
</tr>


<tr>
<td colspan="3">TIPO DE EDIFICACION</td>
</tr>

<tr>
<td>ESTRUCTURA:</td>
<td colspan="2">HORMIGÓN ARMADO</td>
</tr>

<tr>
<td>PISOS:</td>
<td colspan="2">LOSA-MADERA</td>
</tr>

<tr>
<td>PAREDES:</td>
<td colspan="2">MAMPOSTERIA</td>
</tr>

<tr>
<td>CUBIERTA:</td>
<td colspan="2">LOSA-ETERNIT</td>
</tr>

<tr>
<td>PAREDES MEDIANERAS:</td>
<td colspan="2">INCOMBUSTIBLES E INDEPENDIENTES</td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
</tr>
</table>
';

/****************************************S**********************************************************/


$pdf->SetFont('dejavusans', '', 8);

//**************************head page 2***********************///
if ($Selec=='VBB') {
$pdf->writeHTML($z0, true, false, true, false, 'J'); // vbb
}elseif ($Selec=='CUV') {
$pdf->writeHTML($z2, true, false, true, false, 'J'); // cuv
}elseif ($Selec=='CZV') {
$pdf->writeHTML($z4, true, false, true, false, 'J'); // CZV
}elseif ($Selec=='VUA') {
$pdf->writeHTML($z6, true, false, true, false, 'J'); //VUA
}elseif($Selec=='VUC'){
$pdf->writeHTML($z8, true, false, true, false, 'J'); //VUC
}elseif ($Selec=='VUE') {
$pdf->writeHTML($z10, true, false, true, false, 'J'); //VUE
}elseif ($Selec=='VUD') {
$pdf->writeHTML($z12, true, false, true, false, 'J'); //VUD
}elseif ($Selec=='I') {
$pdf->writeHTML($z14, true, false, true, false, 'J'); //VUD
}
elseif ($Selec=='CE') {
$pdf->writeHTML($z16, true, false, true, false, 'J'); //VUD
}
elseif ($Selec=='PN') {
$pdf->writeHTML($z18, true, false, true, false, 'J'); //VUD
}
elseif ($Selec=='S') {
$pdf->writeHTML($z20, true, false, true, false, 'J'); //VUD
}
//**************************head page 2***********************///



$pdf->SetFont('dejavusans', '', 9);
//**************************body page 2***********************///
if ($Selec=='VBB') {
$pdf->writeHTML($z1, true, false, true, false, 'J'); //vbb
}elseif ($Selec=='CUV') {
$pdf->writeHTML($z3, true, false, true, false, 'J'); //cuv
}elseif ($Selec=='CZV') {
$pdf->writeHTML($z5, true, false, true, false, 'J'); //CZV
}elseif ($Selec=='VUA') {
$pdf->writeHTML($z7, true, false, true, false, 'J'); //VUA
}elseif($Selec=='VUC'){
$pdf->writeHTML($z9, true, false, true, false, 'J'); //VUC
}elseif ($Selec=='VUE') {
$pdf->writeHTML($z11, true, false, true, false, 'J'); //VUE 
}elseif ($Selec=='VUD') {
$pdf->writeHTML($z13, true, false, true, false, 'J'); //VUE 
}elseif ($Selec=='I') {
$pdf->writeHTML($z15, true, false, true, false, 'J'); //VUE 
}elseif ($Selec=='CE') {
$pdf->writeHTML($z17, true, false, true, false, 'J'); //VUE 
}elseif ($Selec=='PN') {
$pdf->writeHTML($z19, true, false, true, false, 'J'); //VUE 
}elseif ($Selec=='S') {
$pdf->writeHTML($z21, true, false, true, false, 'J'); //VUE 
}

//**************************body page 2***********************///


/******************************NOTAS************************************/
$pdf->SetFont('dejavusans', '', 7);

$Nota1='
<table width="100%">
<tr>
<td>
<b>NOTA:</b> Este Documento tiene validez de 180 días y no autoriza la ejecución de ningún trabajo. Cualquier alteración o enmendadura lo Anulará; no significa título legal alguno que pueda hacerse valor contra terceros ni que valla en su contra.
</td>
</tr>
</table>
';
//$pdf->writeHTML($Nota1, true, false, true, false, 'J');

$Nota2="<b>NOTA: </b>Este documento tiene validez de UN AÑO y no autoriza la ejecución de ningún trabajo. Cualquier alteración o enmendadura lo Anulará; no significa título legal alguno que pueda hacerse valer contrra terceros ni que vaya en su contra.";
//$pdf->writeHTML($Nota2, true, false, true, false, 'J');


/*********************************Servicios**************************************/
$dts='<br><br><b>DISPONIBILIDAD DE SERVICIOS</b>';
$pdf->writeHTML($dts, true, false, true, false, 'J');
$tServ='
<table width="100%">
<tr>
<td></td>
<td></td>
<td>SI</td>
<td>NO</td>
<td></td>
<td>SI</td>
<td>NO</td>
<td></td>
</tr>

<tr>
<td>Agua Potable</td>
<td></td>
<td border="1">'.$agua.'</td>
<td border="1">'.$agua1.'</td>
<td>Calzada</td>
<td border="1">'.$calzada.'</td>
<td border="1">'.$calzada1.'</td>
<td></td>
</tr>

<tr>
<td>Electricidad</td>
<td></td>
<td border="1">'.$electricidad.'</td>
<td border="1">'.$electricidad1.'</td>
<td>Bordillos</td>
<td border="1">'.$bordillos.'</td>
<td border="1">'.$bordillos1.'</td>
<td></td>
</tr>

<tr>
<td>Alcantarillado</td>
<td></td>
<td border="1">'.$alcantarillado.'</td>
<td border="1">'.$alcantarillado1.'</td>
<td>Aceras</td>
<td border="1">'.$aceras.'</td>
<td border="1">'.$aceras1.'</td>
<td></td>
</tr>

<tr>
<td>Teléfono</td>
<td></td>
<td border="1">'.$telefono.'</td>
<td border="1">'.$telefono1.'</td>
<td>Relleno</td>
<td border="1">'.$relleno.'</td>
<td border="1">'.$relleno1.'</td>
<td></td>
</tr>
</table>
';
$pdf->writeHTML($tServ, true, false, true, false, 'C');
/*********************************Servicios**************************************/


/*********************************Datos de la Via**************************************/

$dtv='
<b>DATOS DE LA VIA</b><br>
<table width="100%" border="0">
<tr>
<td>NOMBRE</td>
<td>ANCHO (mts)</td>
<td>REFERENCIA</td>
<td>NIVEL</td>
</tr>

<tr>
<td>'.$calle.'</td>
<td>'.$bbh_calle_fab_md.'</td>
<td>mts</td>
<td>mts</td>
</tr>

<tr>
<td>'.$Interseccion.'</td>
<td>'.$bbh_interseccion_fab_md.'</td>
<td>mts</td>
<td>mts</td>
</tr>
</table>
';
$pdf->writeHTML($dtv, true, false, true, false, 'J');
/*********************************Datos de la Via**************************************/


/**************************************Firmas******************************************/
$firmas='
<table width="100%" border="0">
	<tr>
		<td>__________________________</td>
		<td>__________________________</td>
	</tr>
	<tr>
		<td>SUPERVISOR</td>
		<td>DIRECTORi</td>
	</tr>
</table>
';
$pdf->writeHTML($firmas, true, false, true, false, 'C');
/**************************************Firmas******************************************/

/*******************************NOTAS***********************************/
if ($Selec=='VBB') {
//$pdf->writeHTML($z1, true, false, true, false, 'J'); //vbb
}elseif ($Selec=='CUV') {
$pdf->writeHTML($Nota2, true, false, true, false, 'J');
}elseif ($Selec=='CZV') {
$pdf->writeHTML($Nota1, true, false, true, false, 'J');
}elseif ($Selec=='VUA') {
$pdf->writeHTML($Nota1, true, false, true, false, 'J');
}elseif($Selec=='VUC'){
$pdf->writeHTML($Nota2, true, false, true, false, 'J');
}elseif ($Selec=='VUE') {
$pdf->writeHTML($Nota1, true, false, true, false, 'J');
}elseif ($Selec=='VUD') {
$pdf->writeHTML($Nota2, true, false, true, false, 'J');
}else{
	$pdf->writeHTML($Nota2, true, false, true, false, 'J');
}

/*******************************NOTAS***********************************/
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('pdf_certificado_linea_fabrica.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
