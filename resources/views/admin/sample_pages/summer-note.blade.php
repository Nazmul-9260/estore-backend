@extends('layouts.master')

@section('content')

<div class="page-body custom-main-body">


    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h5>Summer Note</h5>
                </div>

                <div class="card-block">
                    <label for="">Text Area</label>

                    <textarea name="" id="summer-note-textarea"></textarea>


                </div>


                <div class="card-block">

                    <label for="">Input Type Text</label>
                    <input type="text" id="summer-note-input-type-text">

                </div>


            </div>

        </div>

    </div>




</div>



@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('#summer-note-input-type-text, #summer-note-textarea').summernote();
    })
</script>

@endpush