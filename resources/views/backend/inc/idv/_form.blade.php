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
  <div class="col-lg-3">
    <div class="form-group">
      {{ Form::label('record[zone]', 'Select Zone'), ['class' => 'active'] }}
      {{ Form::select('record[zone]', $zoneArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group">
      {{ Form::label('category', 'Select Category'), ['class' => 'active'] }}
      {{ Form::select('record[type_id]', $categoryArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required', 'id' => 'category_id']) }}
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group" id="ageSelect">
      @include('backend.template.age_select', compact('ageArr'))
    </div>
  </div>
  <div class="col-lg-3">
    <div class="form-group" id="ccSelect">
      @include('backend.template.cc_select', compact('ccArr'))
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group">
      {{ Form::label('idv', 'Enter Idv rate'), ['class' => 'active'] }}
      {{ Form::text('record[idv]','', ['class'=>'form-control', 'placeholder'=>'Enter Idv rate']) }}
    </div>
  </div>
</div>