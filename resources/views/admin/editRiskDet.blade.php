@php($layoutarr=['parsleyjs' => true])
@extends('layouts.app',$layoutarr)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>
                        {{ __('Create Risk') }}
                    </span>

                </div>
                <div class="card-body">

                    <div class="DetailView">
                        @if(Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        <form method="post" action="{{ route('admin.risk.post') }}" name="riskform" id="riskform" data-parsley-validate="">
                            @csrf
                            <div class="form-group mb-2">
                                <label>Name</label>
                                <input type="text" value="{{ $view_risk->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required="" data-parsley-required="true" data-parsley-required-message='Enter Risk Name' data-parsley-length="[3,100]">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4" required="" data-parsley-required="true" data-parsley-required-message='Enter Risk Name' data-parsley-length="[10,5000]">{{ $view_risk->description }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="d-flex float-end">
                                <div class="d-grid mt-3">
                                    <input type="button" name="save" value="Save" onclick="Save()" class="btn btn-success btn-block">
                                </div>

                            </div>
                            <input type="hidden" name="savetypes" value="{{ $types }}" id="savetypes" />
                            <input type="hidden" name="saveid" value="{{ $view_risk->id }}" id="saveid" />
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    
    function Save() {
        $('#savetype').val(2);
        $('#riskform')[0].submit();
    }

    /*
    $(function() {
        $('#riskform').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                alert('suceess');
                return false; // Don't submit form for this demo
            });
    });
    function validateForm() {
        loaderenable();
        var $selector = $('#riskform'),
            form = $selector.parsley();

        form.subscribe('parsley:form:success', function(e) {
            alert('succcess');
        });
        loaderdisable();
    }
    */
</script>

@endpush