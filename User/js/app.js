var tip = 0;
$("#tipoPredrio").change(function(){

	var valorSelect = $(this).val();
	tip = valorSelect;

	if (valorSelect == 1) {
		$("#Urb").show();
		$("#rurl").hide();

		$("#zona").focus().select();

	}else{
		$("#Urb").hide();
		$("#rurl").show();

		$("#Clave").focus().select();
	}

});

$("#zona").change(function(){
	var zona 	= $("#zona").val();
	var sector 	= $("#Sector").val();
	var manzana = $("#Manzana").val();
	var solar 	= $("#Solar").val();
	if ((zona > 0) && (sector >0) && (manzana > 0) && (solar > 0) ) {
		$("#btnBuscar").prop("disabled", false);
	}else{
		$("#btnBuscar").prop("disabled", true);
	}
});

$("#zona").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Sector").focus().select();
    }
});

$("#Sector").change(function(){
	var zona 	= $("#zona").val();
	var sector 	= $("#Sector").val();
	var manzana = $("#Manzana").val();
	var solar 	= $("#Solar").val();
	if ((zona > 0) && (sector >0) && (manzana > 0) && (solar > 0) ) {
		$("#btnBuscar").prop("disabled", false);
	}else{
		$("#btnBuscar").prop("disabled", true);
	}
});

$("#Sector").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Manzana").focus().select();
    }
});

$("#Manzana").change(function(){
	var zona 	= $("#zona").val();
	var sector 	= $("#Sector").val();
	var manzana = $("#Manzana").val();
	var solar 	= $("#Solar").val();
	if ((zona > 0) && (sector >0) && (manzana > 0) && (solar > 0) ) {
		$("#btnBuscar").prop("disabled", false);
	}else{
		$("#btnBuscar").prop("disabled", true);
	}
});

$("#Manzana").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Solar").focus().select();
    }
});

$("#Solar").change(function(){
	var zona 	= $("#zona").val();
	var sector 	= $("#Sector").val();
	var manzana = $("#Manzana").val();
	var solar 	= $("#Solar").val();
	if ((zona > 0) && (sector >0) && (manzana > 0) && (solar > 0) ) {
		$("#btnBuscar").prop("disabled", false);
	}else{
		$("#btnBuscar").prop("disabled", true);
	}
});

$("#Solar").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Div1").focus().select();
    }
});

$("#Div1").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Div2").focus().select();
    }
});

$("#Div2").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Div3").focus().select();
    }
});

$("#Div3").on('keypress',function(e) {
    if(e.which == 13) {
        $("#Div4").focus().select();
    }
});

$("#Div4").on('keypress',function(e) {
    if(e.which == 13) {
        $("#PHV").focus().select();
    }
});

$("#PHV").on('keypress',function(e) {
    if(e.which == 13) {
        $("#PHH").focus().select();
    }
});

$("#PHH").on('keypress',function(e) {
    if(e.which == 13) {
        $("#btnBuscar").focus();

    }
});

// RURAL

$("#Clave").change(function(){
	var Clave 		= $("#Clave").val();
	var parroquia 	= $("#parroquia").val();
	if ((Clave > 0) && (parroquia >0) ) {
		$("#btnBuscarRural").prop("disabled", false);
	}else{
		$("#btnBuscarRural").prop("disabled", true);
	}
});

$("#Clave").on('keypress',function(e) {
    if(e.which == 13) {
        $("#parroquia").focus().select();
    }
});

$("#parroquia").change(function(){
	var Clave 		= $("#Clave").val();
	var parroquia 	= $("#parroquia").val();
	if ((Clave > 0) && (parroquia >0) ) {
		$("#btnBuscarRural").prop("disabled", false);
	}else{
		$("#btnBuscarRural").prop("disabled", true);
	}
});

$("#parroquia").on('keypress',function(e) {
    if(e.which == 13) {
        $("#btnBuscarRural").focus();
    }
});




