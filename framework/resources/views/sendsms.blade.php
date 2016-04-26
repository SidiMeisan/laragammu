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
            @include('layouts.partials.alert')
            @include('layouts.partials.validation')
            <div class="portlet-body form">
                {!! Form::open(array('route' => 'sendsms', 'class' => 'form-horizontal', 'role' => 'form')) !!}
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1">Jenis Pesan</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="radio53" name="jenis" class="md-radiobtn" value="tunggal" checked>
                                    <label for="radio53">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Pesan Tunggal </label>
                                </div>
                                <div class="md-radio has-error">
                                    <input type="radio" id="radio54" name="jenis" class="md-radiobtn" value="broadcast">
                                    <label for="radio54">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Pesan Broadcast </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label">Nomor Tujuan</label>
                        <div class="col-md-5">
                            {!! Form::text('tujuan', null, ['class' => 'form-control']) !!}
                            <div class="form-control-focus"> </div>
                            <span class="help-block">
                            Pisahkan dengan separator koma jika memilih Pesan Broadcast, <br/>contoh: 098712344567,0896761234766
                            </span>
                        </div>
                    </div>
                    <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label">Pesan</label>
                        <div class="col-md-5">
                            {!! Form::textarea('pesan', null, ['class' => 'form-control', 'rows' => 5, 'onKeyDown' => "limitText(this.form.pesan,this.form.countdown,160);", 'onKeyUp' => "limitText(this.form.pesan,this.form.countdown,160);"]) !!}
                            <span class="help-block">(Maximum characters: 160)<br>
                            You have <input readonly type="text" name="countdown" size="3" value="160"> characters left.</span><br/>
                        </div>
                    </div>
                    
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            {!! Form::submit('Kirim', ['class' => 'btn blue']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

@endsection

<script>
function limitText(limitField, limitCount, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    } else {
        limitCount.value = limitNum - limitField.value.length;
    }
}
</script>