<!-- Application Name Field -->
<div class="form-group col-xl-6 col-md-6 col-sm-12">
    {!! Form::label('name', 'Application Name:') !!}<span class="text-danger">*</span>
    {!! Form::text('application_name', $setting['application_name'] ?? old('application_name'), ['class' => 'form-control '. ($errors->has('application_name') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('application_name') }}</div>
</div>

<!-- Company URL Field -->
<div class="form-group col-xl-6 col-md-6 col-sm-12">
    {!! Form::label('company_url', 'Company URL:') !!}<span class="text-danger">*</span>
    {!! Form::text('company_url', $setting['company_url'] ?? old('company_url'), ['class' => 'form-control '. ($errors->has('company_url') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('company_url') }}</div>
</div>

<!-- Phone Field -->
<div class="form-group col-md-6 col-sm-12">
    {!! Form::label('phone', 'Phone:') !!}<span class="text-danger">*</span>
    {!! Form::text('phone', $setting['phone'] ?? old('phone'), ['class' => 'form-control '. ($errors->has('phone') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
</div>

<!-- Email Field -->
<div class="form-group col-md-6 col-sm-12">
    {!! Form::label('email', 'Email:') !!}<span class="text-danger">*</span>
    {!! Form::text('email', $setting['email'] ?? old('email'), ['class' => 'form-control '. ($errors->has('email') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
</div>

<!-- Email Field -->
<div class="form-group col-md-6 col-sm-12">
    {!! Form::label('firebase_key', 'Firebase Key:') !!}<span class="text-danger">*</span>
    {!! Form::textarea('firebase_key', $setting['firebase_key'] ?? old('firebase_key'), ['class' => 'form-control '. ($errors->has('firebase_key') ? 'is-invalid':''), 'rows' => '5', 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('firebase_key') }}</div>
</div>

<!-- Address Field -->
<div class="form-group col-md-6 col-sm-12">
    {{ Form::label('address', 'Address'.':') }}<span class="text-danger">*</span><br>
    {{ Form::textarea('address', $setting['address'], ['class' => 'form-control', 'rows' => '5', 'required']) }}
    <div class="invalid-feedback">{{ $errors->first('address') }}</div>
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6 d-flex">
    <div class="alert alert-danger d-none" id="logoValidationError"></div>
    <div class="col-sm-4 col-md-6 pl-0 form-group">
        <label>Logo:</label>
        <br>
        <label
            class="image__file-upload btn btn-primary text-white"
            tabindex="2"> Choose
            <input type="file" name="logo" id="logo" class="d-none">
        </label>
    </div>
    <div class="col-sm-3 preview-image-video-container float-right mt-1">
        <img id='logoPreview' class="img-thumbnail user-img user-profile-img profilePicture"
             src="{{ isset($setting['logo']) && !is_null($setting['logo'])  ? $setting['logo'] : asset('img/main_logo.jpeg')}}"/>
    </div>
</div>

<!-- Submit Field -->
<div class="col-sm-12">
    {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <a type="button" href="{{ route('settings.index') }}" class="btn btn-light ml-1">
        Cancel
    </a>
</div>
