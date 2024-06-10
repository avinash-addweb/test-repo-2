@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>{{__('Detail')}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('testimonial::testimonial.index') }}">{{__('Testimonials')}}</a></li>
			<li class="breadcrumb-item active">{{__('Detail')}}</li>
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
                        <h5 class="card-title">{{__(':record Detail',['record'=>__('Testimonial')])}}</h5>
						</div>
						<div class="col-md-2"><br/>
							@can('testimonial::testimonial list')
								<a href="{{ route('testimonial::testimonial.index') }}" class="btn btn-primary "><i class="bi bi-list"></i> {{__('Testimonials') }}</a>
							@endcan
						</div>
					</div>
					<hr />

					<div class="row">
						<div class="col-md-12">

                            <div class="locale_area">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach ($testimonial->testimonialLocales as $k => $testimonialItem)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{$k==0?'active':''}}" id="{{$testimonialItem->lang_code}}-tab" data-bs-toggle="tab" data-bs-target="#{{$testimonialItem->lang_code}}" type="button" role="tab" aria-controls="{{$testimonialItem->lang_code}}" aria-selected="true">{{$localeList[$testimonialItem->lang_code]}}</button>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content pt-2" id="myTabContent">
                                    @foreach ($testimonial->testimonialLocales as $k => $testimonialItem)
                                        <div class="tab-pane fade {{$k==0?'active':''}} show" id="{{$testimonialItem->lang_code}}" role="tabpanel" aria-labelledby="{{$testimonialItem->lang_code}}-tab">
                                        
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td >
                                                        @can('testimonial list')
                                                            <a href="{{route('testimonial::testimonial.edit',$testimonial->id).'/'.$testimonialItem->lang_code}}"  class="edit btn btn-success btn-sm"><i class="bi bi-pencil"></i> {{ __('Edit') }}</a>
                                                        @endcan    
                                                    </td>
                                                    <td >
                                                        &nbsp;
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('Language') }} :</td>
                                                    <td>{{$localeList[$testimonialItem->lang_code]}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('Name') }} :</td>
                                                    <td>{{$testimonialItem->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('Email') }} :</td>
                                                    <td>{{$testimonial->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('Desigantion') }} :</td>
                                                    <td>{{$testimonialItem->designation}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('Contents') }} :</td>
                                                    <td>{!!$testimonialItem->contents!!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <hr />

                            <table class="table table-striped">
								<tbody>
                                    <tr>
										<td>{{ __('Image') }} :</td>
										<td>
                                            @if(!empty($testimonial->testimonialImage->name) && !empty($testimonial->testimonialImage->path))
                                                <img style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#myModal" src="{{ asset(config('constants.asset_prefix').$testimonial->testimonialImage->path.DIRECTORY_SEPARATOR.$testimonial->testimonialImage->name)}}" alt="{{config('name').$testimonial->id}}" width="200px"/>
                                                <div class="modal fade" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title">{{__('Preview')}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset(config('constants.asset_prefix').$testimonial->testimonialImage->path.DIRECTORY_SEPARATOR.$testimonial->testimonialImage->name)}}" alt="{{config('name').$testimonial->id}}"/>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
									</tr>
									<tr>
										<td>{{ __('Status') }} :</td>
										<td>{{$testimonial->status ? __('Active') : __('Inactive')}}</td>
									</tr>
									<tr>
										<td>{{ __('Created') }} :</td>
										<td>{{$testimonial->created_at}}</td>
									</tr>
                                    <tr>
										<td>{{ __('Last Updated') }} :</td>
										<td>{{$testimonial->updated_at}}</td>
									</tr>
								</tbody>
							</table>
							<br />
                            @can('testimonial::testimonial list')
							    <a href="{{route('testimonial::testimonial.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
                            @endcan
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>
@endsection