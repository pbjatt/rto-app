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
  <div class="col-lg-4">
    <div class="form-group">
      {{ Form::label('category', 'Select Category'), ['class' => 'active'] }}
      {{ Form::select('record[type_id]', $categoryArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required', 'id' => 'category_id']) }}
    </div>
  </div>
  @if ($category->slug != 'gcv-3w-public' && $category->slug != 'gcv-3w-private' && $category->slug != 'gcv-other-then-3w-private' && $category->slug != 'gcv-other-then-3w-public' && $category->slug != 'miscd' && $category->slug != '3w-below-6-seats' && $category->slug != '3w-above6-seats' && $category->slug != 'school-bus' && $category->slug != 'tourist-bus')
  <div class="col-lg-4">
    <div class="form-group" id="ccSelect">
      @include('backend.template.cc_select', compact('ccArr'))
    </div>
  </div>
  @endif
  @if ($category->slug != 'gcv-3w-public' && $category->slug != 'gcv-3w-private' && $category->slug != 'gcv-other-then-3w-private' && $category->slug != 'gcv-other-then-3w-public' && $category->slug != 'miscd' && $category->slug != '3w-below-6-seats' && $category->slug != '3w-above6-seats' && $category->slug != 'school-bus' && $category->slug != 'tourist-bus' && $category->slug != 'texi' && $category->slug != '2w')
  <div class="col-lg-4">
    <div class="form-group">
      {{ Form::label('record[type]', 'Select Type'), ['class' => 'active'] }}
      {{ Form::select('record[type]', $typeArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
  @endif
  @if ($category->slug != 'gcv-3w-public' && $category->slug != 'gcv-3w-private' && $category->slug != 'gcv-other-then-3w-private' && $category->slug != 'gcv-other-then-3w-public' && $category->slug != 'miscd' && $category->slug != '3w-below-6-seats' && $category->slug != '3w-above6-seats' && $category->slug != 'school-bus' && $category->slug != 'tourist-bus' && $category->slug != 'texi' && $category->slug != '2w')
  <div class="col-lg-4">
    <div class="form-group">
      {{ Form::label('record[type]', 'Select Type'), ['class' => 'active'] }}
      {{ Form::select('record[type]', $typeArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required']) }}
    </div>
  </div>
  @endif
  @if ($category->slug == '3w-below-6-seats' || $category->slug == '3w-above6-seats' || $category->slug == 'school-bus' || $category->slug == 'tourist-bus' || $category->slug == 'texi' || $category->slug == '2w')
  <div class="col-lg-4">
    <div class="form-group">
      {{ Form::label('per_pessanger', 'Enter Per Pessanger Price'), ['class' => 'active'] }}
      {{ Form::text('record[per_pessanger]','', ['class'=>'form-control', 'placeholder'=>'Enter Per Pessanger Price']) }}
    </div>
  </div>
  @endif
  <div class="col-lg-12">
    <div class="form-group">
      {{ Form::label('price', 'Enter Price'), ['class' => 'active'] }}
      {{ Form::text('record[price]','', ['class'=>'form-control', 'placeholder'=>'Enter Price']) }}
    </div>
  </div>
</div>