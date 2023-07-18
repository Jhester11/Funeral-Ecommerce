{{-- <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script> --}}
{{-- Start custom for js --}}
<script src="{{ asset('assets/admin/vendors/base/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/admin/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/admin/js/template.js') }}"></script>
{{-- <!-- Custom js for this page--> --}}
<script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/admin/js/data-table.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/admin/js/dataTables.bootstrap4.js') }}"></script>

{{-- Sweet Alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Image Scripts --}}
<script>
    img_input = document.querySelector("#img_input");
    img_input.onchange = function(e) {
        if (e.target.files.length > 0) {
            src = URL.createObjectURL(e.target.files[0]);
            image = document.querySelector(".image-container img");
            image.src = src;
        }
    }
</script>
{{-- <!-- End custom js for this page--> --}}
