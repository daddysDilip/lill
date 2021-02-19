<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="{{asset('admin/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('client/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('client/js/main.js')}}"></script>
<script src="{{asset('client/js/jquery.typewatch.js')}}"></script>
<script src="{{asset('client/js/clipboard.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{asset('client/js/daterangepicker.min.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/jquery-jvectormap.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/lib/jquery-mousewheel.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/src/jvectormap.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/src/abstract-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/abstract-canvas-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/abstract-shape-element.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-group-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-canvas-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-shape-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-path-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-circle-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-image-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/svg-text-element.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-group-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-canvas-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-shape-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-path-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-circle-element.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vml-image-element.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/src/map-object.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/region.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/marker.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/src/vector-canvas.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/simple-scale.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/ordinal-scale.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/numeric-scale.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/color-scale.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/legend.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/data-series.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/proj.js')}}"></script>
<script src="{{asset('client/js/plugin/jquery-jvectormap/src/map.js')}}"></script>

<script src="{{asset('client/js/plugin/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('client/js/scripts.js')}}"></script>
<script src="{{asset('client/js/custom-validation.js')}}"></script>
<script src="{{asset('client/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('client/js/share.js')}}"></script>
<script>
    $('.links-block .nav-pills a input:checkbox').change(function () {
        $('.links-block .nav-pills a').toggleClass('menuitemshow', this.checked);
    })
    
    
    
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
</script>
