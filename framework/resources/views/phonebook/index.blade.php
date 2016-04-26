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
                <div class="caption font-green">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject bold uppercase">{{ $title }}</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{ route('phonebook.create') }}" class="btn sbold green"><i class="fa fa-plus"></i> Tambah Kontak</a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                            </th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ?>
                    @foreach($data as $row)
                    <?php 
                    if($row->status == 'A')
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
                            <td>
                                <input type="checkbox" class="checkboxes" value="{{ $row->id }}" />
                            </td>
                            <td>{{ Html::link(URL::route('phonebook.detail', $row->id), $row->nama) }}</td>
                            <td>{{ $row->alamat }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->birthday)->format('d-M-Y') }}</td>
                            <td>{{ $row->umur .' tahun' }}</td>
                            <td style="text-align: center;">
                                <span class="label label-sm label-{{ $label }}"> {{ $status }} </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

@endsection
