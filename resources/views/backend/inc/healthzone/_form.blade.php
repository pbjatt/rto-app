@if($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">x</button>
  {{$message}}
</div>
@endif

@if(count($errors->all()))
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif
<div class="row">
  <div class="col-lg-12">
    {{Form::text('record[name]', '', ['class' => 'squareInput', 'placeholder'=>'Enter Health Zone Name','required'=>'required'])}}
    {{Form::label('record[name]', 'Enter Health Zone Name'), ['class' => 'active']}}
  </div>
  <div class="col-lg-12">
    {{ Form::label('satate_id', 'Select State'), ['class' => 'active','multiple'] }}
    {{ Form::select('state[]', $stateArr,'0', ['class'=>'form-control selectpicker select','multiple', 'style'=> 'border:1px solid;','required'=>'required']) }}
  </div>
</div>