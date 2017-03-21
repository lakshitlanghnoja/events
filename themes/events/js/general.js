$(document).ready(function(){

	$("a[href='#']").click(function(e){
		e.preventDefault();
	});

	//small header
	$(window).scroll(function(){
		if($(window).scrollTop() > 100){
			$(".wrapper").addClass("small-header");
		}else{
			$(".wrapper").removeClass("small-header");
		}
	});

	//imagefill
	//("#banner-slider").imagefill();

	//datepicker
	$( "#datepicker" ).datepicker();

	//Custom Dropdown
	$(".custom-dropdown").dropkick({
		mobile: true
	});
	
	//resize function
	$(window).resize(function(){
	//	$("#banner-slider").imagefill();
	});
});
