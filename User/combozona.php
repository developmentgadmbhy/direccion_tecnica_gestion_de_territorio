<?php
include '../Connections/RootSistemas_Conexion_masterWeb.php';



if (isset($_POST['tipozona'])) {
  
  $tipozona    = $_POST['tipozona'];
$html = '';

  if ($tipozona == 1) {

        $rebro = "SELECT * FROM liquidacion where estado = 1 and zona_u = 1 ";  

          $msresults1= mysql_query($rebro);  
          //$GETData=mysql_fetch_array($msresults1);

         $html = '<option value="" id="defaul">Seleccione Una...</option>';

       while ($value=mysql_fetch_assoc($msresults1)) {
              $html .='<option value="'.$value['id'].'" data-id="'.$value['tipo'].'" data-text="'.$value['cod_rubro'].'" data-in="'.$value['coeficiente'].'">'.$value['tramite'].'</option>';
        }
         
         

         
  }else{

        $rebro = "SELECT * FROM liquidacion where estado = 1 and zona_r = 1 ";  

          $msresults1= mysql_query($rebro);  
         // $GETData=mysql_fetch_array($msresults1);

         $html = '<option value="" id="defaul">Seleccione Una...</option>';

         while ($value=mysql_fetch_assoc($msresults1)) {
              $html .='<option value="'.$value['id'].'" data-id="'.$value['tipo'].'" data-text="'.$value['cod_rubro'].'" data-in="'.$value['coeficiente'].'">'.$value['tramite'].'</option>';
        }


}

echo $html;


}

?>