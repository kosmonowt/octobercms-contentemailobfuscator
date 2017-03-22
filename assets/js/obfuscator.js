/**
 * 
 * This one observes domtree manipulation to catch problems with obfuscated email tags.
 *
 **/
$(document).ready(function(){
	if ($(".kkobfreverter").length) {
		$(".kkobfreverter").each(function(){
			var sis = $(this);
			sis.children("script").remove();
			sis.children("a").addClass("kkobfrevertermail").insertAfter(sis);
			sis.remove();
		});
	}
});