<div class="form-body">
    <div class="form-group form-md-line-input">
        <label class="col-md-2 control-label">Nama</label>
        <div class="col-md-5">
            {!! Form::text('nama', null, ['class' => 'form-control']) !!}
            <div class="form-control-focus"> </div>
        </div>
    </div>
    <div class="form-group form-md-line-input">
        <label class="col-md-2 control-label">Alamat</label>
        <div class="col-md-5">
            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
            <div class="form-control-focus"> </div>
        </div>
    </div>
    <div class="form-group form-md-line-input">
        <label class="col-md-2 control-label">Tanggal Lahir</label>
        <div class="col-md-5">
            {!! Form::text('birthday', null, ['class' => 'form-control form-control-inline input-medium date-picker']) !!}
            <div class="form-control-focus"> </div>
        </div>
    </div>
    @if(\Request::segment(2) == 'create')
    <div class="form-group form-md-line-input">
        <label class="col-md-2 control-label">Nomor Telepon</label>
        <div class="col-md-5">
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            <div class="form-control-focus"> </div>
        </div>
    </div>
    @endif
    <div class="form-group form-md-line-input">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-5">
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            <div class="form-control-focus"> </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-2 col-md-10">
            @if(\Request::segment(2) == 'detail')
            {!! Form::submit('Update', ['class' => 'btn blue']) !!}
            @else
            {!! Form::submit('Simpan', ['class' => 'btn blue']) !!}
            @endif
            {!! Html::link(URL::previous(), 'Kembali', ['class' => 'btn default']) !!}
        </div>
    </div>
</div>

{!! Html::script('assets/global/plugins/jquery.min.js') !!}
<script type="text/javascript">
    $(document).ready(function(){
        $('.date-picker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight:'TRUE',
        autoclose: true,
        forceParse: false
    });
    });
</script>