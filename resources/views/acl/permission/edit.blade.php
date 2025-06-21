@extends('layouts.master')

@section('content')


<div class="page-body">

    <div class="row">
        <div class="col-md-12">
            <form class="form-material" method="POST" action="{{url('acl/permissions/'. $permission->id)}}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Permission</h5>
                    </div>
                    <div class="card-block p-0">
                        <div class="card-block ard-block-user custom-input-field p-b-10 p-t-15 section-blog-card">
                            <h6 class="group-title">Permission Infomation</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-default">
                                        <input name="name" class="form-control custom-input-control @error('name') form-control-danger @enderror" type="text" value="{{$permission->name}}">
                                        <span class="form-bar"></span>
                                        <label class="float-label" for="name">Permission Name</label>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('name')
                                            <strong>{{$errors->first('name')}}</strong>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 form-default">
                                    <div class="form-group custon-select material-custon-select focus-select focused">
                                        <label class="form-label" for="exampleFormControlSelect2">Select Submodule</label>
                                        <select id="submoduleSelect" name="submodule_id" class="form-control" required>
                                            <option value="">-- Choose Submodule --</option>
                                            @foreach($submodules as $submodule)
                                            <option value="{{$submodule->id}}" {{$submodule->id==$permission->submodule_id?'selected':''}}>{{$submodule->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback d-block" role="alert">
                                            @error('submodule_id')
                                            <strong>{{$errors->first('submodule_id')}}</strong>
                                            @enderror
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 max-w-100">
                        <div class="form-group mt-2">
                            <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('.focus-select select').on('focus', function () {
            $(this).closest('.form-group').addClass('focused');
        });

        $('.focus-select select').on('blur', function () {
            // Remove focus class on blur if no option is selected
            if (!$(this).val()) {
                $(this).closest('.form-group').removeClass('focused');
            }
        });

        $('.focus-select select').on('change', function () {
            // Add class if there's a selected value
            if ($(this).val()) {
                $(this).closest('.form-group').addClass('has-value');
            } else {
                $(this).closest('.form-group').removeClass('has-value');
            }
        });
    });
</script>
@endpush