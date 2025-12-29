(function ($) {
	$(document).ready(function () {
		// Password Toggler
		jQuery(".password i").click(function () {
			let typeValue = jQuery("#password").attr("type");
			if (typeValue === "password") {
				jQuery("#password").attr("type", "text");
				jQuery(this).addClass("fa-eye-slash");
			} else {
				jQuery("#password").attr("type", "password");
				jQuery(this).removeClass("fa-eye-slash");
			}
		});
		jQuery(".re_password i").click(function () {
			let typeValue = jQuery("#re_password").attr("type");
			if (typeValue === "password") {
				jQuery("#re_password").attr("type", "text");
				jQuery(this).addClass("fa-eye-slash");
			} else {
				jQuery("#re_password").attr("type", "password");
				jQuery(this).removeClass("fa-eye-slash");
			}
		});
	});
})(jQuery);
