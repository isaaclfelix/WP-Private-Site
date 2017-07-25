jQuery(function($) {
	function removeUserFromWhiteList(user) {
		var username = user.attr('id');
		var user_hidden_input = $('input[value="' + username + '"]');
		user_hidden_input.remove();
		user.remove();
	}
	$(".wp_private_site_users").find("input[type='submit']").on("click", function(e) {
		e.preventDefault();
		var select_value = $(".wp_private_site_users").find("select").val();
		if (select_value != 0) {
			if ($('.wp_private_site_users').find('input[value="' + select_value + '"]').length == 0) {
				var no_users = $(".allowed-users").find('.no-users-whitelisted');
				if (no_users.length != 0) {
					no_users.remove();
				}		
				$(".wp_private_site_users").append('<input type="hidden" value="' + select_value + '" name="wp_private_site_allowed_users[' + select_value + ']" />');	
				var added_user = $(".allowed-users").append('<li class="allowed-user" id="' + select_value + '">' + select_value + ' <span class="dashicons dashicons-dismiss remove"></span></li>');
				added_user.find('#'+select_value).on('click', function() {
					var user = $(this).closest('.allowed-user');
					removeUserFromWhiteList(user);
				});				
			}
			else {
				$('.wp_private_site_users').append('<div class="error notice"><p>User already whitelisted</p></div>');
			}
		}
	});
	$('.allowed-user').find('.remove').each(function() {
		$(this).on('click', function() {
			var user = $(this).closest('.allowed-user');
			removeUserFromWhiteList(user);
		});
	});
	$.widget("custom.combobox", {
		_create: function() {
			this.wrapper = $( "<span>" )
			.addClass( "custom-combobox" )
			.insertAfter( this.element );
			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},
		_createAutocomplete: function() {
			var selected = this.element.children( ":selected" ),
			value = selected.val() ? selected.text() : "";
			this.input = $( "<input>" )
			.appendTo( this.wrapper )
			.val( value )
			.attr( "title", "" )
			.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
			.autocomplete({
				delay: 0,
				minLength: 0,
				source: $.proxy( this, "_source" )
			})
			.tooltip({
				classes: {
					"ui-tooltip": "ui-state-highlight"
				}
			});
			this._on( this.input, {
				autocompleteselect: function( event, ui ) {
					ui.item.option.selected = true;
					this._trigger( "select", event, {
						item: ui.item.option
					});
				},
				autocompletechange: "_removeIfInvalid"
			});
		},
		_createShowAllButton: function() {
			var input = this.input,
			wasOpen = false;
			$("<a>")
			.attr("tabIndex", -1)
			.attr("title", "Show All Items")
			.tooltip()
			.appendTo( this.wrapper )
			.button({
				icons: {
				primary: "ui-icon-triangle-1-s dashicons-before dashicons-smiley"
				},
				text: false
			})
			.removeClass("ui-corner-all")
			.addClass("custom-combobox-toggle ui-corner-right")
			.on("mousedown", function() {
				wasOpen = input.autocomplete("widget").is(":visible");
			})
			.on("click", function() {
				input.trigger("focus");
				if (wasOpen) {
					return;
				}
				input.autocomplete("search", "");
			});
		},
		_source: function(request, response) {
			var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
			response(this.element.children("option").map(function() {
				var text = $(this).text();
				if (this.value && (!request.term || matcher.test(text)))
				return {
					label: text,
					value: text,
					option: this
				};
			}));
		},
		_removeIfInvalid: function(event, ui) {
			if (ui.item) {
				return;
			}
			var value = this.input.val();
			var valueLowerCase = value.toLowerCase();
			var valid = false;
			this.element.children("option").each(function() {
				if ($(this).text().toLowerCase() === valueLowerCase) {
					this.selected = valid = true;
					return false;
				}
			});
			if (valid) {
				return;
			}
			this.input
			.val("")
			.attr("title", value + " didn't match any item")
			.tooltip("open");
			this.element.val("");
			this._delay(function() {
				this.input.tooltip("close").attr("title", "");
			}, 2500);
			this.input.autocomplete("instance").term = "";
		},
		_destroy: function() {
			this.wrapper.remove();
			this.element.show();
		}
	});
	
	$("#combobox").combobox();
	$( "#toggle" ).on( "click", function() {
		$( "#combobox" ).toggle();
	});
});