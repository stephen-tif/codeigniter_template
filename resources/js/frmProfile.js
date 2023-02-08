$(document).ready(function () {
	loadData();

	function loadData(params) {
		var id = $("#idUser").val();

		$.ajax({
			type: "POST",
			dataType: "JSON",
			data: {
				id: id,
			},
			url: "user/obtener",
		}).done(function (data) {
			if (data.datos) {
				$("#FormularioPerfil #id").val(data.datos.idUser);
				$("#FormularioPerfil #nombres").val(data.datos.nombre);
				$("#FormularioPerfil #apellidos").val(data.datos.apellido);
				$("#FormularioPerfil #email").val(data.datos.email);
				$("#FormularioPerfil #username").val(data.datos.username);
				$("#FormularioPerfil #password").val("");
				$("#FormularioPerfil #tel").val(data.datos.tel);
				if (data.datos.image != false) {
					$("#userImg").attr("src", data.datos.image);
				} else {
					if (data.datos.genero == "Masculino") {
						$("#userImg").attr(
							"src",
							"../resources/multimedia/recursos/noPhotoMan.jpg"
						);
					} else {
						$("#userImg").attr(
							"src",
							"../resources/multimedia/recursos/noPhotoGirl.png"
						);
					}
				}
				$(
					"#FormularioPerfil input[name=genero][value=" +
						data.datos.genero +
						"]"
				).prop("checked", true);
			}
		});
	}

	$("#userImg").attr("src", "../resources/multimedia/recursos/noImage.jpg");
	$(document).on("change", "#FormularioPerfil :input[type=file]", function () {
		if ($("#FormularioPerfil #fotos").val() != "") {
			var size = this.files.size;
			var megaBites = size / 1024 / 1024;
			var type = this.files[0].type;

			if (type == "image/jpeg" || type == "image/png") {
				if (megaBites >= 1) {
					Lobibox.notify("error", {
						sound: false,
						delayIndicator: false,
						position: "top right",
						title: "Imagen demasiado grande",
						msg: "La imagen excede la capacidad de subida",
					});
					$("#FormularioPerfil :input[type=file]").val("");
					$("#userImg").attr(
						"src",
						"../resources/multimedia/recursos/noImage.jpg"
					);
					$("#load").waitMe({
						effect: "ios",
						bg: "#fff",
						color: "grey",
						text: "Cargando imagen...",
					});
					setTimeout(() => {
						$("#load").waitMe("hide");
					}, 800);
				} else {
					preview2(this);
				}
			} else {
				Lobibox.notify("error", {
					sound: false,
					delayIndicator: false,
					position: "top right",
					title: "Error al cargar archivo",
					msg: "El archivo no es una imagen",
				});
				$("#FormularioPerfil :input[type=file]").val("");
				$("#userImg").attr(
					"src",
					"../resources/multimedia/recursos/noImage.jpg"
				);
				$("#load").waitMe({
					effect: "ios",
					bg: "#fff",
					color: "grey",
					text: "Cargando imagen...",
				});
				setTimeout(() => {
					$("#load").waitMe("hide");
				}, 800);
			}
		} else {
			$("#userImg").attr("src", "../resources/multimedia/recursos/noImage.jpg");
			$("#load").waitMe({
				effect: "ios",
				bg: "#fff",
				color: "grey",
				text: "Cargando imagen...",
			});
			setTimeout(() => {
				$("#load").waitMe("hide");
			}, 800);
		}
	});

	function preview2(img) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#userImg").attr("src", e.target.result);
			$("#load").waitMe({
				effect: "ios",
				bg: "#fff",
				color: "grey",
				text: "Cargando imagen...",
			});
			setTimeout(() => {
				$("#load").waitMe("hide");
			}, 800);
		};
		reader.readAsDataURL(img.files[0]);
	}

	//se limpia uno por uno para no tener conflicto con el value del radio button
	$("#miPerfil").on("hidden.bs.modal", function () {
		$("#FormularioPerfil :input[type=file]").val("");
	});

	//  AJAX MODIFICAR DATOS
	$(document).on("click", "#modificarPerfil", function () {
		Swal.fire({
			title: "Seguro que desea modificar sus datos?",
			text: "Se cerrara sesion para aplicar los cambios",
			type: "question",
			showCancelButton: true,
			confirmButtonColor: "black",
			cancelButtonColor: "darkgray",
			confirmButtonText: "Aceptar",
		}).then((result) => {
			if (result.value) {
				var info = JSON.stringify(
					$("#FormularioPerfil :input").serializeArray()
				);

				var fd = new FormData();
				var foto = $("#fotos")[0].files[0];
				fd.append("foto", foto);
				fd.append("info", info);

				$.ajax({
					type: "POST",
					dataType: "JSON",
					data: fd,
					contentType: false,
					processData: false,
					url: "dashboard/modificarUsuario",
				}).done(function (data) {
					if (data.datos) {
						$("#miPerfil").modal("hide");
						Lobibox.notify("default", {
							sound: false,
							delayIndicator: false,
							position: "top right",
							title: "Perfil actualizado",
							msg: data.mensaje,
						});
						setTimeout(() => {
							$("#sesionOut").click();
						}, 2000);
					}
				});
			}
		});
	});
});
