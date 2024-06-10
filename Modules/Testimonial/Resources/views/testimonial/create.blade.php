@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>{{__('Create')}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('testimonial::testimonial.index') }}">{{__('Testimonials')}}</a></li>
			<li class="breadcrumb-item active">{{__('Create')}}</li>
        </ol>
    </nav>
</div>

<section class="section">
	<div class="row">
        <div class="col-md-12">
          	<div class="card">
            	<div class="card-body">
					<div class="row">
						<div class="col-md-10">
							<h5 class="card-title">{{__('Create :record',['record'=>__('Testimonial')])}}</h5>
						</div>
						<div class="col-md-2"><br/>
							@can('testimonial::testimonial index')
								<a href="{{ route('testimonial::testimonial.index') }}" class="btn btn-primary "><i class="bi bi-list"></i> {{__('Testimonials') }}</a>
							@endcan
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-9">

							<form method="POST" action="{{ route('testimonial::testimonial.store') }}" enctype="multipart/form-data">
								@csrf
								<div class="row mb-3">
									<label for="lang_code" class="col-sm-2 col-form-label">{{ __('Language') }} * :</label>
									<div class="col-sm-10">
										<select id="lang_code" name="lang_code" class="form-control @error('lang_code') is-invalid @enderror" id="lang_code">
											@if(!empty($localeList))
												<option value="{{ $defaultLocale }}" {{ (old('lang_code') == $defaultLocale) ? "selected" : ""}}>{{ $localeList[$defaultLocale] }}</option>
											@endif
										</select>
										@error('lang_code')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>

                				<div class="row mb-3">
									<label for="name" class="col-sm-2 col-form-label">{{ __('Name') }} * :</label>
									<div class="col-sm-10">
										<input type="input" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
										@error('name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
                				<div class="row mb-3">
									<label for="email" class="col-sm-2 col-form-label">{{ __('Email') }} * :</label>
									<div class="col-sm-10">
										<input type="input" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}">
										@error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
								<div class="row mb-3">
									<label for="designation" class="col-sm-2 col-form-label">{{ __('Designation') }} * :</label>
									<div class="col-sm-10">
										<input type="input" class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation" value="{{old('designation')}}">
										@error('designation')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
                				<div class="row mb-3">
									<label for="contents" class="col-sm-2 col-form-label">{{ __('Contents') }} * :</label>
									<div class="col-sm-10 pad-all-2 border-radius-7  @error('contents') is-invalid @enderror">
										<textarea rows=5 id="contents" class="form-control tinymce-editor @error('contents') is-invalid @enderror" name="contents" value="{{ old('contents') }}" >{{ old('contents') }}</textarea>
										@error('contents')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
								<div class="row mb-1">&nbsp;</div>
                				<div class="row mb-3">
									<label for="image" class="col-sm-2 col-form-label">{{ __('Image') }} * :</label>
									<div class="col-sm-10">
										<div class="input-group">
											<input readonly="readonly" type="text" id="image_label" class="form-control @error('image') is-invalid @enderror" name="image" aria-label="Image" aria-describedby="button-image" value="{{ old('image') }}">
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="button" id="button-image">{{__('Select :record',['record'=>''])}}</button>
											</div>
											@error('image')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
										</div>
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
								<fieldset class="row mb-3">
									<legend class="col-form-label col-sm-2 pt-0">{{ __('Status') }} :</legend>
									<div class="col-sm-10">
										<span class="form-check1">
											<input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
											<label class="form-check-label" for="status1">
											{{ __('Active') }}
											</label>
										</span> &nbsp;
										<span class="form-check1">
											<input class="form-check-input" type="radio" name="status" id="status2" value="0">
											<label class="form-check-label" for="status2">
											{{ __('Inactive') }}
											</label>
										</span>
									</div>
								</fieldset>
								<div class="row mb-1">&nbsp;</div>

								<div class="text-left">
									<button type="submit" class="btn btn-primary">{{__('Submit')}}</button> &nbsp;&nbsp;&nbsp;
									@can('testimonial::testimonial index')
									<a href="{{route('testimonial::testimonial.index')}}" class="btn btn-secondary">{{__('Cancel')}}</a>
									@endcan
								</div>
								
							</form>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById('button-image').addEventListener('click', (event) => {
  		event.preventDefault();
  		window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
	});
});
// set file link
function fmSetLink($url) {
	var new_url = $url;
	var base_url = '{{ asset("/storage") }}/';
	new_url = new_url.replace(base_url,"");
	document.getElementById('image_label').value = new_url;
}
</script>
@endpush
@endsection
