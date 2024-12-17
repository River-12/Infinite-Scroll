define(["jquery", "jquery/ui", "domReady!"], function ($) {
    "use strict";
    $.widget("mage.ScrollScript", {
        options: {
            scrollProductButton: "#scroll-product-button",

            productItem: ".item.product.product-item",
            productItemList: ".products.list.items.product-items",
            form: "form[data-role='tocart-form']",
            scrollStart: 50,
            endPageText: "END",
            next: ".next",
            lists: [],
        },
        _create: function () {
            this.initialize();
        },
        initialize: function () {
            $("#back-product-button-link").hide();
            $("#back-button").hide();

            let self = this,
                initialUrl = $(self.options.next).attr("href");
            if (typeof initialUrl === "undefined") {
                $("#scroll-button-link").hide();
                $("#scroll-loader").hide();
                $("#back-button").hide();
            } else {
                if (self.options.LoaderType) {
                    $("#scroll-button-link").click(function () {
                        let url = $(".next").attr("href");
                        if (typeof url !== "undefined") {
                            self.autoLoadProducts(url);
                        }
                    });
                } else {
                    if ($(window).scrollTop() > 0) {
                        let url = $(".next").attr("href");
                        self.autoLoadProducts(url);
                        self.options.lists.push(url);
                    }
                    $(window).scroll(function () {
                        if (
                            $(window).scrollTop() >=
                            (self.options.scrollStart / 100) *
                                ($(document).height() - $(window).height())
                        ) {
                            let url = $(".next").attr("href");
                            if (
                                typeof url != "undefined" &&
                                !self.options.lists.includes(url)
                            ) {
                                self.autoLoadProducts(url);
                                self.options.lists.push(url);
                            }
                        }
                    });
                }
            }
            self.backToTop();
        },

        backToTop: function () {
            $("#back-button").click(function () {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
        },
        autoLoadProducts: function (url) {
            if (url === undefined) {
                url = window.location.href;
            }
            let self = this;
            let childProduct = false;

            $.get(url, function (options) {
                let productArr = $(options).find(self.options.productItem);
                let link = $(options).find(".next").attr("href");

                $.each(productArr, function (index, value) {
                    let length = $(value.firstElementChild.attributes.length);
                    if (length !== 1) {
                        childProduct = true;
                        $(self.options.productItemList)
                            .append(value)
                            .trigger("contentUpdated");
                        $(self.options.form).catalogAddToCart();
                    }
                });
                if ($.fn.applyBindings !== undefined) {
                    productArr.applyBindings();
                }

                if (typeof link === "undefined" || !childProduct) {
                    $("#back-button").show();
                    $(self.options.scrollProductButton).html(
                        "<em>" + self.options.endPageText + "</em>"
                    );
                    $("#scroll-button-link").hide();
                } else {
                    $(".next").attr("href", link);
                }
            });
        },
    });
    return $.mage.ScrollScript;
});
