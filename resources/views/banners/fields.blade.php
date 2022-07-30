<!-- Name Field -->
<div class="form-group col-xl-6 col-md-6 col-sm-12">
    {!! Form::label('name', 'Name:') !!}<span class="text-danger">*</span>
    {!! Form::text('name', old('name'), ['class' => 'form-control '. ($errors->has('name') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
</div>
<div class="form-group col-xl-6 col-md-6 col-sm-12">
    {!! Form::label('link', 'Link:') !!}<span class="text-danger">*</span>
    {!! Form::text('link', old('link'), ['class' => 'form-control '. ($errors->has('link') ? 'is-invalid':''), 'required']) !!}
    <div class="invalid-feedback">{{ $errors->first('link') }}</div>
</div>


<!-- Photo Field -->
<div class="form-group col-sm-6 d-flex">
    <div class="alert alert-danger d-none" id="photoValidationErrorsBox"></div>
    <div class="col-sm-4 col-md-6 pl-0 form-group">
        <label>Image:</label>
        <br>
        <label
            class="image__file-upload btn btn-primary text-white"
            tabindex="2"> Choose
            <input type="file" name="photo" id="photo" class="d-none">
        </label>
    </div>
    <div class="col-sm-3 preview-image-video-container float-right mt-1">
        <img id='photoImagePreview' class="img-thumbnail user-img user-profile-img profilePicture"
             src="{{ isset($banner) && !is_null($banner->image_url)  ? $banner->image_url : asset('img/main_logo.jpeg')}}"/>
    </div>
</div>

<!-- Submit Field -->
<div class="col-sm-12">
    {{ Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
    <a type="button" href="{{ route('banners.index') }}" class="btn btn-light ml-1">
        Cancel
    </a>
</div>