$("#btnBuscar").click(function(){

	var zona 	= $("#zona").val();
	var sector 	= $("#Sector").val();
	var manzana = $("#Manzana").val();
	var solar 	= $("#Solar").val();

	var Div1 	= $("#Div1").val();
	var Div2 	= $("#Div2").val();
	var Div3 	= $("#Div3").val();
	var Div4 	= $("#Div4").val();

	var PHV 	= $("#PHV").val();
	var PHH 	= $("#PHH").val();

	var TipoUrl = $("#tipoPredrio").val();

	if (TipoUrl == 1) {
		$url = "frm_liquidacion.php";
	}else{
		$url = "frm_liquidacionR.php";
	}

	var DataForm = new FormData();
        DataForm.append("zona", zona);
        DataForm.append("sector", sector);
        DataForm.append("manzana", manzana);
        DataForm.append("solar", solar);
        DataForm.append("Div1", Div1);
        DataForm.append("Div2", Div2);
        DataForm.append("Div3", Div3);
        DataForm.append("Div4", Div4);
        DataForm.append("PHV", PHV);
        DataForm.append("PHH", PHH);
        $.ajax({
            url: $url,
            method: "POST",
            data: DataForm,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
               if (respuesta) {

               	$("#avSolar").html("$"+respuesta["AVALUO_SOLAR"]);
               	$("#avConstruccion").html("$"+respuesta["AVALUO_CONSTRUCCION"]);
               	$("#avMunicipal").html("$"+respuesta["AVALUO_MUNICIPAL"]);

               	$("#avlSolar").val(respuesta["AVALUO_SOLAR"]);
				$("#avlConstruccion").val(respuesta["AVALUO_CONSTRUCCION"]);
				$("#avlMunicipal").val(respuesta["AVALUO_MUNICIPAL"]);

               	$("#Nombres").val(respuesta["Nombre"]);
               	$("#Apellidos").val(respuesta["apellidos"]);
               	$("#Cedula").val(respuesta["CEDULA"]);

               	$("#codPredio").val(respuesta["CODIGO_PREDIO"]);
               	$("#codUsuario").val(respuesta["CODIGO_USUARIO"]);
               	$("#areaSolar").val(respuesta["AreaSolar"]);

               	$("#liq").show();
               	$("#liq1").show();

               }
            }
        });


        var DataForm1 = new FormData();
        DataForm1.append("tipozona", tip);
       
        $.ajax({
            url: "combozona.php",
            method: "POST",
            data: DataForm1,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
               $("#tramites").html(respuesta);
            }
        });


});


$("#btnBuscarRural").click(function(){

Clave = $("#Clave").val();// clave catastral
parroquia = $("#parroquia").val();

var TipoUrl = $("#tipoPredrio").val();// tipo de predio

	if (TipoUrl == 1) {
		$url = "frm_liquidacion.php";
	}else{
		$url = "frm_liquidacionR.php";
	}

	var DataForm = new FormData();
        DataForm.append("Clave", Clave);
        DataForm.append("parroquia", parroquia);

        $.ajax({
            url: $url,
            method: "POST",
            data: DataForm,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
               if (respuesta) {

               	$("#avSolar").html("$"+respuesta["AVALUO_SOLAR"]);
               	$("#avConstruccion").html("$"+respuesta["AVALUO_CONSTRUCCION"]);
               	$("#avMunicipal").html("$"+respuesta["AVALUO_MUNICIPAL"]);

               	$("#avlSolar").val(respuesta["AVALUO_SOLAR"]);
				$("#avlConstruccion").val(respuesta["AVALUO_CONSTRUCCION"]);
				$("#avlMunicipal").val(respuesta["AVALUO_MUNICIPAL"]);

               	$("#Nombres").val(respuesta["Nombre"]);
               	$("#Apellidos").val(respuesta["apellidos"]);
               	$("#Cedula").val(respuesta["CEDULA"]);

               	$("#codPredio").val(respuesta["CODIGO_PREDIO"]);
               	$("#codUsuario").val(respuesta["CODIGO_USUARIO"]);
               	$("#areaSolar").val(respuesta["AreaSolar"]);

               	$("#liq").show();
               	$("#liq1").show();

               	$( "#tramites option" ).each(function() {
					 console.log( $( this ).val() );
					 if ($( this ).val() == 2) {
					 	$( this ).remove();
					 }
					 if ($( this ).val() == 6) {
					 	$( this ).remove();
					 }

				});
					 

               }
            }
        });
        

        var DataForm1 = new FormData();
        DataForm1.append("tipozona", tip);
       
        $.ajax({
            url: "combozona.php",
            method: "POST",
            data: DataForm1,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
               $("#tramites").html(respuesta);
            }
        });


});


