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
            <div class="portlet-body form">
                {!! Form::open(array('route' => 'cekpulsa', 'role' => 'form')) !!}
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                        <div class="col-md-3">
                            {!! Form::text('ussd', null, array('id' => 'ussd', 'class' => 'form-control', 'placeholder' => 'Kode Perintah', 'data' => route('cekpulsa'))) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::button('Cek Pulsa', array('class' => 'btn blue', 'id' => 'pulsa')) !!}
                        </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                        <div class="col-md-3">
                            <label>Respon</label>
                        </div>
                        <div class="col-md-5">
                            <p class="form-control-static" id="sisa_pulsa" style="color: blue;"></p>
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
{!! Html::script('assets/global/plugins/jquery.min.js') !!}
<script type="text/javascript">
    $(function(){
        
        $('#pulsa').bind('click', function(e){
            e.preventDefault();
            var unik   = Math.random() * 1000,
                input  = $('#ussd').val(),
                url    = $('#ussd').attr('data'),
                source = url + '?uid=' + unik,
                ane    = this;

            
            if(input != '')
            {
                $('p#sisa_pulsa').html('Silahkan tunggu ...');
                $.post(source, { nomor: input }, function(data){
                    console.log(data[0]);
                    
                    if(data == 'Error opening device, it doesn\'t exist.')
                        $('p#sisa_pulsa').html(data);

                    else if(data == 'Error opening device, it is already opened by other application.')
                        $('p#sisa_pulsa').html(data);
                    else
                        $('p#sisa_pulsa').html('Tidak ada balasan. Silahkan dicoba lagi.');
                    
                });
            }
            else
                $('p#sisa_pulsa').html('Kode Perintah belum diisi');
        });
    });
</script>