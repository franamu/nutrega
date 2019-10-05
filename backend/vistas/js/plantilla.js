/* iCheck */
$('input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' // optional
});

/* jQueryKnob */
$('.knob').knob();

/* SideBar Menu */
$('.sidebar-menu').tree();

//Colorpicker
$('.my-colorpicker').colorpicker();


//Tags Input
$(".tagsInput").tagsinput({
	maxTags: 10,
	confirmKeys: [44],
	cancelConfirmKeysOnEmpty: false,
 	trimValue: false
})

$(".bootstrap-tagsinput").css({"padding":"11px",
							   "width":"100%",
 							   "border-radius":"1px"})

//Datepicker	
$('.datepicker').datepicker({
	format: 'yyyy-mm-dd 23:59:59',
	startDate: '0d'
});