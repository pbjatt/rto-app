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
  <div class="col-lg-6">
    {{Form::text('record[age]', '', ['class' => 'squareInput', 'placeholder'=>'Enter age','required'=>'required'])}}
    {{Form::label('record[age]', 'Enter age'), ['class' => 'active']}}
  </div>

  <div class="col-lg-6">
    {{ Form::label('category', 'Select Category'), ['class' => 'active'] }}
    {{ Form::select('record[type_id]', $categoryArr,'0', ['class'=>'form-control squareInput', 'style'=> 'border:1px solid;','required'=>'required']) }}
  </div>
</div>