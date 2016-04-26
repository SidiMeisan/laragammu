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
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> {{ $title }}</span>
                </div>
            </div>
            {!! Form::open(array('route' => 'outbox.delete')) !!}
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                {!! Form::submit('Delete', ['class' => 'btn sbold red']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                            <th>Nomor Tujuan</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                    <?php
                    if($row->Status == 'SendingOKNoReport')
                    {
                        $status = 'Terkirim';
                        $label  = 'info';
                    }
                    elseif($row->Status == 'SendingError')
                    {
                        $status = 'Gagal';
                        $label  = 'danger';
                    }
                    $date = explode(' ', $row->SendingDateTime);
                    $tgl  = $date[0];
                    $time = $date[1];
                    ?>
                        <tr class="odd gradeX">
                            <td style="width: 5%;">
                                <input type="checkbox" class="checkboxes" value="{{ $row->ID }}" name="cb[]"/> </td>
                            <td>{{ $row->DestinationNumber }}</td>
                            <td>{{ $row->TextDecoded }}</td>
                            <td style="width: 17%;text-align: center;">{{ \Carbon\Carbon::parse($tgl)->format('d-M-Y') .' '. $time }}</td>
                            <td style="width: 7%;text-align: center;">
                                <span class="label label-sm label-{{ $label }}"> {{ $status }} </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

@endsection
