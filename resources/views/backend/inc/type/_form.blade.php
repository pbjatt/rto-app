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
    {{Form::text('record[name]', '', ['class' => 'squareInput', 'placeholder'=>'Enter name','required'=>'required'])}}
    {{Form::label('record[name]', 'Enter name'), ['class' => 'active']}}
  </div>

  <div class="col-lg-6">
    <div class="form-group">
      {{ Form::label('type_id', 'Select Parent'), ['class' => 'active'] }}
      {{ Form::select('record[type_id]', $typeArr,'0', ['class'=>'form-control squareInput', 'style'=> 'border:1px solid;']) }}
    </div>
  </div>
</div>