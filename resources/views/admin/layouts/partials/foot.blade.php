<script src="{{ asset('assets/admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/detect.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('assets/admin/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Datatables-->
<script src="{{ asset('assets/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/admin/assets/pages/datatables.init.js') }}"></script>


<script src="{{ asset('assets/admin/assets/pages/dashborad.js') }}"></script>

<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('assets/admin/assets/js/code.js') }}"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch (type){
        case 'info' :
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'success' :

            toastr.success("{{ Session::get('message') }}");
            break;

        case 'warning' :
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'error' :
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

<script>
    $(document).ready(function (){
        // Initialize datepicker
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy'
        });

        // Handle image change event
        $('#image').change(function (e){
            var reader = new FileReader();
            reader.onload = function (e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