$("#tramites").change(function(){

	var txt = $('option:selected',this).text();
	$("#textCombo").html(txt);
	var coeficiente 	= $('option:selected',this).attr('data-in');
	var tipo 			= $('option:selected',this).attr('data-id');
	var codigoRubro  	= $('option:selected',this).attr('data-text');
	var areaSolar 		= $("#areaSolar").val();

	var avSolar 		= $("#avlSolar").val();
	var avConstruccion 	= $("#avlConstruccion").val();
	var avMunicipal 	= $("#avlMunicipal").val();


	var tipoZona		= $("#tipoPredrio").val();


	var id 	= $("#tramites").val();
	$("#defaul").prop("selected", true);

	$("#tramites").val();

	if (tipo == 4) {
		var valor = prompt("Ingrese el Valor del Area");
		  if (valor == null || valor.length < 1) {
		   	$("#defaul").prop("selected", true);
		  }else{

		  	var DataForm = new FormData();
		        DataForm.append("C_id", id);
		        DataForm.append("C_coeficiente", coeficiente);
		        DataForm.append("C_tipo", tipo);
		        DataForm.append("C_codigoRubro", codigoRubro);
		        DataForm.append("C_areaSolar", areaSolar);
		        DataForm.append("C_avSolar", avSolar);
		        DataForm.append("C_avConstruccion", avConstruccion);
		        DataForm.append("C_avMunicipal", avMunicipal);
		        DataForm.append("tipoZona", tipoZona);


		  	var zona 	= $("#zona").val();
			var sector 	= $("#Sector").val();
			var manzana = $("#Manzana").val();
		
		  	DataForm.append("C_zona", zona);
		  	DataForm.append("C_sector", sector);
		  	DataForm.append("C_manzana", manzana);
		  	

		  	DataForm.append("C_valor", valor);

 		if ($("#tipoPredrio").val() == 1) {

		  	$.ajax({
	            url: 'frm_liquidacion.php',
	            method: "POST",
	            data: DataForm,
	            cache: false,
	            contentType: false,
	            processData: false,
	            dataType: "json",
	            success: function(respuesta) {
	            	$('#rellenoValor').html('');
	            	var vl =0;
	            	var concat = '';
	            	$.each(respuesta['Rubros'], function( index, value ) {

	            		if (index == 0) {
	            			vl = respuesta['valorFinal']['subTotal'];
	            		}else{
	            			vl = parseFloat(respuesta['Rubros'][index]['VALOR']);
	            		}

	 
	            		concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ vl.toFixed(2) +'|';

					  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+vl+"</td> </tr>");
					});

					$("#totalVal").html(respuesta['valorFinal']['valortotal']);
					$("#valorestotales").val(concat);
					//console.log(concat);

	            }
        	});

		  }else{

		  	

				$.ajax({
					            url: 'frm_liquidacionR.php',
					            method: "POST",
					            data: DataForm,
					            cache: false,
					            contentType: false,
					            processData: false,
					            dataType: "json",
					            success: function(respuesta) {
					            	$('#rellenoValor').html('');
					            	var vl =0;
					            	var concat = '';
					            	$.each(respuesta['Rubros'], function( index, value ) {

					            		if (index == 0) {
					            			vl = respuesta['valorFinal']['subTotal'];
					            		}else{
					            			vl = parseFloat(respuesta['Rubros'][index]['VALOR']);
					            		}

					            		concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ vl.toFixed(2) +'|';

									  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+vl+"</td> </tr>");
									});

									$("#totalVal").html(respuesta['valorFinal']['valortotal']);
									$("#valorestotales").val(concat);
								//	console.log(concat);

					            }
				        	});

		  }

		  }//else

	}//if



	if (tipo == 1) {
		
		var DataForm = new FormData();
	        DataForm.append("D_id", id);
	        DataForm.append("D_coeficiente", coeficiente);
	        DataForm.append("D_tipo", tipo);
	        DataForm.append("D_codigoRubro", codigoRubro);
	        DataForm.append("D_areaSolar", areaSolar);
	        DataForm.append("D_avSolar", avSolar);
	        DataForm.append("D_avConstruccion", avConstruccion);
	        DataForm.append("D_avMunicipal", avMunicipal);


		$.ajax({
	            url: 'frm_liquidacion.php',
	            method: "POST",
	            data: DataForm,
	            cache: false,
	            contentType: false,
	            processData: false,
	            dataType: "json",
	            success: function(respuesta) {

	            	$('#rellenoValor').html('');
	            	var vl =0;
	            	var concat = 0;
	            	$.each(respuesta['Rubros'], function( index, value ) {

	            		if (index == 0) {
	            			vl = respuesta['valorFinal']['subTotal'];
	            		}else{
	            			vl = parseFloat(respuesta['Rubros'][index]['VALOR']);
	            		}
	            		concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ vl.toFixed(2) +'|';

					  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+vl.toFixed(2)+"</td> </tr>");
					});

					$("#totalVal").html(respuesta['valorFinal']['valortotal'].toFixed(2));
	            	$("#valorestotales").val(concat);
	            	//console.log(concat);
	            }
        	});

	}

	if (tipo == 2) {


		var DataForm = new FormData();
	        DataForm.append("E_id", id);
	        DataForm.append("E_tipo", tipo);
	        DataForm.append("E_codigoRubro", codigoRubro);
	        DataForm.append("E_coeficiente", coeficiente);


		$.ajax({
	            url: 'frm_liquidacion.php',
	            method: "POST",
	            data: DataForm,
	            cache: false,
	            contentType: false,
	            processData: false,
	            dataType: "json",
	            success: function(respuesta) {

	            	$('#rellenoValor').html('');
	            	var vl =0;
	            	var concat = 0;
	            	$.each(respuesta['Rubros'], function( index, value ) {

	            		if (index == 0) {
	            			vl = respuesta['valorFinal']['subTotal'];
	            		}else{
	            			vl = parseFloat(respuesta['Rubros'][index]['VALOR']);
	            		}

	            		concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ vl +'|';

					  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+vl+"</td> </tr>");
					});

					$("#totalVal").html(respuesta['valorFinal']['valortotal'].toFixed(2));
					$("#valorestotales").val(concat);
					//console.log(concat);
	            	
	            }
        	});


	}


	if (tipo == 0) {


		var DataForm = new FormData();
	        DataForm.append("F_id", id);
	        DataForm.append("F_coeficiente", coeficiente);
	        DataForm.append("F_tipo", tipo);
	        DataForm.append("F_codigoRubro", codigoRubro);
	        DataForm.append("F_areaSolar", areaSolar);
	        DataForm.append("F_avSolar", avSolar);
	        DataForm.append("F_avConstruccion", avConstruccion);
	        DataForm.append("F_avMunicipal", avMunicipal);

		$.ajax({
	            url: 'frm_liquidacion.php',
	            method: "POST",
	            data: DataForm,
	            cache: false,
	            contentType: false,
	            processData: false,
	            dataType: "json",
	            success: function(respuesta) {
	            	
	            	$('#rellenoValor').html('');
	            	var vl =0;
	            	var concat = 0;
	            	$.each(respuesta['Rubros'], function( index, value ) {
	         		  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+respuesta['Rubros'][index]['VALOR'].toFixed(2)+"</td> </tr>");

	         		  concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ respuesta['Rubros'][index]['VALOR'].toFixed(2) +'|';
					});

					$("#totalVal").html(respuesta['valorFinal']['valortotal'].toFixed(2));
					$("#valorestotales").val(concat);
					//console.log(concat);
	            	
	            }
        	});


	}


		if (tipo == 3) {

				var valor = prompt("Ingrese el Valor de Area");

			 if (valor == null || valor.length < 1) {
			   	$("#defaul").prop("selected", true);
			  }else{

				var DataForm = new FormData();
			        DataForm.append("G_id", id);
			        DataForm.append("G_coeficiente", coeficiente);
			        DataForm.append("G_tipo", tipo);
			        DataForm.append("G_codigoRubro", codigoRubro);
			        DataForm.append("G_areaSolar", areaSolar);
			        DataForm.append("G_avSolar", avSolar);
			        DataForm.append("G_avConstruccion", avConstruccion);
			        DataForm.append("G_avMunicipal", avMunicipal);
			        DataForm.append("G_ValorArea", valor);


			        if ($("#tipoPredrio").val() == 1) {


					$.ajax({
				            url: 'frm_liquidacion.php',
				            method: "POST",
				            data: DataForm,
				            cache: false,
				            contentType: false,
				            processData: false,
				            dataType: "json",
				            success: function(respuesta) {
				            	//console.log(respuesta);
				            	$('#rellenoValor').html('');
				            	var vl =0;
				            	var concat = '';
				            	$.each(respuesta['Rubros'], function( index, value ) {

				            		if (index == 0) {
		            					vl = respuesta['valorFinal']['subTotal'];
				            		}else{
				            			vl = parseFloat(respuesta['Rubros'][index]['VALOR']);
				            		}

									concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ vl.toFixed(2) +'|';


				         		  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+vl.toFixed(2)+"</td> </tr>");
								});

								$("#totalVal").html(respuesta['valorFinal']['valortotal'].toFixed(2));
								$("#valorestotales").val(concat);
								//console.log(concat);
				            	
				            }
			        	});



					}else{

						$.ajax({
				            url: 'frm_liquidacionR.php',
				            method: "POST",
				            data: DataForm,
				            cache: false,
				            contentType: false,
				            processData: false,
				            dataType: "json",
				            success: function(respuesta) {
				            	console.log(respuesta);
				            	$('#rellenoValor').html('');
				            	var vl =0;
				            	var concat = 0;
				            	$.each(respuesta['Rubros'], function( index, value ) {

				            		if (index == 0) {
		            					vl = respuesta['valorFinal']['subTotal'];
				            		}else{
				            			vl = parseFloat(respuesta['Rubros'][index]['VALOR']);
				            		}

								concat = concat + respuesta['Rubros'][index]['CODIGORUBRO'] + ',' + respuesta['Rubros'][index]['CODIGO_TITULO_REPORTE'] + ','+ vl.toFixed(2) +'|';

				         		  $('#rellenoValor').append("<tr> <td>"+respuesta['Rubros'][index]['DESCRIPCION']+"</td> <td>"+vl.toFixed(2)+"</td> </tr>");
								});

								$("#totalVal").html(respuesta['valorFinal']['valortotal'].toFixed(2));
				            	$("#valorestotales").val(concat);
				            	//console.log(concat);
				            }
			        	});

					}


				}
			}
