<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="{{asset('admin/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('client/js/vendor/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{asset('client/js/main.js')}}"></script>
<script src="{{asset('client/js/clipboard.min.js')}}"></script>
<script src="{{asset('client/js/scripts.js')}}"></script>
<script src="{{asset('client/js/custom-validation.js')}}"></script>
<script src="{{asset('client/js/share.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>

<script>
    jQuery(document).ready(function () {


        $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);　
        });

        

        $.validator.addMethod('ValidEmail', function(value, element) {
            return this.optional(element) || value.match(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/);
        }, "Please enter a valid email address.");
        jQuery("#back-top").hide();
        jQuery(function () {
            jQuery(window).scroll(function () {
                if (jQuery(this).scrollTop() > 100) {
                    jQuery('#back-top').fadeIn();
                } else {
                    jQuery('#back-top').fadeOut();
                }
            });
            jQuery('#back-top').click(function () {
                jQuery('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    });
</script>

<script>
    $(document).ready(function () {

        var menu = {
            init: function () {
                // store element for letter use
                this.ToogleMenuSwitch = $('.js-menu-trigger');
                this.MenuElement = $('.main-nav');
                this.OverlayElement = $('.page-overlay');

                // handle main menu open and close
                this.mainMenu();
            },
            mainMenu: function () {
                this.ToogleMenuSwitch.on('click', $.proxy(this.checkState, this));
                this.OverlayElement.on('click', $.proxy(this.checkState, this));
            },
            checkState: function () {
                this.ToogleMenuSwitch.hasClass('menu-close') ? this.openMenu() : this.closeMenu();
            },
            OverlayCheckState: function () {
                this.OverlayElement.hasClass('menu-close') ? this.openMenu() : this.closeMenu();
            },
            openMenu: function () {
                this.ToogleMenuSwitch.removeClass('menu-close').addClass('menu-open');
                this.MenuElement.removeClass('menu-close').addClass('menu-open');
                this.OverlayElement.removeClass('menu-close').addClass('menu-open');
            },
            closeMenu: function () {
                this.ToogleMenuSwitch.removeClass('menu-open').addClass('menu-close');
                this.MenuElement.removeClass('menu-open').addClass('menu-close');
                this.OverlayElement.removeClass('menu-open').addClass('menu-close');
            }

        };

        var $viewPortWidth = $(window).width();
        if ($viewPortWidth <= 1024) {

            //call menu
            menu.init();
        }
        /* Open Sub Menu */
        var $dropDown = $('.dropdown_menu'),
            $subMenuTrigger = $('.nav-list__item'),
            $subArrow = $('.sub-indicator');

        $subMenuTrigger.on('click', function () {
            // drop down element
            var $dropDownEl = $(this).find($dropDown);

            $dropDown.slideUp();

            $subArrow.removeClass('sub-arrow-open');

            // slidetoggle
            $dropDownEl.stop().slideToggle('slow', function () {

                $(this).next('.sub-indicator').toggleClass('sub-arrow-open', $dropDownEl.is(':visible'));

            });

        });

    });
    $('.sub-child').on('click', function () {
        $(this).toggleClass('active');
    });

    var viewPortWidth = $(window).width();
    if (viewPortWidth > 992) {
        var getHeaderHeight = $('#header').outerHeight();
        var lastScrollPosition = 0;
        $('#header').css('top', -getHeaderHeight);
        $(window).scroll(function () {
            var currentScrollPosition = $(window).scrollTop();
            if ($(window).scrollTop() > 4 * (getHeaderHeight)) {
                $('body').addClass('fixedscroll').css('padding-top', getHeaderHeight);
                $('#header').css('top', 0);
                if (currentScrollPosition < lastScrollPosition) {
                    $('#header').css('top', -getHeaderHeight - 20);
                }
                lastScrollPosition = currentScrollPosition;
            } else {
                $('body').removeClass('fixedscroll').css('padding-top', 0);
            }
        });
        $(".nav-list__item").hover(function () {
            $(this).addClass("open");
        }, function () {
            $(this).removeClass("open");
        });
    }
</script>