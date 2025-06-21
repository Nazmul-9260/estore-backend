@if(Session::has('message'))
<script>
    var type = "{{ Session::get('type', 'info') }}";
    if (Object.is(type, null)) {
        console.log('NULL');
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "100",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'danger':
            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");
            break;
    }
</script>
@endif