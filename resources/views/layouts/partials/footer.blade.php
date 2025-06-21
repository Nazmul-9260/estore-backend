<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Required Jquery -->
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}} "></script>
<script type="text/javascript" src="{{asset('assets/js/popper.js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}} "></script>
<!-- waves js -->
<script src="{{asset('assets/pages/waves/js/waves.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('assets/js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- slimscroll js -->
<script src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}} "></script>

<!-- menu js -->
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('assets/js/vertical/vertical-layout.min.js')}} "></script>

<script type="text/javascript" src="{{asset('assets/js/script.js')}} "></script>

<!-- summer note js -->
{{-- <script src="{{asset('js/summernote/summernote.min.js')}} "></script> --}}
<script src="{{asset('assets/js/summernote.min.js')}}"></script>


<!-- notification js -->
<script type="text/javascript" src="{{asset('assets/js/notification/bootstrap-growl.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/notification/notification.js')}}"></script>

<!-- Datatable -->
<script src="{{asset('DataTables/datatables.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('assets/js/toastr.min.js')}}"></script>

<!-- Notifications -->

<!-- Select2 -->

<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

<!-- Sweetalert2 -->

<script src="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.umd.js" crossorigin></script>
{{-- <script src="https://example.com/ckfinder/ckfinder.js"></script> --}}


<script src="{{asset('assets/js/ckeditor_public.js')}}"></script>
<script>

editorConfig = {
  ...editorConfig,
    simpleUpload: {            
            uploadUrl: '{{route('config.product.upload')}}',
            withCredentials: true,
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
                Authorization: 'Bearer {{csrf_token()}}'
            }
        }
};

ClassicEditor.create(document.querySelector('#content'), editorConfig).catch( error => {

console.error( error );

} );



$(document).ready(function() {
        $('#summer-note-input-type-text, #summer-note-textarea').summernote({
            
        });
    })

        
</script>



<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Morris Chart js -->
<script src="{{ asset('assets/js/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/js/morris.js/morris.js') }}"></script>
<!-- phone number and country code js -->
<script src="{{ asset('assets/js/intlTelInput.min.js') }}"></script>
<script>
              $(document).ready(function (){
           $(".product_tag_selectr").select2();
        })
        </script>
@include('layouts.partials.notifications')


<script>
    var selectedfiles;
    var selectedfile;
    var fileIndex;
    jQuery(document).ready(function() {

        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    selectedfiles = files;
                console.log(selectedfiles);
                filesLength = files.length;

                for (var i = 0; i < filesLength; i++) {
                    selectedfile = files[i]
                    fileIndex = i;
                    // console.log(i, f);

                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + selectedfile.name + "\"/>" +
                            "<br/><span class=\"remove\" onclick=\"removeImage('" +
                            selectedfile.name + "')\">Remove image</span>" +
                            "</span>").insertAfter("#files");

                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });



                    });
                    fileReader.readAsDataURL(selectedfile);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });

    function removeImage(name) {
        selectedfiles = document.getElementById("files").files;
        var final = [];
        $.each(selectedfiles, function(index, value) {
            if (value.name !== name) {
                console.log(value);
                final.push(value);
            }
        });
        console.log('List', final);
        document.getElementById("files").files = new FileListItem(final);
    }

    function FileListItem(a) {
        a = [].slice.call(Array.isArray(a) ? a : arguments)
        for (var c, b = c = a.length, d = !0; b-- && d;) d = a[b] instanceof File
        if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
        for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(a[c])
        return b.files
    }


    // Multi row selection

    $(".tab-content #selectAll").click(function() {
        $(".tab-content input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });

    $(".tab-content input[type=checkbox]").click(function() {
        if (!$(this).prop("checked")) {
            $(".tab-content #selectAll").prop("checked", false);
        }
    });

    // $(".scroll-pane").mCustomScrollbar({
    //     mouseWheelPixels: 50 //change this to a value, that fits your needs
    // })


    /** page-link-top active inactive based on route visited */

    $('.page-link-top').each((i, elem) => {
        if ($(elem).prop('href') === "{{url()->current()}}") {
            $(elem).prop('href', '#');
        }
    })
</script>

<script src="{{asset('js/menu-navigation-indicator.js')}}"></script>

<!-- <script>
    const multipleEvents = (element, eventNames, listener) => {
        const events = eventNames.split(' ');

        events.forEach(event => {
            element.addEventListener(event, listener, false);
        });
    };

    const fileUpload = () => {
        const INPUT_FILE = document.querySelector('#upload-files');
        const INPUT_CONTAINER = document.querySelector('#upload-container');
        const FILES_LIST_CONTAINER = document.querySelector('#files-list-container')
        const FILE_LIST = [];

        multipleEvents(INPUT_FILE, 'click dragstart dragover', () => {
            INPUT_CONTAINER.classList.add('active');
        });

        multipleEvents(INPUT_FILE, 'dragleave dragend drop change', () => {
            INPUT_CONTAINER.classList.remove('active');
        });

        INPUT_FILE.addEventListener('change', () => {
            const files = [...INPUT_FILE.files];

            files.forEach(file => {
                const fileURL = URL.createObjectURL(file);
                const fileName = file.name;
                const uploadedFiles = {
                    name: fileName,
                    url: fileURL,
                };

                FILE_LIST.push(uploadedFiles);
            });

            FILES_LIST_CONTAINER.innerHTML = '';
            FILE_LIST.forEach(addedFile => {
                const content = `
            <div class="form__files-container">
                <span class="form__text">${addedFile.name}</span>
                <div>
                <a class="form__icon" href="${addedFile.url}" target="_blank" title="Preview">&#128065;</a>
                <a class="form__icon" href="${addedFile.url}" title="Download" download>&#11123;</a>
                </div>
            </div>
            `;

                FILES_LIST_CONTAINER.insertAdjacentHTML('beforeEnd', content);
            });
        });
    };
    fileUpload();
</script> -->

<script>
    $(document).ready(function () {
        $(document).on('click', '.click-event', function(event) {
            event.stopPropagation(); // Prevent bubbling
            const button = $(this); // Cache the clicked button
            const wrap = button.siblings('.dynamic-btn-wrap'); // Find the associated dynamic-btn-wrap

            // Hide all other .dynamic-btn-wrap elements
            $('.dynamic-btn-wrap').not(wrap).hide();

            // Toggle the specific dynamic-btn-wrap for the clicked button
            wrap.toggle();
            console.log('Dynamic button clicked');
        });

        // Hide dynamic-btn-wrap when clicking outside
        $(document).on('click', function() {
            $('.dynamic-btn-wrap').hide(); // Hide all menus
        });

        // Prevent hiding when clicking inside dynamic-btn-wrap
        $(document).on('click', '.dynamic-btn-wrap', function(event) {
            event.stopPropagation(); // Prevent bubbling
        });
    });
</script>




</body>

</html>