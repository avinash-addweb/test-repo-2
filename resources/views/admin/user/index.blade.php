@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>{{__('Users')}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Users')}}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-md-12">
            @php
                $role = $_GET["role"] ?? null;
            @endphp
            <input type="hidden" name="role" id="role" value="{{ $role }}">
          	<div class="card">
            	<div class="card-body">

					<div class="row">
						<div class="col-md-10">
							<h5 class="card-title">{{__('Users')}}</h5>
						</div>
						<div class="col-md-2 text-end"><br/>
							@can('user create')
								<a href="{{ route('user.create') }}" class="btn btn-primary "><i class="bi bi-plus-circle"></i> {{__('Create') }}</a>
							@endcan
						</div>
					</div>
					<hr />
					{{ $dataTable->table(['id'=>'admimDataTable']) }}
            	</div>
          	</div>

        </div>
    </div>

</section>
<!-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} -->
@push('scripts')
    
<script type="module">
	$(function () {
	
		var table = $('#admimDataTable').DataTable({
			processing: true,
			serverSide: true,
			order:[4,'desc'],
			ajax: {
				url: "{{ route('user.index') }}",
				data: function (d) {
					d.userType = $('#userType').val();
					d.role = $('#role').val();
					d.search = $('input[type="search"]').val();
				},
			},
			columns: [
				{data: 'adminId', name: 'adminId'},
				{data: 'full_name', name: 'full_name', orderable: false},
				{data: 'email', name: 'email'},
				{data: 'status', name: 'status'},
				{data: 'created_at', name: 'created_at'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			buttons:[{extend:'export',text:"{{__('Export')}}"}],
			language: {
				"decimal":        "",
				"emptyTable":     "{{__('No record available')}}",
				"info":           "{{__('Showing _START_ to _END_ of _TOTAL_ entries')}}",
				"infoEmpty":      "{{__('Showing 0 to 0 of 0 entries')}}",
				"infoFiltered":   "{{__('(filtered from _MAX_ total entries)')}}",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "{{__('Show _MENU_ entries')}}",
				"loadingRecords": "{{__('Loading...')}}",
				"processing":     "",
				"search":         "{{__('Search:')}}",
				"zeroRecords":    "{{__('No matching record found')}}",
				"paginate": {
					"first":      "{{__('First')}}",
					"last":       "{{__('Last')}}",
					"next":       "{{__('Next')}}",
					"previous":   "{{__('Previous')}}"
				},
				"aria": {
					"sortAscending":  "{{__(': activate to sort column ascending')}}",
					"sortDescending": "{{__(': activate to sort column descending')}}"
				},
				
			}
		});

	});
</script>

@endpush
@endsection