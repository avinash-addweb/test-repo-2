@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>{{__('Detail')}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{__('Users')}}</a></li>
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
							<h5 class="card-title">{{__(':record Detail',['record'=>__('User')])}}</h5>
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
							<table class="table table-striped">
								<tbody>
									<tr>
										<td>{{ __('Name') }} :</td>
										<td>{{$user->name}}</td>
									</tr>
									<tr>
										<td>{{ __('Email') }} : </td>
										<td>{{$user->email}}</td>
									</tr>
                                    <tr>
                                        <td>{{ __('Status') }} :</td>
                                        @php
                                            $status = __('Inactive');
                                            if($user->status == 1){
                                                $status = __('Active');
                                            }
                                        @endphp
                                        <td>{{ $status }}</td>
                                    </tr>
									<tr>
										<td>{{ __('Roles') }} :</td>
										<td>
											@forelse ($roles as $role)
                                                @if (in_array($role->id, $userHasRoles))
                                                <div class="">
                                                    <label class="form-check-label">

                                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ in_array($role->id, $userHasRoles) ? 'checked' : '' }} disabled="disabled">
                                                        {{ $role->name }}

                                                    </label>
                                                </div>
                                                @endif
                                                @empty
                                                ----
											@endforelse
											
										</td>
									</tr>
                                    <tr>
                                        <td>{{ __('Designation') }} :</td>
                                        <td>{{$user->designation->name ?? ""}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Department') }} :</td>
                                        <td>{{$user->department->name ?? ""}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Loan Type') }} :</td>
                                        <td>
                                            @if(!empty($userHasLoanTypes))
                                            @foreach($loan_types as $loan_type)
                                                @if (in_array($loan_type->id, $userHasLoanTypes))
                                                    <input type="checkbox" {{ in_array($loan_type->id, $userHasLoanTypes) ? 'checked' : '' }} disabled="disabled">
                                                    {{ $loan_type->name }}<br>
                                               @endif
                                            @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Region') }} :</td>
                                        <td>{{$user->region->name ?? ""}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Branch') }} :</td>
                                        <td>{{$user->branch->name ?? ""}}</td>
                                    </tr>
									<tr>
										<td>{{ __('Created') }} :</td>
										<td>{{$user->created_at}}</td>
									</tr>
									<tr>
										<td>{{ __('Last Updated') }} :</td>
										<td>{{$user->updated_at}}</td>
									</tr>
								</tbody>
							</table>
							<br />
							@can('user index')
							<a href="{{route('user.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
							@endcan
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>
@endsection
