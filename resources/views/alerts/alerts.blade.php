@if($errors->all())
    <div class="col-md-12" style="padding-bottom: 0px; ">
    @foreach($errors->all() as $key => $mensagem)
        <alert mensagem="{{ $mensagem }}" tipo="danger" class="col-md-12"></alert>
    @endforeach
    </div>
@endif

@if(session('error'))
<div class="col-md-12">
    <alert mensagem="{{ session('error') }}" tipo="danger" class="col-md-12"></alert>
</div>
@endif

@if(isset($error) && !empty($error))
<div class="col-md-12" style="margin-bottom: 0px;">
    <alert mensagem="{{ $error }}" tipo="danger" class="col-md-12" style="margin-bottom: 0px;"></alert>
</div>
@endif

@if(session('success'))
<div class="col-md-12">
    <alert mensagem="{{ session('success') }}" tipo="success" class="col-md-12"></alert>
</div>
@endif