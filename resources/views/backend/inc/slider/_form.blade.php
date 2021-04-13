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
    {{Form::text('record[title]', '', ['class' => 'squareInput', 'placeholder'=>'Enter title','required'=>'required'])}}
    {{Form::label('record[title]', 'Enter title'), ['class' => 'active']}}
  </div>
  <div class="col-lg-6">
    {{Form::file('image',['class'=>'form-control squareInput'])}}
    {{Form::label('image', 'Choose image'), ['class' => 'active']}}
  </div>
</div>