(function(e){e(".menu-toggle > a").on("click",function(t){t.preventDefault(),e("#responsive-nav").toggleClass("active")}),e(".cart-dropdown").on("click",function(t){t.stopPropagation()}),e(".products-slick").each(function(){var t=e(this),s=t.attr("data-nav");t.slick({slidesToShow:4,slidesToScroll:1,autoplay:!0,infinite:!0,speed:300,dots:!1,arrows:!0,appendArrows:s||!1,responsive:[{breakpoint:991,settings:{slidesToShow:2,slidesToScroll:1}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]})}),e(".products-widget-slick").each(function(){var t=e(this),s=t.attr("data-nav");t.slick({infinite:!0,autoplay:!0,speed:300,dots:!1,arrows:!0,appendArrows:s||!1})}),e("#product-main-img").slick({infinite:!0,speed:300,dots:!1,arrows:!0,fade:!0,asNavFor:"#product-imgs"}),e("#product-imgs").slick({slidesToShow:3,slidesToScroll:1,arrows:!0,centerMode:!0,focusOnSelect:!0,centerPadding:0,vertical:!0,asNavFor:"#product-main-img",responsive:[{breakpoint:991,settings:{vertical:!1,arrows:!1,dots:!0}}]});var o=document.getElementById("product-main-img");o&&e("#product-main-img .product-preview").zoom()})(jQuery);