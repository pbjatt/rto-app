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
    {{Form::text('record[slug]', '', ['class' => 'squareInput', 'placeholder'=>'Enter slug'])}}
    {{Form::label('record[slug]', 'Enter slug'), ['class' => 'active']}}
  </div>
  <div class="col-lg-12">
    {{ Form::textarea('record[link]','', ['class'=>'squareInput des-textarea', 'placeholder'=>'Enter link']) }}
    {{Form::label('record[link]', 'Enter link'), ['class' => 'active']}}
  </div>
</div>