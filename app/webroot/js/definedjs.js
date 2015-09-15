$(document).ready(function() {
	$(".view").each( function() {
		if($(this).attr("flag") == 1) {
			$(this).on("click", function() {
				var filename = $(this).attr('value');
				loadPDF(filename);
			});
		}
	});

	function loadPDF(filename) {
		var pdf = new PDFObject({
			url: "http://localhost/pviewer/sheets/"+filename+".pdf",
			id: "pdfRenderer",
			pdfOpenParams: {
				view: "FitH"
			}
		}).embed("pdfRenderer");
	}

	$(".glyphicon").each(function() {
		if ($(this).attr("flag") == 0) {
			$(this).removeAttr("href");
			$(this).attr("disabled", "disabled");
		}
	});
});