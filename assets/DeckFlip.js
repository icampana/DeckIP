(function($){
	
	$(document).ready(function(){
		

		$('.flipdeck-block').each(function(index){
			var $image = $(this).find('img');
			var context = this;

			$($image).load(function(){
				var height = $(this).height();
				if (height > 0 ){
					$(context).css('height',  height + 'px');
				}
			});
		});

		if ( $('html').hasClass('csstransforms3d') ) {
			$('.flipdeck-block').removeClass('slide').addClass('flip');
			$('.flipdeck-block.flip').on('mouseenter',
				function () {
					$(this).find('.front').addClass('theFlip');
				});
			$('.flipdeck-block.flip').on('mouseleave',
				function () {
					$(this).find('.front').removeClass('theFlip');
				});
		} else {
			$('.flipdeck-block').on('mouseenter',
				function () {
					$(this).find('.detail').stop().animate({bottom:0}, 500, 'easeOutCubic');
				});
			$('.flipdeck-block').on('mouseleave',
				function () {
					$(this).find('.detail').stop().animate({bottom: ($(this).height() + -1) }, 500, 'easeOutCubic');
				});
		}

		
		$(".deck-block").hover(function(){
			// Enter
			var $over = $(this).find('.deck-overflow');
			var $text =  $(this).find('.deck-text');
			
//			$(this).find('.deck-title').animate({bottom : '10px'});
			$text.css('margin-top', -$text.outerHeight()/2);

			$text.slideDown();
			
			var bgcolor = $(this).attr('data-color');
			
			if (bgcolor != '') {
				$over.css('background-color', bgcolor);
			}
			
			$over.css('width', $(this).width() + 'px');
			$over.css('height', $(this).height() + 'px');
			$over.fadeIn();
		}, function(){
			// Leaves
			$(this).find('.deck-text').slideUp();
//			$(this).find('.deck-title').animate({ bottom: '20px'});
			$(this).find('.deck-overflow').fadeOut();
		});
	});
	
})(jQuery);
