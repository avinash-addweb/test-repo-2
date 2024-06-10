@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>{{__('Create')}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{__('Users')}}</a></li>
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
							<h5 class="card-title">{{__('Create :record',['record'=>__('User')])}}</h5>
						</div>
						<div class="col-md-2 text-end"><br/>
							@can('user index')
								<a href="{{ route('user.index') }}" class="btn btn-primary "><i class="bi bi-list"></i> {{__('Users') }}</a>
							@endcan
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-12">
							<form method="POST" action="{{ route('user.store') }}">
								@csrf
								<div class="row mb-3">
									<label for="name" class="col-sm-3 col-form-label">{{ __('First Name') }} * :</label>
									<div class="col-sm-9">
										<input type="input" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{old('first_name')}}">
										@error('first_name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Middle Name') }} :</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name"  value="{{ old('middle_name') }}">
                                    </div>
                                </div>
                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Last Name') }} * :</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name"  value="{{ old('last_name') }}">
                                        @error('last_name')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Date Of Birth') }} * :</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control mydatepicker @error('date_of_birth') is-invalid @enderror" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" max="{{date('d/m/Y')}}">
                                        @error('date_of_birth')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Mobile Number') }} * :</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" id="mobile_number"  value="{{ old('mobile_number') }}">
                                        @error('mobile_number')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Whatsapp Number') }} :</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number" id="whatsapp_number"  value="{{ old('whatsapp_number') }}">
                                    </div>
                                </div>
								<div class="row mb-1">&nbsp;</div>
								<div class="row mb-3">
									<label for="email" class="col-sm-3 col-form-label">{{ __('Email') }} * :</label>
									<div class="col-sm-9">
										<input type="input" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}">
										@error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
								<div class="row mb-3">
									<label for="password" class="col-sm-3 col-form-label">{{ __('Password') }} * :</label>
									<div class="col-sm-9">
										<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{old('password')}}">
										@error('password')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>
								<div class="row mb-3">
									<label for="password_confirmation" class="col-sm-3 col-form-label">{{ __('Password Confirm') }} * :</label>
									<div class="col-sm-9">
										<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">
										@error('password_confirmation')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
									</div>
								</div>
                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">{{ __('Gender') }} :</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="gender" id="gender">
                                            <option value="0">Select</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="roles" class="col-sm-3 col-form-label">{{ __('Designation') }} :</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="designation_id" id="designation_id">
                                            <option value="" selected>Select</option>
                                            @foreach($designations as $designation)
                                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="roles" class="col-sm-3 col-form-label">{{ __('Department') }} :</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="department_id" id="department_id">
                                            <option value="" selected>Select</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="roles" class="col-sm-3 col-form-label">{{ __('Loan Type') }} :</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="loan_type_id[]" id="loan_type_id" multiple>
                                            @foreach($loan_types as $loan_type)
                                                <option value="{{ $loan_type->id }}">{{ $loan_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="roles" class="col-sm-3 col-form-label">{{ __('Region') }} :</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="region_id" id="region_id">
                                            <option value="" selected>Select</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-1">&nbsp;</div>
                                <div class="row mb-3">
                                    <label for="roles" class="col-sm-3 col-form-label">{{ __('Branch') }} :</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="branch_id" id="branch_id">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                </div>

								<div class="row mb-1">&nbsp;</div>
								<div class="row mb-3">
									<label for="roles" class="col-sm-3 col-form-label">{{ __('Roles') }} :</label>
									<div class="col-sm-9">
										@forelse ($roles as $role)
											@if($role->name==config('constants.superadmin_role')) @continue @endif
											<span class="form-check1 ml-3">
												<input type="checkbox" name="roles[]" id="{{ $role->name }}" value="{{ $role->name }}" class="form-check-input">
												<label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
											</span> &nbsp;
											@empty
											----
										@endforelse
									</div>
								</div>
								<div class="row mb-1">&nbsp;</div>

								<fieldset class="row mb-3">
									<legend class="col-form-label col-sm-3 pt-0">{{ __('Status') }} :</legend>
									<div class="col-sm-9">
										<span class="form-check1 ml-3">
											<input class="form-check-input" type="radio" name="status" id="status1" value="1" checked>
											<label class="form-check-label" for="status1">
											{{ __('Active') }}
											</label>
										</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="form-check1">
											<input class="form-check-input" type="radio" name="status" id="status2" value="2">
											<label class="form-check-label" for="status2">
											{{ __('Inactive') }}
											</label>
										</span>
									</div>
								</fieldset>
								<div class="row mb-1">&nbsp;</div>

								<div class="text-left">
									<button type="submit" class="btn btn-primary">{{__('Submit')}}</button> &nbsp;&nbsp;&nbsp;
									<a href="{{route('user.index')}}" class="btn btn-secondary">{{__('Cancel')}}</a>
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
    <script type="module">
        function getBranches(region_id){
            $('#branch_id').children().remove();
            $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('get_branches') }}",
                data: { RegionId: region_id},
                success:function(data){
                    var len = 0;
                    if(data.branches != null){
                        len = data.branches.length;
                    }
                    if(len > 0){
                        for(var i=0; i<len; i++){
                            var id = data.branches[i].id;
                            var name = data.branches[i].name;
                            var option = "<option value='"+id+"'>"+name+"</option>";
                            $("#branch_id").append(option);
                        }
                    }
                }
            });
        }

        $(document).ready(function () {
            const inputDate = document.getElementById("date_of_birth");
            inputDate.addEventListener("focus",function (evt) {
                if (this.getAttribute("type")==="date") {
                    this.showPicker();
                }
            });
            $('#region_id').on("change", function () {
                getBranches($('#region_id').val());
            });
        });
    </script>
@endpush

@endsection