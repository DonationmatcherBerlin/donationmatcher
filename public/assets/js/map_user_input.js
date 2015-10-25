(function($) {
	$.fn.mapUserName = function(baseInput) {
		var $self = $(this);
		function onInput() {
			$self.val($(this).val().toLowerCase()
						.replace(/ä/g, 'ae')
						.replace(/ö/g, 'oe')
						.replace(/ü/g, 'ue')
						.replace(/ß/g, 'ss')
						.replace(/[^a-z0-9]/g, ''));
		};
		function offInput() {
			baseInput.off('input', onInput);
			$self.off('input', offInput);
		};
		baseInput = $(baseInput);
		baseInput.on('input', onInput);
		$self.on('input', offInput);
	};
})(jQuery);
