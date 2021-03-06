;(function($) {

	BlankWooMiniCart = function($scope) {
		this.node                 = $scope;
		this.wrap                 = $scope.find('.blank-woo-mini-cart-container');
		
		//this.id 				= settings.id;
		//this.node 				= $('.fl-node-' + this.id);
		//this.wrap 				= this.node.find('.woopack-mini-cart');
		this.behaviour 			= this.wrap.data('target');

		this._init();
	};

	BlankWooMiniCart.prototype = {
		id: '',
		node: '',
		wrap: '',
		element: '',
		behaviour: '',
		isPreview: false,

		_init: function() {
			this.element = this.node.find('a.blank-woo-cart-contents');
			
			this._bindEvents();
		},

		_bindEvents: function() {
			var self = this;

			if ( 'on-click' === this.behaviour ) {
				this.element.on('click', $.proxy( this._toggleCart, this ) );
			}

			if ( 'on-hover' === this.behaviour ) {
				this.element.on('mouseover', function(e) {
					e.preventDefault();

					self._showCart();
				});
				this.node.find('.blank-woo-mini-cart-items').on('mouseover', function(e) {
					e.preventDefault();

					self._showCart();
				});
				this.element.on('mouseout', function(e) {
					e.preventDefault();

					self._hideCart();
				});
				this.node.find('.blank-woo-mini-cart-items').on('mouseout', function(e) {
					e.preventDefault();

					self._hideCart();
				});
			}

			$('body').delegate('.woopack-mini-cart-preview', 'click', $.proxy( this._togglePreview, this ));

			$(document).on('click', function(e) {
				if ( ! self.isPreview ) {
					if ( ! self.wrap.is(e.target) && self.wrap.has(e.target).length === 0 && e.which ) {
						self._hideCart();
					}
				}
			});
		},

		_showCart: function() {
			this.node.find('.blank-woo-mini-cart-items').addClass('show-mini-cart');
		},

		_hideCart: function() {
			this.node.find('.blank-woo-mini-cart-items').removeClass('show-mini-cart');
		},

		_toggleCart: function(e) {
			e.preventDefault();
			this.node.find('.blank-woo-mini-cart-items').toggleClass('show-mini-cart');
		},

		_togglePreview: function() {
			if ( ! this.isPreview ) {
				this.isPreview = true;
				this._showCart();
			} else {
				this.isPreview = false;
				this._hideCart();
			}
		},

		_renderPreview: function() {
			this.isPreview = true;
			this._showCart();
		},
	};

})(jQuery);