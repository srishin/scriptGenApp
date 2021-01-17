@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add/Edit Rules') }}</div>



                <div class="card-body">
                    <form METHOD="POST" action="/rule">
                        @csrf
                        <div id="rule-group">
                            @isset($rules)
                            @foreach ($rules->triggers as $rule)
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <select class="form-control" name="enable_alert[]"
                                        aria-labelledby="dropdownMenuButton">
                                        <option value="1" {{$rule->enable_alert=='1'?' selected="selected"' : ''}}>Show
                                            On</option>
                                        <option value="0" {{$rule->enable_alert=='0'?' selected="selected"' : ''}}>Don't
                                            Show On</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="condition[]"
                                        aria-labelledby="dropdownMenuButton">
                                        <option value="contains"
                                            {{$rule->condition=='contains'?' selected="selected"' : ''}}>Pages that
                                            contain</option>
                                        <option value="equals"
                                            {{$rule->condition=='equals'?' selected="selected"' : ''}}>A specific page
                                        </option>
                                        <option value="starts_with"
                                            {{$rule->condition=='starts_with'?' selected="selected"' : ''}}>Page
                                            starting with</option>
                                        <option value="end_with"
                                            {{$rule->condition=='end_with'?' selected="selected"' : ''}}>Page ending
                                            with</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">www.domain.com/</span>
                                        <input type="text" class="form-control" name="uri[]" placeholder="URI"
                                            aria-label="URI" aria-describedby="basic-addon1" value={{$rule->uri}}>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="btn btn-danger" onClick="removeRule(this,{{$rule->id}});">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else


                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <select class="form-control" name="enable_alert[]"
                                        aria-labelledby="dropdownMenuButton">
                                        <option value="1">Show On</option>
                                        <option value="0">Don't Show On</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="condition[]"
                                        aria-labelledby="dropdownMenuButton">
                                        <option value="contains">Pages that contain</option>
                                        <option value="equals">A specific page</option>
                                        <option value="starts_with">Page starting with</option>
                                        <option value="end_with">Page ending with</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">www.domain.com/</span>
                                        <input type="text" class="form-control" name="uri[]" placeholder="URI"
                                            aria-label="URI" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="btn btn-danger" onClick="removeRule(this);">
                                        <i class="fa fa-trash"></i>
                                    </div>
                                </div>
                            </div>
                            @endisset
                           
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="btn btn-primary mr-2" onClick="addRule()">
                                    <i class="fa fa-plus"></i> Add Rule
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="alert_text" placeholder="Alert text"
                                        value="{{isset($rules)?$rules->alert_text:''}}">
                                </div>
                                @error('alert_text')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function removeRule(element) {
        $(element).parents('.row')[0].remove();
    }

    function addRule(e) {
        var html = `
        <div class="row mb-2">
            <div class="col-md-2">
                <select class="form-control" name="enable_alert[]" aria-labelledby="dropdownMenuButton">
                    <option value="1">Show On</option>
                    <option value="0">Don't Show On</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="condition[]" aria-labelledby="dropdownMenuButton">
                    <option value="contains">Pages that contain</option>
                    <option value="equals">A specific page</option>
                    <option value="starts_with">Page starting with</option>
                    <option value="end_with">Page ending with</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">www.domain.com/</span>
                    <input type="text" class="form-control" name="uri[]" placeholder="URI"
                        aria-label="URI" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="btn btn-danger" onClick="removeRule(this);">
                    <i class="fa fa-trash"></i>
                </div>
            </div>
        </div>
        `
        $('div#rule-group').append(html)
    }

</script>
@endsection
