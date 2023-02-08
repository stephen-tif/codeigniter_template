$(document).ready(function(){

	//Select2 en campos requeridos
    $("#cmbUsers").select2({
        width:"70%",
        placeholder:".::Seleccione::.",
        theme:"bootstrap"
    });

	//LLENADO DE TABLA SIN FILTRO DE FECHAS
	loadTable();

	function loadTable()
	{
		if ($.fn.DataTable.isDataTable('#tablaHistorial')) 
        {
            $('#tablaHistorial').DataTable().destroy();
        }
          
        $('#tablaHistorial tbody').empty();
		var table = $("#tablaHistorial").DataTable({
			bFilter: false,
			order: [[ 0, "desc" ]],
			language: 
			{url: "../resources/src/js/Spanish.json"},
			ajax:
			{
				type:"POST",
				dataType:"JSON",
				url:"Auditoria/llenarTabla",
				data:{
					inicio:'',
					fin:''
				}
			},
			dom: 'Bfrtip',
			buttons:[
				{
					extend:'pageLength',
					text:'<i class="fas fa-table"></i> Numero de filas',
					titleAttr:'Numero de filas a mostrar',
					className:'btn-light btn-sm'
				},
				{
					extend:'excelHtml5',
					text:'<i class="far fa-file-excel"></i> EXCEL',
					titleAttr:'Exportar a excel',
					filename: "reporteUsuario",
					exportOptions:{
						columns:[0,1,2,3]
					},
					className:'btn btn-light btn-sm'
				},
				{
					extend:'print',
					text:'<i class="fas fa-print"></i> IMPRIM.',
					titleAttr:'Imprimir',
					exportOptions:{
						columns:[0,1,2,3],
						stripHtml: false,
					},
					className:'btn btn-light btn-sm'
				}
			]
		});	
	}

	//BUSQUEDA DE HISTORIAL POR RANGO DE FECHAS
	$(document).on('click','#search',()=>{
		var inicio = $("#f_inicio").val();
		var fin = $("#f_fin").val();
		var user = $("#cmbUsers").val();
		if(inicio=="" || fin=="")
		{
			Lobibox.notify('warning',{
				sound:false,
				delayIndicator :false,
				position:"top right",
				title: "Verifique sus datos",
				msg:"Debe seleccionar el rango de fechas"
			});
			return;
		}
		if(inicio>fin){
			Lobibox.notify('warning',{
				sound:false,
				delayIndicator :false,
				position:"top right",
				title: "Verifique sus datos",
				msg:"La fecha inicial debe ser menor a la fecha final"
			});
			return;
		}

        //DataTables AJAX
        if ($.fn.DataTable.isDataTable('#tablaHistorial')) 
        {
            $('#tablaHistorial').DataTable().destroy();
        }
          
        $('#tablaHistorial tbody').empty();
		var users = [];
		$('select[name="usuarios[]"] option:selected').each(function() {
			users.push($(this).val());
		});
		//DataTables AJAX
		var table = $("#tablaHistorial").DataTable({
			bFilter: false,
			order: [[ 0, "desc" ]],
			language: 
			{url: "../resources/src/js/Spanish.json"},
			ajax:
			{
				type:"POST",
				dataType:"JSON",
				url:"Auditoria/llenarTabla",
				data:{
					inicio:inicio,
					fin:fin,
					users:users
				}
			},
			dom: 'Bfrtip',
			buttons:[
				{
					extend:'pageLength',
					text:'<i class="fas fa-table"></i> Numero de filas',
					titleAttr:'Numero de filas a mostrar',
					className:'btn-light btn-sm'
				},
				{
					extend:'excelHtml5',
					text:'<i class="far fa-file-excel"></i> EXCEL',
					titleAttr:'Exportar a excel',
					filename: "reporteUsuario",
					exportOptions:{
						columns:[0,1,2,3]
					},
					className:'btn btn-light btn-sm'
				},
				{
					extend:'print',
					text:'<i class="fas fa-print"></i> IMPRIM.',
					titleAttr:'Imprimir',
					exportOptions:{
						columns:[0,1,2,3],
						stripHtml: false,
					},
					className:'btn btn-light btn-sm'
				}
			]
		});	
	});


	//RESET
	$(document).on('click','#reset',()=>{
		$("#f_inicio").val("");
		$("#f_fin").val("");
		$("#cmbUsers").val('[]').trigger('change');   
		loadTable();
	});

});
