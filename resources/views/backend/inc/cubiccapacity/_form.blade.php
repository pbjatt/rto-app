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
    <div class="form-group">
      {{Form::label('cc_range', 'Enter cubic capacity'), ['class' => 'active']}}
      {{Form::text('record[cc_range]', '', ['class' => 'form-control', 'placeholder'=>'Enter cubic capacity','required'=>'required'])}}
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group">
      {{ Form::label('category', 'Select Category'), ['class' => 'active'] }}
      {{ Form::select('record[type_id]', $categoryArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
</div>