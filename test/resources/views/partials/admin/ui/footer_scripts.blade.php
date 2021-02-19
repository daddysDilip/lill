<!-- BEGIN: Vendor JS-->
<script src="{{asset('admin/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('admin/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js')}}"></script>
<script src="{{asset('admin/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js')}}"></script>
<script src="{{asset('admin/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin/vendors/js/ui/jquery.sticky.js')}}"></script>
{{-- <script src="{{asset('admin/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/dragula.min.js')}}"></script> --}}
<script src="{{asset('admin/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('admin/js/scripts/configs/horizontal-menu.min.js')}}"></script>
<script src="{{asset('admin/js/core/app-menu.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin/js/core/app.min.js')}}"></script>
<script src="{{asset('admin/js/scripts/components.min.js')}}"></script>
<script src="{{asset('admin/js/scripts/footer.min.js')}}"></script>
<script src="{{asset('admin/js/scripts/customizer.min.js')}}"></script>
<script src="{{asset('admin/js/scripts/datatables/datatable.min.js')}}"></script>
<script src="{{asset('admin/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="{{asset('admin/js/scripts/pages/dashboard-analytics.min.js')}}"></script> --}}
<!-- END: Page JS-->

<script>
$(document).ready(function(){
    $.validator.addMethod('Validemail', function(value, element) {
        return this.optional(element) || value.match(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/);
    }, "Please enter a valid email address.");
});
</script>