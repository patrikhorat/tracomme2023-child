(function($) {
	$doc = $(document);

	$doc.ready( function() {
		function getHashValue(key) {
			var matches = location.hash.match(new RegExp(key+'=([^&]*)'));
			return matches ? matches[1] : null;
		}
		let currenthash = location.hash;
		let currentterm = getHashValue('tag');


		$(window).on('hashchange', function(){
			currenthash = location.hash;
			currentterm = getHashValue('tag');
			if( currenthash ) { $('a[data-term="' + currentterm +'"]').trigger('click');
			}
			else { 	$('a[data-term="all-terms"]').trigger('click'); }
		}).trigger('hashchange');
		 

		/**
		 * Retrieve posts
		 */
		function get_posts($params) {

			$container = $('#container-async');
			$content   = $container.find('.content');
	        $status    = $container.find('.status');

			$status.text('Loading...');

			$.ajax({
	            		url: bobz.ajax_url,
	            		data: {
	            			action: 'do_filter_posts',
					nonce: bobz.nonce,
					params: $params
	            		},
	            		type: 'post',
	            		dataType: 'json',
	            		success: function(data, textStatus, XMLHttpRequest) {
	            	
			            	if (data.status === 200) {
			            		$content.html(data.content);
			            	}
			            	else if (data.status === 201) {
			            		$content.html(data.message);	
			            	}
			            	else {
			            		$status.html(data.message);
			            	}
			         },
			         error: function(MLHttpRequest, textStatus, errorThrown) {

					$status.html(textStatus);
					
					/*console.log(MLHttpRequest);
					console.log(textStatus);
					console.log(errorThrown);*/
			         },
				complete: function(data, textStatus) {
					
					msg = textStatus;

	            	if (textStatus === 'success') {
	            		msg = data.responseJSON.found;
	            	}

	            	$status.text('Total ' + msg);
	            	/* Scroll to top after Page Turn*/
					$('html, body').animate({ scrollTop: 0 }, "fast");
	            	/*console.log(data);
	            	console.log(textStatus);*/
	            }
	        });
		}

		/**
		 * Bind get_posts to tag cloud and navigation
		 */
		$('#container-async').on('click', 'a[data-filter], .pagination a', function(event) {
			if(event.preventDefault) { event.preventDefault(); }

			$this = $(this);

			/**
			 * Set filter active
			 */
			if ($this.data('filter')) {
				$this.closest('ul').find('.active').removeClass('active');
				$this.parent('li').addClass('active');
				$page = $this.data('page');
			}
			else {
				/**
				 * Pagination
				 */
				$page = parseInt($this.attr('href').replace(/\D/g,''));
				$this = $('.nav-filter .active a');
				
			}
			

	        $params    = {
	        	'page' : $page,
	        	'tax'  : $this.data('filter'),
	        	'term' : $this.data('term'),
	        	'qty'  : $this.closest('#container-async').data('paged'),
	        };

	        // Run query
	        get_posts($params);

			location.hash = 'tag=' + $this.data('term');


		});
		

		if( currenthash ) { $('a[data-term="' + currentterm +'"]').trigger('click');
		}
		else { 	$('a[data-term="all-terms"]').trigger('click'); }

	});

})(jQuery);




  