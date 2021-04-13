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
  <div class="col">
    <div class="form-group">
      {{ Form::label('record[company_id]', 'Select Company'), ['class' => 'active'] }}
      {{ Form::select('record[company_id]', $companyArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
  <div class="col">
    <div class="form-group">
      {{ Form::label('record[health_zone_id]', 'Select Zone'), ['class' => 'active'] }}
      {{ Form::select('record[health_zone_id]', $zoneArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
  <div class="col">
    <div class="form-group">
      {{ Form::label('record[family_size_id]', 'Select Family Size'), ['class' => 'active'] }}
      {{ Form::select('record[family_size_id]', $sizeArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>

  <div class="col">
    <div class="form-group">
      {{ Form::label('record[health_age_id]', 'Select Age'), ['class' => 'active'] }}
      {{ Form::select('record[health_age_id]', $ageArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>

  <div class="col">
    <div class="form-group">
      {{ Form::label('record[health_plan_id]', 'Select Plan'), ['class' => 'active'] }}
      {{ Form::select('record[health_plan_id]', $planArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
  <div class="col-lg-12">
    <div class="form-group">
      {{ Form::label('record[price]', 'Enter Price'), ['class' => 'active'] }}
      {{ Form::text('record[price]','', ['class'=>'form-control', 'placeholder'=>'Enter Price','required'=>'required']) }}
    </div>
  </div>
</div>