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
        @include('layouts.partials.alert')
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> {{ $title }}</span>
                </div>
            </div>
            @include('layouts.partials.validation')
            <div class="portlet-body form">
                {!! Form::model($data, array('route' => ['phonebook.update', 'id' => $data->id], 'class' => 'form-horizontal', 'role' => 'form')) !!}
                @include('phonebook._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="portlet light portlet-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-red"></i>
                <span class="caption-subject font-red sbold uppercase">Nomor Telepon</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                {!! Form::open(array('route' => 'phonebook.store.phone', 'name' => 'myform2')) !!}
                {!! Form::hidden('contact_id', $data->id) !!}
                <table class="table table-hover table-light">
                    <thead>
                        <tr class="uppercase">
                            <th>No.</th>
                            <th>Nomor Telepon</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach($phone as $nomor)
                    <?php 
                    if($nomor->status == 'A')
                    {
                        $status = 'Aktif';
                        $label  = 'info';
                    }
                    else
                    {
                        $status = 'Non Aktif';
                        $label  = 'danger';
                    }
                    ?>
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $nomor->phone }}</td>
                        <td><span class="label label-sm label-{{ $label }}"> {{ $status }} </span></td>
                        <td>
                        {!! Form::checkbox('cb', $nomor->phone) !!}
                        @if($errors->has('cb'))
                            <span class="help-block" style="color:red;">{{ $errors->first('cb') }}</span>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            {!! Form::text('phone', null, array('class' => 'form-control input-sm', 'size' => 10)) !!}
                            @if($errors->has('phone'))
                                <span class="help-block" style="color:red;">{{ $errors->first('phone') }}</span>
                            @endif
                        </td>
                        <td>
                            <label> {!! Form::radio('status', 'A', true) !!} Aktif</label>
                            <label> {!! Form::radio('status', 'N') !!} Non Aktif</label>
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::submit('Tambah Nomor. Tlp', array('name' => 'op', 'class' => 'btn blue')) !!}
    {!! Form::submit('Update Status', array('name' => 'op', 'class' => 'btn green')) !!}
    {!! Form::close() !!}
    </div>
</div>
<div class="clearfix"></div>

@endsection
