<?php use \Illuminate\Support\Str; ?>
@extends('layouts.app')
@section('content')

<div class="pagetitle">
    <h1>{{__('Testimonials')}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Testimonials')}}</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-md-12">

          	<div class="card">
            	<div class="card-body">

					<div class="row">
						<div class="col-md-11">
							<h5 class="card-title">{{__('Testimonials')}}</h5>
						</div>
						<div class="col-md-1"><br/>
              				@can('testimonial::testimonial create')
								<a href="{{ route('testimonial::testimonial.create') }}" class="btn btn-primary "><i class="bi bi-plus-circle"></i> {{__('Create') }}</a>
							@endcan
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-12">
							&nbsp;
						</div>
					</div>
					{{ $dataTable->table(['id'=>'testimonialDataTable']) }}				
            	</div>
          	</div>

        </div>
    </div>

</section>
@push('scripts')
    
<script type="module">
	$(function () {
	
		var table = $('#testimonialDataTable').DataTable({
			processing: true,
			serverSide: true,
			order:[6,'desc'],
			ajax: {
				url: "{{ route('testimonial::testimonial.index') }}",
				data: function (d) {
					d.search = $('input[type="search"]').val();
				},
			},
			columns: [
				//{data: 'id', name: 'id'},
        		{data: 'testimonialLocales.name', name: 'testimonialLocales.name'},
        		{data: 'testimonialLocales.lang_code', name: 'testimonialLocales.lang_code', orderable: false, searchable: false},
				{data: 'email', name: 'email'},
				{data: 'testimonialLocales.designation', name: 'testimonialLocales.designation'},
				{data: 'image', name: 'image',"render": function (data, type, full, meta) {
							return (data) ? "<img src='" + data + "' height='50px'/>" : '';
						},
					"orderable": false,
					"searchable": false
				},
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