// var full = $("#valorestotales").val();

// 	if (full.length > 0) {

	$("#saveProcess").prop("disabled", false);
// 	}

// console.log(full.length);
// console.log(full);

});



$(".InpTextc").change(function(){
	$("#liq").css("display", "none");
	$("#liq1").css("display", "none");

	$("#Nombres").val('');
	$("#Apellidos").val('');
	$("#Cedula").val('');
	$("#Concepto").val('');
	$("#codPredio").val('');
	$("#codUsuario").val('');
	$("#areaSolar").val('');
	$("#avlSolar").val('');
	$("#avlConstruccion").val('');
	$("#avlMunicipal").val('');
});

$("#tipoPredrio").change(function(){
	$("#liq").css("display", "none");
	$("#liq1").css("display", "none");
	$(".InpTextc").val('0');

	$("#Nombres").val('');
	$("#Apellidos").val('');
	$("#Cedula").val('');
	$("#Concepto").val('');
	$("#codPredio").val('');
	$("#codUsuario").val('');
	$("#areaSolar").val('');
	$("#avlSolar").val('');
	$("#avlConstruccion").val('');
	$("#avlMunicipal").val('');

});

$("#Limpiar").click(function(){
	$("#Nombres").val('');
	$("#Apellidos").val('');
	$("#Cedula").val('');
	$("#Concepto").val('');
	$("#codPredio").val('');
	$("#codUsuario").val('');
	$("#areaSolar").val('');
	$("#avlSolar").val('');
	$("#avlConstruccion").val('');
	$("#avlMunicipal").val('');

	$("#liq").css("display", "none");
	$("#liq1").css("display", "none");

	$("#defaul").prop("selected", true);
	$("#rellenoValor").html('');
	$(".InpTextc").val(0);
	$("#zona").focus().select();
});

