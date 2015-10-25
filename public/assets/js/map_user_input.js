(function($) {
	$.fn.map_user_input = function(baseInput) {
		var $self = $(this);
		var onInput = function() {
			$self.val($(this).val().toLowerCase()
						.replace(/ä/g, 'ae')
						.replace(/ö/g, 'oe')
						.replace(/ü/g, 'ue')
						.replace(/ß/g, 'ss')
						.replace(/[^a-z0-9]/g, ''));
		};
		baseInput.on('input', onInput);
		$self.on('input', function() { baseInput.off('input', onInput); });
	};
})(jQuery);
