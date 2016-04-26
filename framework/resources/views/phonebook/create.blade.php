@extends('layouts.master')
@section('content')

<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="#">Home</a>
	        <i class="fa fa-circle"></i>
	    </li>
	    <li>
	        <span>{{ $title }}</span>
	    </li>
	</ul>
	<div class="page-toolbar">
	    
	</div>
</div>
                    
<h3 class="page-title"> {{ $title }} </h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> {{ $title }}</span>
                </div>
            </div>
            @include('layouts.partials.validation')
            <div class="portlet-body form">
                {!! Form::open(array('route' => 'phonebook.store', 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @include('phonebook._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

@endsection
