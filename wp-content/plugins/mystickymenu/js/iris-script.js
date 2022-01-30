(function (factory) {
    "use strict";
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    }
    else if(typeof module !== 'undefined' && module.exports) {
        module.exports = factory(require('jquery'));
    }
    else {
        factory(jQuery);
    }
}(function ($, undefined) {
    var priceOptions = {"50_websites":{"1_year":{"price":79,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=3"},"2_year":{"price":125,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=15"},"lifetime":{"price":199,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=9"}},"500_websites":{"1_year":{"price":139,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=16"},"2_year":{"price":225,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=17"},"lifetime":{"price":359,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=18"}},"1000_websites":{"1_year":{"price":199,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=19"},"2_year":{"price":315,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=20"},"lifetime":{"price":499,"link":"https:\/\/go.premio.io\/?edd_action=add_to_cart&download_id=2199&edd_options[price_id]=21"}}};
    $(document).ready(function($){
        $('.my-color-field').wpColorPicker();
        $(document).on('click', '.sticky-header-upgrade-now', function(e){
            //e.preventDefault();
            //$(".sticky-header-menu ul li a:last").trigger("click");
        });

        $(document).on("click", ".pricing-table-content", function(){
            if(!$(this).hasClass("active")) {
                $(".pricing-table-content").removeClass("active");
                $(this).addClass("active");
                var datFor = $(this).data("option");
                $(".multiple-options").each(function(){
                    $(this).find("option").prop("selected", false);
                    $(this).find("option[data-option='"+datFor+"']").prop("selected", true);
                    $(this).trigger("change");
                })
            }
        });

        if($(".multiple-options").length) {
            $(".multiple-options").select2({
                minimumResultsForSearch: -1
            });
        }
        if($(".multiple-web-options").length) {
            $(".multiple-web-options").select2({
                minimumResultsForSearch: -1
            });
        }
        $(document).on("change", ".multiple-options", function(){
            priceText = $(this).find("option:selected").attr("data-header");
            thisValue = $(this).val();
            thisPrice = $(this).find("option:selected").attr("data-price");
            if(!$(this).hasClass("has-multiple-websites")) {
                $(this).closest(".price-table").find("a.cart-link").attr("href", thisValue);
                $(this).closest(".price-table").find(".plan-price").text("$" + thisPrice);
            } else {
                var webOption = $(".multiple-web-options").val();
                var priceSettings = priceOptions[webOption];
                var yearPlan = $(".multiple-options.has-multiple-websites option:selected").attr("data-option");
                if(priceSettings[yearPlan] != undefined) {
                    priceSettings = priceSettings[yearPlan];
                    thisValue = priceSettings.link;
                    thisPrice = priceSettings.price;
                }
            }
            thisOption = $(this).find("option:selected").attr("data-option");
            if(thisOption == "1_year") {
                thisPrice = thisPrice+"<span>/year</span>";
                priceText = "Renewals for <b>25% off</b>";
            } else if(thisOption == "2_year") {
                thisPrice = thisPrice+"<span>/2 years</span>";
                priceText = "Renewals for <b>25% off</b>";
            } else {
                thisPrice = thisPrice+"<span>/lifetime</span>";
                priceText = "For lifetime";
            }
            $(this).closest(".price-table").find("a.cart-link").attr("href", thisValue);
            $(this).closest(".price-table").find(".plan-price").html("$" + thisPrice);
            $(this).closest(".price-table").find(".price-offer").html(priceText);
        });

        $(document).on("change", ".multiple-web-options", function(){
            $(".multiple-options.has-multiple-websites").trigger("change");
        });

        if($(".multiple-options.has-multiple-websites").length) {
            $(".multiple-options.has-multiple-websites").trigger("change");
        }
        checkForPricingPos();
        $(window).on("scroll", function(){
            checkForPricingPos();
        });

        $(window).on("resize", function(){
            checkForPricingPos();
        });

        function checkForPricingPos() {
            $(".bottom-position").each(function(){
                if( $(this).offset().top - $(window).scrollTop() - $(window).height() < -3) {
                    $(this).closest(".price-table").removeClass("is-fixed");
                    $(this).closest(".price-table").find(".price-table-bottom").prop("style", "");
                } else {
                    $(this).closest(".price-table").addClass("is-fixed");
                    $(this).closest(".price-table").find(".price-table-bottom").css("top", ($(window).height() - 125 )+"px");
                    $(this).closest(".price-table").find(".price-table-bottom").css("left", $(this).offset().left+"px");
                    $(this).closest(".price-table").find(".price-table-bottom").outerWidth($(this).closest(".price-table").width());
                }
            });
        }
    });
}));