$("#Limpiar1").click(function(){
	$("#Nombres").val('');
	$("#Apellidos").val('');
	$("#Cedula").val('');
	$("#Concepto").val('');
	$("#codPredio").val('');
	$("#codUsuario").val('');
	$("#areaSolar").val('');
	$("#avlSolar").val('');
	$("#avlConstruccion").val('');
	$("#avlMunicipal").val('');

	$("#liq").css("display", "none");
	$("#liq1").css("display", "none");

	$("#defaul").prop("selected", true);
	$("#rellenoValor").html('');
	$(".InpTextc").val(0);
	$("#Clave").focus().select();
});


$("#saveProcess").click(function(){


	var Concepto	= $("#Concepto").val();
	var codPredio	= $("#codPredio").val();
	var codUsuario	= $("#codUsuario").val();
	var valorestotales	= $("#valorestotales").val();
	var tipo = tip;


	var DataForm = new FormData();
	    DataForm.append("Concepto", Concepto);
	    DataForm.append("codPredio", codPredio);
	    DataForm.append("codUsuario", codUsuario);
	    DataForm.append("valorestotales", valorestotales);
	    DataForm.append("tipo", tipo);

	    	$.ajax({
		            url: 'saveprocess.php',
		            method: "POST",
		            data: DataForm,
		            cache: false,
		            contentType: false,
		            processData: false,
		            dataType: "json",
		            success: function(respuesta) {
		            	//console.log(respuesta['liquidacion']);
		            	//$("#liq1").html('');
		            	//$("#liq").html('');
		            	alert(respuesta['liquidacion']);
		            	location.reload();
		            }
	        	});


});