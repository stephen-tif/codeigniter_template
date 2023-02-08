jQuery(function ($) {
	$(document).ready(function () {
		if ($(window).width() <= 900) {
			setTimeout(function () {
				$("#close-sidebar").click();
				$(".btn").removeClass("btn-lg");
				$("table").addClass("table-sm");
			}, 500);
		}
	});

	//event swiped from swipe.js
	$(document).on("swiped-left", "#sidebar", () => {
		$("#close-sidebar").click();
	});
	/*
    $(document).on("swiped-right",".page-content",()=>{
      $("#show-sidebar").click();
    });
  */
	$(".sidebar-dropdown > a").click(function () {
		$(".sidebar-submenu").slideUp(200);
		if ($(this).parent().hasClass("active")) {
			$(".sidebar-dropdown").removeClass("active");
			$(this).parent().removeClass("active");
		} else {
			$(".sidebar-dropdown").removeClass("active");
			$(this).next(".sidebar-submenu").slideDown(200);
			$(this).parent().addClass("active");
		}
	});

	$("#close-sidebar").click(function () {
		$(".page-wrapper").removeClass("toggled");
	});
	$("#show-sidebar").click(function () {
		$(".page-wrapper").addClass("toggled");
	});
});

//hora tiempo real
setInterval(function () {
	$(".date-card").empty();
	var d = new Date();
	var mm = d.getMonth() + 1;
	var dd = d.getDate();
	var yy = d.getFullYear();
	var hours = d.getHours();
	var seconds = d.getSeconds();
	var minutes = ("0" + d.getMinutes()).slice(-2);
	hours = (hours + 24) % 24;
	var ampm = "am";
	if (hours == 0) {
		hours = 12;
	} else if (hours > 12) {
		hours = hours % 12;
		ampm = "pm";
	}
	hours = ("0" + hours).slice(-2);
	var dt =
		"<i class='fas fa-calendar-alt fa-sm'></i>" +
		" Fecha: " +
		(dd < 10 ? "0" : "") +
		dd +
		"/" +
		(mm < 10 ? "0" : "") +
		mm +
		"/" +
		yy +
		" <br>" +
		"<i class='fas fa-clock fa-sm'></i>" +
		" Hora: " +
		hours +
		": " +
		minutes +
		" " +
		ampm;
	$(".date-card").html(dt);
}, 500);

$(document).on("click", "#logout", () => {
	$("#modalLogout").modal({ backdrop: "static", keyboard: false });
});


$(document).on("click", "#sesionOut", function () {
	//para eliminar las sesiones de JS
	$.ajax({
		type: "POST",
		dataType: "JSON",
		url: "login/logout",
	}).done(() => {
		$("#modalLogout").modal("hide");
		location.href = "login";
	});
});
