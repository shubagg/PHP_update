 tabWrapper = $('#tab-block'),
    tabMnu = tabWrapper.find('.tab-mnu  .list-space'),
    tabContent = tabWrapper.find('.tab-cont > .tab-pane');
	tabContent.not(':first-child').hide();
	tabMnu.each(function(i) {
    $(this).attr('data-tab', 'tab' + i);
});
	tabContent.each(function(i) {
    $(this).attr('data-tab', 'tab' + i);
});

	tabMnu.click(function() {
    var tabData = $(this).data('tab');
    tabWrapper.find(tabContent).hide();
    tabWrapper.find(tabContent).filter('[data-tab=' + tabData + ']').show();
});

$('.tab-mnu > .list-space').click(function() {
    var before = $('.tab-mnu .list-space.active');
    before.removeClass('active');
    $(this).addClass('active');
});

// new

	$(".iframes-click").live("click", function() {
	    $(".iframes-show").toggle("slow");
	});
	$(".hide-show-show").hide();
	$(".hide-show").live("click", function() {
	    $(".hide-show-show").toggle("slow");
	});
	$(".watch-me").live("click", function() {
        $(".show-me:hidden").show('slow');
        $(".show-me-two").hide();
        $(".show-me-three").hide();
    });
    $(".watch-me").live("click", function() {
        if ($('.watch-me').prop('checked') === false) {
            $('.show-me').hide();
        }
    });
    $(".see-me").live("click", function() {
        $(".show-me-two:hidden").show('slow');
        $(".show-me").hide();
        $(".show-me-three").hide();
    });
    $(".see-me").live("click", function() {
        if ($('.see-me-two').prop('checked') === false) {
            $('.show-me-two').hide();
        }
    });
	$(".watch-me1").live("click", function() {
        $(".show-me1:hidden").show('slow');
        $(".show-me-two1").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me1").live("click", function() {
        if ($('.watch-me1').prop('checked') === false) {
            $('.show-me1').hide();
        }
    });
    $(".see-me1").live("click", function() {
        $(".show-me-two1:hidden").show('slow');
        $(".show-me1").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me1").live("click", function() {
        if ($('.see-me-two1').prop('checked') === false) {
            $('.show-me-two1').hide();
        }
    });
	$(".watch-me2").live("click", function() {
        $(".show-me2:hidden").show('slow');
        $(".show-me-two2").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me2").live("click", function() {
        if ($('.watch-me2').prop('checked') === false) {
            $('.show-me2').hide();
        }
    });
	$(".see-me2").live("click", function() {
        $(".show-me-two2:hidden").show('slow');
        $(".show-me2").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me2").live("click", function() {
        if ($('.see-me-two2').prop('checked') === false) {
            $('.show-me-two2').hide();
        }
    });
	$(".watch-me3").live("click", function() {
        $(".show-me3:hidden").show('slow');
        $(".show-me-two3").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me3").live("click", function() {
        if ($('.watch-me3').prop('checked') === false) {
            $('.show-me3').hide();
        }
    });
    $(".see-me3").live("click", function() {
        $(".show-me-two3:hidden").show('slow');
        $(".show-me3").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me3").live("click", function() {
        if ($('.see-me-two3').prop('checked') === false) {
            $('.show-me-two3').hide();
        }
    });
	$(".watch-me4").live("click", function() {
        $(".show-me4:hidden").show('slow');
        $(".show-me-two4").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me4").live("click", function() {
        if ($('.watch-me4').prop('checked') === false) {
            $('.show-me4').hide();
        }
    });
    $(".see-me4").live("click", function() {
        $(".show-me-two4:hidden").show('slow');
        $(".show-me4").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me4").live("click", function() {
        if ($('.see-me-two4').prop('checked') === false) {
            $('.show-me-two4').hide();
        }
    });
	$(".watch-me5").live("click", function() {
        $(".show-me5:hidden").show('slow');
        $(".show-me-two5").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me5").live("click", function() {
        if ($('.watch-me5').prop('checked') === false) {
            $('.show-me5').hide();
        }
    });
    $(".see-me5").live("click", function() {
        $(".show-me-two5:hidden").show('slow');
        $(".show-me5").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me5").live("click", function() {
        if ($('.see-me-two5').prop('checked') === false) {
            $('.show-me-two5').hide();
        }
    });
	$(".watch-me6").live("click", function() {
        $(".show-me6:hidden").show('slow');
        $(".show-me-two6").hide();
        $(".show-me-three6").hide();
    });
    $(".watch-me6").live("click", function() {
        if ($('.watch-me6').prop('checked') === false) {
            $('.show-me6').hide();
        }
    });
    $(".see-me6").live("click", function() {
        $(".show-me-two6:hidden").show('slow');
        $(".show-me6").hide();
        $(".show-me-three6").hide();
    });
    $(".see-me6").live("click", function() {
        if ($('.see-me-two6').prop('checked') === false) {
            $('.show-me-two6').hide();
        }
    });
	$(".new-me6").live("click", function() {
        $(".show-me-three6:hidden").show('slow');
        $(".show-me-two6").hide();
        $(".show-me6").hide();
    });
    $(".new-me6").live("click", function() {
        if ($('.see-me-three6').prop('checked') === false) {
            $('.show-me-three6').hide();
        }
    });
	$(".watch-me7").live("click", function() {
        $(".show-me7:hidden").show('slow');
        $(".show-me-two7").hide();
        $(".show-me-three7").hide();
    });
    $(".watch-me7").live("click", function() {
        if ($('.watch-me7').prop('checked') === false) {
            $('.show-me7').hide();
        }
    });
    $(".see-me7").live("click", function() {
        $(".show-me-two7:hidden").show('slow');
        $(".show-me7").hide();
        $(".show-me-three7").hide();
    });
    $(".see-me7").live("click", function() {
        if ($('.see-me-two7').prop('checked') === false) {
            $('.show-me-two7').hide();
        }
    });
    $(".new-me7").live("click", function() {
        $(".show-me-three7:hidden").show('slow');
        $(".show-me-two7").hide();
        $(".show-me7").hide();
    });
    $(".new-me7").live("click", function() {
        if ($('.see-me-three7').prop('checked') === false) {
            $('.show-me-three7').hide();
        }
    });
	$(".watch-me8").live("click", function() {
        $(".show-me8:hidden").show('slow');
        $(".show-me-two8").hide();
        $(".show-me-three8").hide();
    });
    $(".watch-me8").live("click", function() {
        if ($('.watch-me8').prop('checked') === false) {
            $('.show-me8').hide();
        }
    });
    $(".see-me8").live("click", function() {
        $(".show-me-two8:hidden").show('slow');
        $(".show-me8").hide();
        $(".show-me-three8").hide();
    });
    $(".see-me8").live("click", function() {
        if ($('.see-me-two8').prop('checked') === false) {
            $('.show-me-two8').hide();
        }
    });
    $(".new-me8").live("click", function() {
        $(".show-me-three8:hidden").show('slow');
        $(".show-me-two8").hide();
        $(".show-me8").hide();
    });
    $(".new-me8").live("click", function() {
        if ($('.see-me-three8').prop('checked') === false) {
            $('.show-me-three8').hide();
        }
    });
	$(".watch-me9").live("click", function() {
        $(".show-me9:hidden").show('slow');
        $(".show-me-two9").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me9").live("click", function() {
        if ($('.watch-me9').prop('checked') === false) {
            $('.show-me9').hide();
        }
    });
    $(".see-me9").live("click", function() {
        $(".show-me-two9:hidden").show('slow');
        $(".show-me9").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me9").live("click", function() {
        if ($('.see-me-two9').prop('checked') === false) {
            $('.show-me-two9').hide();
        }
    });
    $(".watch-me10").live("click", function() {
        $(".show-me10:hidden").show('slow');
        $(".show-me-two10").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me10").live("click", function() {
        if ($('.watch-me10').prop('checked') === false) {
            $('.show-me10').hide();
        }
    });


    $(".see-me10").live("click", function() {
        $(".show-me-two10:hidden").show('slow');
        $(".show-me10").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me10").live("click", function() {
        if ($('.see-me-two10').prop('checked') === false) {
            $('.show-me-two10').hide();
        }
    });
	$(".watch-me11").live("click", function() {
        $(".show-me11:hidden").show('slow');
        $(".show-me-two11").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me11").live("click", function() {
        if ($('.watch-me11').prop('checked') === false) {
            $('.show-me11').hide();
        }
    });
    $(".see-me11").live("click", function() {
        $(".show-me-two11:hidden").show('slow');
        $(".show-me11").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me11").live("click", function() {
        if ($('.see-me-two11').prop('checked') === false) {
            $('.show-me-two11').hide();
        }
    });
    $(".watch-me12").live("click", function() {
        $(".show-me12:hidden").show('slow');
        $(".show-me-two12").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me12").live("click", function() {
        if ($('.watch-me12').prop('checked') === false) {
            $('.show-me12').hide();
        }
    });


    $(".see-me12").live("click", function() {
        $(".show-me-two12:hidden").show('slow');
        $(".show-me12").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me12").live("click", function() {
        if ($('.see-me-two12').prop('checked') === false) {
            $('.show-me-two12').hide();
        }
    });

	$(".watch-me13").live("click", function() {
        $(".show-me13:hidden").show('slow');
        $(".show-me-two12").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me13").live("click", function() {
        if ($('.watch-me13').prop('checked') === false) {
            $('.show-me13').hide();
        }
    });


    $(".see-me13").live("click", function() {
        $(".show-me-two13:hidden").show('slow');
        $(".show-me13").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me13").live("click", function() {
        if ($('.see-me-two13').prop('checked') === false) {
            $('.show-me-two13').hide();
        }
    });

	$(".watch-me14").live("click", function() {
        $(".show-me14:hidden").show('slow');
        $(".show-me-two14").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me14").live("click", function() {
        if ($('.watch-me14').prop('checked') === false) {
            $('.show-me14').hide();
        }
    });


    $(".see-me14").live("click", function() {
        $(".show-me-two14:hidden").show('slow');
        $(".show-me14").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me14").live("click", function() {
        if ($('.see-me-two14').prop('checked') === false) {
            $('.show-me-two14').hide();
        }
    });

	$(".watch-me15").live("click", function() {
        $(".show-me15:hidden").show('slow');
        $(".show-me-two15").hide();
        //$(".show-me-three").hide();
    });
    $(".watch-me15").live("click", function() {
        if ($('.watch-me15').prop('checked') === false) {
            $('.show-me15').hide();
        }
    });
    $(".see-me15").live("click", function() {
        $(".#show-me-two15:hidden").show('slow');
        $(".show-me15").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me15").live("click", function() {
        if ($('.see-me-two15').prop('checked') === false) {
            $('.show-me-two15').hide();
        }
    });

	$("#watch-me16").live("click", function() {
    	$(".show-me16:hidden").show('slow');
    	$(".show-me-two16").hide();
	});
    $(".watch-me16").live("click", function() {
        if ($('.watch-me16').prop('checked') === false) {
            $('.show-me16').hide();
        }
    });

    $(".see-me16").live("click", function() {
        $(".show-me-two16:hidden").show('slow');
        $(".show-me16").hide();
        //$(".show-me-three").hide();
    });
    $(".see-me16").live("click", function() {
        if ($('.see-me-two16').prop('checked') === false) {
            $('.show-me-two16').hide();
        }
    });

    $(".watch-me17").live("click", function()
      {
        $(".show-me17:hidden").show('slow');
       $(".show-me-two17").hide();
       //$(".show-me-three").hide();
       });
       $(".watch-me17").live("click", function()
      {
        if($('.watch-me17').prop('checked')===false)
       {
        $('.show-me17').hide();
       }
      });


      $(".see-me17").live("click", function()
      {
        $(".show-me-two17:hidden").show('slow');
        $(".show-me17").hide();
       //$(".show-me-three").hide();
        });
      $(".see-me17").live("click", function() 
      {
        if($('.see-me-two17').prop('checked')===false)
       {
        $('.show-me-two17').hide();
       }
      });
	  
	  
	  
	  	$(".watch-me33").live("click", function() {
        $(".show-me33:hidden").show('slow');
        $(".show-me-two33").hide();
        $(".show-me-three33").hide();
    });
    $(".watch-me33").live("click", function() {
        if ($('.watch-me33').prop('checked') === false) {
            $('.show-me33').hide();
        }
    });
    $(".see-me33").live("click", function() {
        $(".show-me-two33:hidden").show('slow');
        $(".show-me33").hide();
        $(".show-me-three33").hide();
    });
    $(".see-me33").live("click", function() {
        if ($('.see-me-two33').prop('checked') === false) {
            $('.show-me-two33').hide();
        }
    });
    $(".new-me33").live("click", function() {
        $(".show-me-three33:hidden").show('slow');
        $(".show-me-two33").hide();
        $(".show-me33").hide();
    });
	  
	  
	  
	  

			
			//add elements

		
			 
		
		
		
		 
		
		
		
		
		
		//new drag and drop
			
		//new drag and drop
	
		
		
		
		;(function (factory) {
    if (typeof module === 'object' && typeof module.exports === 'object') {
        factory(require('jquery'), window, document);
    } else {
        factory(window.jQuery, window, document);
    }
}(function ( $, window, document, undefined ) {


    /**
     * Calculate scrollbar width
     *
     * Called only once as a constant variable: we assume that scrollbar width never change
     *
     * Original function by Jonathan Sharp:
     * http://jdsharp.us/jQuery/minute/calculate-scrollbar-width.php
     */
    var SCROLLBAR_WIDTH;

    function scrollbarWidth () {
        // Append a temporary scrolling element to the DOM, then measure
        // the difference between its outer and inner elements.
        var tempEl  = $('<div class="scrollbar-width-tester" style="width:50px;height:50px;overflow-y:scroll;top:-200px;left:-200px;"><div style="height:100px;"></div>'),
            width   = 0,
            widthMinusScrollbars = 0;

        $('body').append(tempEl);

        width = $(tempEl).innerWidth(),
        widthMinusScrollbars = $('div', tempEl).innerWidth();

        tempEl.remove();

        return (width - widthMinusScrollbars);
    }

    var IS_WEBKIT = 'WebkitAppearance' in document.documentElement.style;



    // SimpleBar Constructor
    function SimpleBar (element, options) {
        this.el = element,
        this.$el = $(element),
        this.$track,
        this.$scrollbar,
        this.dragOffset,
        this.flashTimeout,
        this.$contentEl         = this.$el,
        this.$scrollContentEl   = this.$el,
        this.scrollDirection    = 'vert',
        this.scrollOffsetAttr   = 'scrollTop',
        this.sizeAttr           = 'height',
        this.scrollSizeAttr     = 'scrollHeight',
        this.offsetAttr         = 'top';

        this.options = $.extend({}, SimpleBar.DEFAULTS, options);
        this.theme   = this.options.css;

        this.init();
    }

    SimpleBar.DEFAULTS = {
        wrapContent: true,
        autoHide: true,
        css: {
            container: 'simplebar',
            content: 'simplebar-content',
            scrollContent: 'simplebar-scroll-content',
            scrollbar: 'simplebar-scrollbar',
            scrollbarTrack: 'simplebar-track'
        }
    };

    SimpleBar.prototype.init = function () {
        // Measure scrollbar width
        if(typeof SCROLLBAR_WIDTH === 'undefined') {
            SCROLLBAR_WIDTH = scrollbarWidth();
        }

        // If scrollbar is a floating scrollbar, disable the plugin
        if(SCROLLBAR_WIDTH === 0) {
          this.$el.css('overflow', 'auto');

          return;
        }

        if (this.$el.data('simplebar-direction') === 'horizontal' || this.$el.hasClass(this.theme.container + ' horizontal')){
            this.scrollDirection    = 'horiz';
            this.scrollOffsetAttr   = 'scrollLeft';
           // this.sizeAttr           = 'width';
            this.scrollSizeAttr     = 'scrollWidth';
            this.offsetAttr         = 'left';
        }

        if (this.options.wrapContent) {
            this.$el.wrapInner('<div class="' + this.theme.scrollContent + '"><div class="' + this.theme.content + '"></div></div>');
        }

        this.$contentEl = this.$el.find('.' + this.theme.content);

        this.$el.prepend('<div class="' + this.theme.scrollbarTrack + '"><div class="' + this.theme.scrollbar + '"></div></div>');
        this.$track = this.$el.find('.' + this.theme.scrollbarTrack);
        this.$scrollbar = this.$el.find('.' + this.theme.scrollbar);

        this.$scrollContentEl = this.$el.find('.' + this.theme.scrollContent);

        this.resizeScrollContent();

        if (this.options.autoHide) {
            this.$el.on('mouseenter', $.proxy(this.flashScrollbar, this));
        }

        this.$scrollbar.on('mousedown', $.proxy(this.startDrag, this));
        this.$scrollContentEl.on('scroll', $.proxy(this.startScroll, this));

        this.resizeScrollbar();

        if (!this.options.autoHide) {
            this.showScrollbar();
        }
    };


    /**
     * Start scrollbar handle drag
     */
    SimpleBar.prototype.startDrag = function (e) {
        // Preventing the event's default action stops text being
        // selectable during the drag.
        e.preventDefault();

        // Measure how far the user's mouse is from the top of the scrollbar drag handle.
        var eventOffset = e.pageY;
        if (this.scrollDirection === 'horiz') {
            eventOffset = e.pageX;
        }
        this.dragOffset = eventOffset - this.$scrollbar.offset()[this.offsetAttr];

        $(document).on('mousemove', $.proxy(this.drag, this));
        $(document).on('mouseup', $.proxy(this.endDrag, this));
    };


    /**
     * Drag scrollbar handle
     */
    SimpleBar.prototype.drag = function (e) {
        e.preventDefault();

        // Calculate how far the user's mouse is from the top/left of the scrollbar (minus the dragOffset).
        var eventOffset = e.pageY,
            dragPos     = null,
            dragPerc    = null,
            scrollPos   = null;

        if (this.scrollDirection === 'horiz') {
          eventOffset = e.pageX;
        }

        dragPos = eventOffset - this.$track.offset()[this.offsetAttr] - this.dragOffset;
        // Convert the mouse position into a percentage of the scrollbar height/width.
        dragPerc = dragPos / this.$track[this.sizeAttr]();
        // Scroll the content by the same percentage.
        scrollPos = dragPerc * this.$contentEl[0][this.scrollSizeAttr];

        this.$scrollContentEl[this.scrollOffsetAttr](scrollPos);
    };


    /**
     * End scroll handle drag
     */
    SimpleBar.prototype.endDrag = function () {
        $(document).off('mousemove', this.drag);
        $(document).off('mouseup', this.endDrag);
    };


    /**
     * Resize scrollbar
     */
    SimpleBar.prototype.resizeScrollbar = function () {
        if(SCROLLBAR_WIDTH === 0) {
            return;
        }

        var contentSize     = this.$contentEl[0][this.scrollSizeAttr],
            scrollOffset    = this.$scrollContentEl[this.scrollOffsetAttr](), // Either scrollTop() or scrollLeft().
            scrollbarSize   = this.$track[this.sizeAttr](),
            scrollbarRatio  = scrollbarSize / contentSize,
            // Calculate new height/position of drag handle.
            // Offset of 2px allows for a small top/bottom or left/right margin around handle.
            handleOffset    = Math.round(scrollbarRatio * scrollOffset) + 2,
            handleSize      = Math.floor(scrollbarRatio * (scrollbarSize - 2)) - 2;


        if (scrollbarSize < contentSize) {
            if (this.scrollDirection === 'vert'){
                this.$scrollbar.css({'top': handleOffset, 'height': handleSize});
            } else {
                this.$scrollbar.css({'left': handleOffset, 'width': handleSize});
            }
            this.$track.show();
        } else {
            this.$track.hide();
        }
    };


    /**
     * On scroll event handling
     */
    SimpleBar.prototype.startScroll = function(e) {
        // Simulate event bubbling to root element
        this.$el.trigger(e);

        this.flashScrollbar();
    };


    /**
     * Flash scrollbar visibility
     */
    SimpleBar.prototype.flashScrollbar = function () {
        this.resizeScrollbar();
        this.showScrollbar();
    };


    /**
     * Show scrollbar
     */
    SimpleBar.prototype.showScrollbar = function () {
        this.$scrollbar.addClass('visible');

        if (!this.options.autoHide) {
            return;
        }
        if(typeof this.flashTimeout === 'number') {
            window.clearTimeout(this.flashTimeout);
        }

        this.flashTimeout = window.setTimeout($.proxy(this.hideScrollbar, this), 1000);
    };


    /**
     * Hide Scrollbar
     */
    SimpleBar.prototype.hideScrollbar = function () {
        this.$scrollbar.removeClass('visible');
        if(typeof this.flashTimeout === 'number') {
            window.clearTimeout(this.flashTimeout);
        }
    };


    /**
     * Resize content element
     */
    SimpleBar.prototype.resizeScrollContent = function () {
        if (IS_WEBKIT) {
            return;
        }

        if (this.scrollDirection === 'vert'){
            this.$scrollContentEl.width(this.$el.width()+SCROLLBAR_WIDTH);
            this.$scrollContentEl.height(this.$el.height());
        } else {
            this.$scrollContentEl.width(this.$el.width());
            this.$scrollContentEl.height(this.$el.height()+SCROLLBAR_WIDTH);
        }
    };


    /**
     * Recalculate scrollbar
     */
    SimpleBar.prototype.recalculate = function () {
        this.resizeScrollContent();
        this.resizeScrollbar();
    };


    /**
     * Getter for original scrolling element
     */
    SimpleBar.prototype.getScrollElement = function () {
        return this.$scrollContentEl;
    };


    /**
     * Getter for content element
     */
    SimpleBar.prototype.getContentElement = function () {
        return this.$contentEl;
    };


    /**
     * Data API
     */
    $(window).on('load', function () {
        $('[data-simplebar-direction]').each(function () {
            $(this).simplebar();
        });
    });


    /**
     * Plugin definition
     */
    var old = $.fn.simplebar;

    $.fn.simplebar = function (options) {
        var args = arguments,
            returns;

        // If the first parameter is an object (options), or was omitted,
        // instantiate a new instance of the plugin.
        if (typeof options === 'undefined' || typeof options === 'object') {
            return this.each(function () {

                // Only allow the plugin to be instantiated once,
                // so we check that the element has no plugin instantiation yet
                if (!$.data(this, 'simplebar')) { $.data(this, 'simplebar', new SimpleBar(this, options)); }
            });

        // If the first parameter is a string
        // treat this as a call to a public method.
        } else if (typeof options === 'string') {
            this.each(function () {
                var instance = $.data(this, 'simplebar');

                // Tests that there's already a plugin-instance
                // and checks that the requested public method exists
                if (instance instanceof SimpleBar && typeof instance[options] === 'function') {

                    // Call the method of our plugin instance,
                    // and pass it the supplied arguments.
                    returns = instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
                }

                // Allow instances to be destroyed via the 'destroy' method
                if (options === 'destroy') {
                  $.data(this, 'simplebar', null);
                }
            });

            // If the earlier cached method
            // gives a value back return the value,
            // otherwise return this to preserve chainability.
            return returns !== undefined ? returns : this;
        }
    };

    $.fn.simplebar.Constructor = SimpleBar;


    /**
     * No conflict
     */
    $.fn.simplebar.noConflict = function () {
        $.fn.simplebar = old;
        return this;
    };

}));

$('#cm-menu-scroller').simplebar();
$('#action-variable').simplebar();
$('#details-show').simplebar();
//$('#field_list').simplebar();
//$('#draggable_table').simplebar();
//$('#pdf-scroll').simplebar();



