{{ Form::label('age', 'Select Age'), ['class' => 'active'] }}
{{ Form::select('record[age]', $ageArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;','required'=>'required','id' => 'age_id']) }}