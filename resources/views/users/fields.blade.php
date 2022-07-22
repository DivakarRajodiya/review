<!-- Name Field -->
<div class="form-group col-xl-6 col-md-6 col-sm-12">
    {!! Form::label('name', 'Name:') !!}<span class="text-danger">*</span>
    {!! Form::text('name', old('name'), ['class' => 'form-control '. ($errors->has('name') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
</div>

<!-- Last Name Field -->
{{--<div class="form-group col-xl-6 col-md-6 col-sm-12">--}}
{{--    {!! Form::label('last_name', 'Last Name:') !!}<span class="text-danger">*</span>--}}
{{--    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control '. ($errors->has('last_name') ? 'is-invalid':''), 'required']) !!}--}}
{{--    <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>--}}
{{--</div>--}}

<!-- Email Field -->
{{--<div class="form-group col-md-6 col-sm-12">--}}
{{--    {!! Form::label('email', 'Email:') !!}--}}
{{--    {!! Form::text('email', old('email'), ['class' => 'form-control '. ($errors->has('email') ? 'is-invalid':'')]) !!}--}}
{{--    <div class="invalid-feedback">{{ $errors->first('email') }}</div>--}}
{{--</div>--}}

<!-- Phone Field -->
<div class="form-group col-md-6 col-sm-12">
    {!! Form::label('phone', 'Phone:') !!}<span class="text-danger">*</span>
    {!! Form::text('phone', old('phone'), ['class' => 'form-control '. ($errors->has('phone') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
</div>

@if(!isset($user))
    <!-- Password Field -->
    <div class="form-group col-md-6 col-sm-12">
        {{ Form::label('password','Password'.':') }}<span class="text-danger">*</span>
        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
    </div>

    <!-- Password Confirmation Field -->
    <div class="form-group col-md-6 col-sm-12">
        {{ Form::label('password_confirmation','Password Confirmation'.':') }}<span class="text-danger">*</span>
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
        <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
    </div>
@endif
<!-- User Type -->
<input type="hidden" value="{{ \App\Models\User::USER }}" name="user_type">

<!-- Gender Field -->
{{--<div class="col-sm-6 d-flex">--}}
{{--    <div class="form-group">--}}
{{--        {{ Form::label('gender','Gender'.':') }}<br>--}}
{{--        <div class="form-check form-check-inline">--}}
{{--            <input class="form-check-input" type="radio"--}}
{{--                   {{ isset($user) && $user->gender == 1 ? 'checked' : '' }} required name="gender" value="1"--}}
{{--                   id="exampleRadios1">--}}
{{--            <label class="form-check-label" for="exampleRadios1">--}}
{{--                Male--}}
{{--            </label>--}}
{{--        </div>--}}
{{--        <div class="form-check form-check-inline">--}}
{{--            <input class="form-check-input" type="radio" name="gender"--}}
{{--                   {{ isset($user) && $user->gender == 0 ? 'checked' : '' }} required value="0" id="exampleRadios2">--}}
{{--            <label class="form-check-label" for="exampleRadios2">--}}
{{--                Female--}}
{{--            </label>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Address Field -->
<div class="form-group col-md-6 col-sm-12">
    {{ Form::label('address','Address'.':') }}<span class="text-danger">*</span>
    {{ Form::textarea('address',null, ['class' => 'form-control', 'required']) }}
    <div class="invalid-feedback">{{ $errors->first('address') }}</div>
</div>

<!-- Photo Field -->
<div class="form-group col-sm-6 d-flex">
    <div class="alert alert-danger d-none" id="photoValidationErrorsBox"></div>
    <div class="col-sm-4 col-md-6 pl-0 form-group">
        <label>Profile Image:</label>
        <br>
        <label
            class="image__file-upload btn btn-primary text-white"
            tabindex="2"> Choose
            <input type="file" name="photo" id="photo" class="d-none">
        </label>
    </div>
    <div class="col-sm-3 preview-image-video-container float-right mt-1">
        <img id='photoImagePreview' class="img-thumbnail user-img user-profile-img profilePicture"
             src="{{ isset($user) && !is_null($user->image_url)  ? $user->image_url : asset('img/main_logo.jpeg')}}"/>
    </div>
</div>

<!-- Submit Field -->
<div class="col-sm-12">
    {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <a type="button" href="{{ route('users.index') }}" class="btn btn-light ml-1">
        Cancel
    </a>
</div>
