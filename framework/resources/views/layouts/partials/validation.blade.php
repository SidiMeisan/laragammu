@if ($errors->count() > 0)
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($errors->all('<p>:message</p>') as $error)
            {!! $error !!}
    @endforeach
</div>
@endif