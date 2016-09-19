

//add item to cart header
;(function (jQuery) {
    jQuery.fn.updateVirtueMartCartModule = function (arg) {
        var options = jQuery.extend({}, jQuery.fn.updateVirtueMartCartModule.defaults, arg);
        return this.each(function () {
            jQuery.ajaxSetup({ cache: false })
            zo2.cart.generate();
        });
    };

    // Definition Of Defaults
    jQuery.fn.updateVirtueMartCartModule.defaults = {
        name1: 'value1'
    };

})(jQuery);

jQuery(document).ready(function($){
     
 
 

    jQuery("#zt_list_product").owlCarousel({
        items : 3,
        navigation : true
    });
 

    var id = jQuery('.sticky-wrapper').attr('id');
    if( typeof id == 'undefined'){
        jQuery('#zo2-top-wrap').addClass('no-sticky');
    }

    
 

    jQuery('#zt_top_cart .zt-cart-inner').hide();
    var winWidth = jQuery(window).width();
        if (winWidth >= 768){

            jQuery('#zt_top_cart .zt-cart-inner').hide();
            jQuery("#zo2-top-cart #zt_top_cart").hover(
                function(){
                    jQuery(this).addClass("control-active").find(".zt-cart-inner").slideDown(200);
                },
                function(){
                    jQuery(this).removeClass("control-active").find(".zt-cart-inner").slideUp(200);
                }
            );

            jQuery('.zt-cart-inner').hide();
            jQuery("#mod_compare").hover(
                function(){
                    jQuery(this).addClass("control-active").find(".zt-cart-inner").slideDown(200);
                },
                function(){
                    jQuery(this).removeClass("control-active").find(".zt-cart-inner").slideUp(200);
                }
            );
            jQuery('.zt-cart-inner').hide();
            jQuery("#mod_wishlists").hover(
                function(){
                    jQuery(this).addClass("control-active").find(".zt-cart-inner").slideDown(200);
                },
                function(){
                    jQuery(this).removeClass("control-active").find(".zt-cart-inner").slideUp(200);
                }
            );
            jQuery("#zt_top_cart #cart").click(
                function(){
                    jQuery('.cart-top-header').addClass("control-active");
                    jQuery('body').addClass("show-cart");
                }
            );
      

        }


    jQuery('.zt-cart-innera').hide();
        var $clicked=jQuery('#zo2-top-menu-wrap #zo2-position-0 .ajax-dropdown');
            $clicked.click(function() {
       
                if(jQuery(this).hasClass('active')){
                    jQuery(this).removeClass('active');
                    
                }else{
                    $clicked.removeClass('active');
             
                    jQuery(this).addClass('active');
                }

            });
        
 

      var owl_header = jQuery("#owl-header-news");
     
      owl_header.owlCarousel({
          items : 1,
          autoPlay: true,
          pagination: false,
      });
     
      // Custom Navigation Events
      jQuery(".owl-next").click(function(){
        owl.trigger('owl.next');
      })
      jQuery(".owl-prev").click(function(){
        owl.trigger('owl.prev');
      })
      


    jQuery('#zo2-position-0 .zt-cart-inner').hide();
    jQuery("#zo2-position-0 #zt_top_cart, #zo2-position-0 #mod_compare, #zo2-position-0 #mod_wishlists").hover(
        function(){
            jQuery(this).addClass("control-active").find(".zt-cart-inner").slideDown(200);
        },
        function(){
            jQuery(this).removeClass("control-active").find(".zt-cart-inner").slideUp(200);
        }
    );

    if(jQuery('#containt').find('.col-right').length>0){
        jQuery('#containt .col-md-9.containt').addClass('add-position');
    }

   jQuery('#zt_top_cart .cart-ajax-del').click(function(){
        jQuery('#zt_top_cart .cart-row').addClass('add-position');
    });
    
    
      function stickysidebar() {
        if ($('.sidebar-fixed')[0]) {
            $('.sidebar-fixed').wrapInner('<div class="sidebar-fixed-block"></div>');
            jQuery(window).resize(function () {
                if (jQuery(window).width() > 980) {
                    var wrappH, itemH, maxMove, item;
                    $('.wrapper-sidebar-fixed').each(function () {
                        wrappH = $(this).height();
                        itemH = $(this).find('.sidebar-fixed').height();
                        item = $(this).find('.sidebar-fixed-block');
                        maxMove = wrappH - itemH;
                        item.data('maxMove', maxMove);
                    })
                    jQuery(window).bind("scroll", function () {
                        $('.wrapper-sidebar-fixed').each(function () {
                            var toTop;
                            if($(this).find('.sidebar-fixed')[0]) {
                                var wrapptoTop = $(this).find('.sidebar-fixed').offset().top;
                                item = $(this).find('.sidebar-fixed-block');
                                maxMove = item.data('maxMove');
                                toTop = $(window).scrollTop() - wrapptoTop;
                                if (toTop > 0 && toTop <= maxMove) {
                                    item.css('padding-top', toTop + 'px');
                                }
                                if ($(window).scrollTop() < wrapptoTop) {
                                    item.css('padding-top', 0 + 'px');
                                }
                                if (toTop > maxMove) {
                                    item.css('padding-top', maxMove + 'px');
                                }
                            }
                        })
                    });
                }
            }).resize();
        }
    }
        //Show Comment form  
        var $this=jQuery('#jc');
        var height=$this.outerHeight();
        $this.height(height).addClass('hiddenform');
        jQuery('#reply-title span, .comment-reply-link, .add-cmt').on('click',function(){
            $this.removeClass('hiddenform');
        });
        jQuery('#cancel-comment-reply-link').on('click',function(){
            $this.addClass('hiddenform');
        });  
        
  
        (function($){
        	$.fn.equalboxes = function(){
        		var maxheight = 0,
        			rowheight = 0,
        			rowstart = 0,
        			height = 0,
        			boxes = [],
        			top = 0,
        			jel = null;
        
        		//all equalheight (item will not align like a mess)
        		this.each(function(){
        			jel = $(this);
        			height = jel.css({'height': '', 'min-height': ''}).removeClass('eq-first').height();
        
        			if(height > maxheight){
        				maxheight = height;
        			}
        
        			jel.data('orgHeight', height);
        
        		}).css('min-height', maxheight);
        
        		//per row equal-height
        		this.each(function() {
        			jel = $(this);
        			height = jel.data('orgHeight');
        			top = jel.position().top;
        
        			if (rowstart != top) {
        				boxes.length && $(boxes).css('min-height', rowheight + 1).eq(0).addClass('eq-first');
        
        				// set the variables for the new row
        				boxes.length = 0;
        				rowstart = jel.position().top;
        				rowheight = height;
        				boxes.push(this);
        
        			} else {
        				boxes.push(this);
        				if(height > rowheight){
        					rowheight = height;
        				}
        			}
        		});
        
        		boxes.length && $(boxes).css('min-height', rowheight + 1).eq(0).addClass('eq-first');
        
        		return this;
        	};
        
        	$.fn.eqboxs = function(){
        		
        		//should be more than two elements
        		if(this.length < 2){
        			return this;
        		}
        
        		var elms = this,
        			rzid = null,
        			resize = function () {
        				elms.equalboxes();
        			};
        
        		$(window).load(function(){
        			//trigger one
        			elms.equalboxes();
        
        			clearTimeout(rzid);
        			rzid = setTimeout(resize, 2000); //just in case something new loaded
        		}).on('resize.eqb', function(){
        			clearTimeout(rzid);
        			rzid = setTimeout(resize, 200);
        		});
        
        		//trigger one
        		elms.equalboxes();
        
        		return this;
        	};
        
        })(jQuery);
        
        jQuery('.ssheight .zt-main-items.row').children().eqboxs();
    
    jQuery(window).load(function(){
        stickysidebar(); 
    })
}(jQuery));
  
  
  