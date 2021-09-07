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

/**************************************************************/
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//$//numeroMes = date("m")-1;
if (!isset($_GET['Doc'])) {
	header('Location: ../../index.php');
}
$idDoc=$_GET['Doc'];
$Data_Base=mysql_query("SELECT 	bbh_id_cert_uso_suelo,
								bbh_num_ofic_usl,
								bbh_solicitante_usl,
								bbh_descripcion_usl,
								bbh_local_descripcion_usl,
								bbh_usuario_id,
								bbh_fecha_usl,
								bbh_hora_usl,
								bbh_zonif_id,
								bbh_clave_usl,
								bbh_zonificacion.bbh_nomenclatura_zon
								FROM
								bbh_cert_uso_suelo, bbh_zonificacion
								WHERE bbh_zonificacion.bbh_id_zonificacion=bbh_cert_uso_suelo.bbh_zonif_id AND
								bbh_id_cert_uso_suelo=$idDoc")or die(mysql_error());

$GetData=mysql_fetch_assoc($Data_Base);
setlocale(LC_ALL, 'es-ES');
$date=$GetData['bbh_fecha_usl'];
$f = explode('-', $date);
$f0=$f[0];
$f1=$f[1]-1;
$f2=$f[2];
$fecha='Babahoyo, '.$f2.' '.$mes[$f1].' '.$f0;
$fecha2=$f2.' de '.$mes[$f1].' del '.$f0;

$bbh_num_ofic_usl=$GetData['bbh_num_ofic_usl'];
$bbh_solicitante_usl=$GetData['bbh_solicitante_usl'];
//$bbh_descripcion_usl=$GetData['bbh_descripcion_usl'];
$bbh_local_descripcion_usl=$GetData['bbh_local_descripcion_usl'];

$zonific=$GetData['bbh_nomenclatura_zon'];
$NombreSolici=$GetData['bbh_solicitante_usl'];
$clavecatastral=$GetData['bbh_clave_usl'];
$detalle=$GetData['bbh_descripcion_usl'];
//$local="UN DEPOSITO DE VENTAS DE MATERIALES DE CONSTRUCCION";

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
//$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->Image('photo.png', 15, 10, 180, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 14);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', 'B', 11);
$pdf->Write(8, 'CERTIFICADO DE USO DEL SUELO', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('dejavusans', '', 10);
$pdf->Write(8, 'Fecha: '.$fecha, '', 0, 'R', true, 0, false, false, 0);
$pdf->Write(8, 'Oficio #: '.$bbh_num_ofic_usl, '', 0, 'R', true, 0, false, false, 0);

//$pdf->SetFont('dejavusans', '', 12);

$html = '

Señor:<br>
'.$NombreSolici.'.
<br><br>
En respuesta a la solicitud prestada en ésta dependencia referente a la Certificación del uso del¿ suelo, del predio #'.$clavecatastral.'de '.$detalle.'

<br>
';
$pdf->writeHTML($html, true, false, true, false, 'J');


/*********************************************CZV***************************************************/
$z0='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: C.Z.V.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: 250 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: 417 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 240,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 9,00 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 10 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 60%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 200%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 0,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 0,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************CZV****************************************************/

/*********************************************VBB***************************************************/
$z1='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: V.B.B.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: 180 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: 300 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 180,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 7,50 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 3 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 50%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 120%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 3,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 1,50 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************VBB****************************************************/


/*********************************************ZA***************************************************/
$z2='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: Z.A.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 10.000,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 40,00 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 1 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 5%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 5%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 40,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 10,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 10,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************ZA****************************************************/

/*********************************************CUV***************************************************/
$z3='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: C.U.B.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: 350 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: 583 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 255,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 9,00 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: Variable</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 65%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 200%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 0,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 0,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************CUV****************************************************/


/*********************************************VUC***************************************************/
$z4='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: V.U.C.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: 150 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: 250 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 200,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 7,50 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 3 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 50%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 80%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 0,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 1,50 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************VUC****************************************************/

/*********************************************VUD***************************************************/
$z5='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: V.U.D.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: 100 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: 167 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 300,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 9,50 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 3 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 40%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 100%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 5,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 1,50 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************VUD****************************************************/

/*********************************************I***************************************************/
$z6='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: I</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 1000,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 20 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 2 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 40%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 60%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 10,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 5,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************I****************************************************/



/*********************************************CE***************************************************/
$z7='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: C.E</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 500,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 12 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 5 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 40%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 160%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 10,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 3,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 3,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************CE****************************************************/

/*********************************************ZA***************************************************/
$z8='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: Z.A</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 10000,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 40 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 1 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 5%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 5%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 40,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 10,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 10,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************ZA****************************************************/

/*********************************************PN***************************************************/
$z9='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: P.N</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 10000,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 40 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>:  </td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 0%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 0%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: </td>
		</tr>
		<tr>
			<td> Lateral: </td>
		</tr>
		<tr>
			<td> Posterior: </td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************PN****************************************************/

/*********************************************S***************************************************/
$z10='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: S</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 10000,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 40 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 1 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 5%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 5%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 40,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 10,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 10,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************S****************************************************/

/*********************************************VUA***************************************************/
$z11='
<table width="100%" border="0">
<tr>
<td width="20%"></td>
<td width="60%">

	<table width="100%" border="1">
		<tr>
			<td><b>ZONIFICACION</b></td>
			<td>: V.U.A.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD BRUTA</b></td>
			<td>: 200 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>DENSIDAD NETA</b></td>
			<td>: 333 Hab./Hect.</td>
		</tr>
		<tr>
			<td><b>LOTE MINIMO</b></td>
			<td>: 150,00 m2.</td>
		</tr>
		<tr>
			<td><b>FRENTE MINIMO</b></td>
			<td>: 6,00 m.l.</td>
		</tr>
		<tr>
			<td><b>ALTURA MAXIMA</b></td>
			<td>: 2 Pisos</td>
		</tr>
		<tr>
			<td><b>COS</b></td>
			<td>: 30%</td>
		</tr>
		<tr>
			<td><b>CUS</b></td>
			<td>: 100%</td>
		</tr>
		<tr>
			<td rowspan="4"><b>RETIROS MINIMOS</b></td>
			<td>:</td>
		</tr>
		<tr>
			<td> Frontal: 0,00 m.</td>
		</tr>
		<tr>
			<td> Lateral: 0,00 m.</td>
		</tr>
		<tr>
			<td> Posterior: 5,00 m.</td>
		</tr>
	</table>

</td>
<td width="20%"></td>

</tr>

</table>
';

/********************************************VUA****************************************************/

/****************************************************/
//$pdf->writeHTML($z1, true, false, true, false, 'J');
if ($zonific=='CZV') {
	$pdf->writeHTML($z0, true, false, true, false, 'J');
}elseif ($zonific=='VBB') {
	$pdf->writeHTML($z1, true, false, true, false, 'J');
}elseif ($zonific=='ZA') {
	$pdf->writeHTML($z2, true, false, true, false, 'J');
}elseif ($zonific=='CUV') {
	$pdf->writeHTML($z3, true, false, true, false, 'J');
}elseif ($zonific=='VUC') {
	$pdf->writeHTML($z4, true, false, true, false, 'J');
}elseif ($zonific=='VUD') {
	$pdf->writeHTML($z5, true, false, true, false, 'J');
}elseif ($zonific=='I') {
	$pdf->writeHTML($z6, true, false, true, false, 'J');
}elseif ($zonific=='CE') {
	$pdf->writeHTML($z7, true, false, true, false, 'J');
}elseif ($zonific=='ZA') {
	$pdf->writeHTML($z8, true, false, true, false, 'J');
}elseif ($zonific=='PN') {
	$pdf->writeHTML($z9, true, false, true, false, 'J');
}elseif ($zonific=='S') {
	$pdf->writeHTML($z10, true, false, true, false, 'J');
}elseif ($zonific=='VUA') {
	$pdf->writeHTML($z11, true, false, true, false, 'J');
}
/****************************************************/
$comp='<br>
Además, basados en la misma Ordenanzas los USOS PERMITIDOS son los siguientes:
<br>
<table width="100%" border="0">
	<tr>
		<td rowspan="8" width="5%">
		</td>
		<td width="95%">
		<b>VIVIENDA UNIFAMILIAR PAREADA.</b>
		</td>
	</tr>
	<tr>
	<td><b>ESTABLECIMIENTOS DE EQUIPAMIENTOS COMUNITARIOS DE CARÁCTER LOCAL:</b></td>
	</tr>
	<tr>
	<td>EDUCACIONALES</td>
	</tr>
	<tr>
	<td>DE SALUD</td>
	</tr>
	<tr>
	<td>CULTURALES</td>
	</tr>
	<tr>
	<td>RELIGIOSOS</td>
	</tr>
	<tr>
	<td>RECREACIONALES. ETC.</td>
	</tr>
	<tr>
	<td>INSTALACIONES DE UTILIDAD PÚBLICA.</td>
	</tr>
</table>
';

$compI='<br>
Además, basados en la misma Ordenanzas los USOS PERMITIDOS son los siguientes:
<br>
<table width="100%" border="0">
	<tr>
		<td rowspan="8" width="5%">
		</td>
		<td width="95%"> <br>
		INDUSTRIA.<br>
		COMERCIO ESPECIAL.<br>
		ZONA AGRICOLA.<br>
		PROTECCION NATURAL.<br>
		SEGURIDAD.<br>
		EQUIPAMIENTO.<br>
		CLUBES NOCTURNOS.<br>
		TURISMO.<br>
		</td>
	</tr>

</table>
';

$compCE='<br>
Además, basados en la misma Ordenanzas los USOS PERMITIDOS son los siguientes:
<br>
<table width="100%" border="0">
	<tr>
		<td rowspan="8" width="5%">
		</td>
		<td width="95%"> <br>
		INDUSTRIA.<br>
		COMERCIO ESPECIAL.<br>
		ZONA AGRICOLA.<br>
		PROTECCION NATURAL.<br>
		SEGURIDAD.<br>
		EQUIPAMIENTO.<br>
		CLUBES NOCTURNOS.<br>
		TURISMO.<br>
		</td>
	</tr>

</table>
';

$compZA='<br>
Además, basados en la misma Ordenanzas los USOS PERMITIDOS son los siguientes:
<br>
<table width="100%" border="0">
	<tr>
		<td rowspan="8" width="5%">
		</td>
		<td width="95%"> <br>
		INDUSTRIA.<br>
		COMERCIO ESPECIAL.<br>
		ZONA AGRICOLA.<br>
		PROTECCION NATURAL.<br>
		SEGURIDAD.<br>
		EQUIPAMIENTO.<br>
		CLUBES NOCTURNOS.<br>
		TURISMO.<br>
		</td>
	</tr>

</table>
';

$compPN='<br>
Además, basados en la misma Ordenanzas los USOS PERMITIDOS son los siguientes:
<br>
<table width="100%" border="0">
	<tr>
		<td rowspan="8" width="5%">
		</td>
		<td width="95%">
		<b>PROTECCION NATURAL.</b>
		</td>
	</tr>

</table>
';

$compS='<br>
Además, basados en la misma Ordenanzas los USOS PERMITIDOS son los siguientes:
<br>
<table width="100%" border="0">
	<tr>
		<td rowspan="8" width="5%">
		</td>
		<td width="95%">
		<b>SEGURIDAD.</b>
		</td>
	</tr>

</table>
';

if ($zonific=='I') {
	$pdf->writeHTML($compI, true, false, true, false, 'J');
}elseif ($zonific=='CE') {
	$pdf->writeHTML($compCE, true, false, true, false, 'J');
}elseif ($zonific=='ZA') {
	$pdf->writeHTML($compZA, true, false, true, false, 'J');
}elseif ($zonific=='PN') {
	$pdf->writeHTML($compPN, true, false, true, false, 'J');
}elseif ($zonific=='S') {
	$pdf->writeHTML($compS, true, false, true, false, 'J');
}else{

	// output the HTML content
	$pdf->writeHTML($comp, true, false, true, false, 'J');

}




$html2='
Por tal motivo esta Dirección SI considera precedente su solicitud de PERMISO DE FUNCIONAMIENTO, '.$bbh_local_descripcion_usl.' en el sitio antes mencionado, Previo del compromiso del propietario de mantener toda la seguridad, y más que todo el respeto y consideración con sus vecinos.
<br>
SIN OTRO PARTICULAR QUE COMUNICARLE, me suscribo.
<br>
Atentamente;
<br><br><br>
';



$pdf->writeHTML($html2, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 8);
$html1='
<table width="100%" border="0">
	<tr>

		<td>Arq. Marcos Quintana Vera</td>

	</tr>
	<tr>

		<td><b>DIRECTOR TECNICO DE GESTION DEl TERRITORIO.</b></td>

	</tr>

</table>

';
$pdf->writeHTML($html1, true, false, true, false, 'C');



// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
