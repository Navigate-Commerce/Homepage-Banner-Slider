/**
 * Navigate Commerce
 *
 * @author        Navigate Commerce
 * @package       Navigate_HomepageBannerSlider
 * @copyright     Copyright (c) Navigate (https://www.navigatecommerce.com/)
 * @license       https://www.navigatecommerce.com/end-user-license-agreement
 */

require(["jquery","navigate/bannerslider/owl.carousel"],function($) {
    var bannerSlider_items = window.bannerSliderData.bannerSlider_items;
    var bannerSlider_infinite = window.bannerSliderData.bannerSlider_infinite;
    var bannerSlider_showDots = window.bannerSliderData.bannerSlider_showDots;
    var bannerSlider_autoplay = window.bannerSliderData.bannerSlider_autoplay;
    var bannerSlider_showArrow = window.bannerSliderData.bannerSlider_showArrow;
    var bannerSlider_itemMobile = window.bannerSliderData.bannerSlider_itemMobile;
    var bannerSlider_itemDesktop = window.bannerSliderData.bannerSlider_itemDesktop;
    var bannerSlider_autoplayTimeout = window.bannerSliderData.bannerSlider_autoplayTimeout;

    function HomepageBannerSlider() {
        if (jQuery(window).width() < 767) {
            jQuery(".desktop-section-bannerslider").remove();
            jQuery(".mobile-section-bannerslider").show();
        } else {
            jQuery(".mobile-section-bannerslider").remove();
            jQuery(".desktop-section-bannerslider").show();
        }
    }

    jQuery(document).ready(function () {
        HomepageBannerSlider();
        jQuery(window).resize(function(){
            HomepageBannerSlider();
        });

        if(bannerSlider_items > 1) {
            jQuery('.main-home-slider').css('display', "block").owlCarousel({
                loop: bannerSlider_infinite,
                responsiveClass: true,
                dots: bannerSlider_showDots,
                nav: bannerSlider_showArrow,
                autoplay: bannerSlider_autoplay,
                autoplayTimeout: bannerSlider_autoplayTimeout,
                responsive : {
                    0:{
                        nav: false,
                        items: bannerSlider_itemMobile
                    },
                    768:{
                        nav: bannerSlider_showArrow,
                        items: bannerSlider_itemDesktop
                    }
                }
            });
            window.dispatchEvent(new Event('resize'));
        }
    });
});