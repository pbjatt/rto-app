{{ Form::label('cc', 'Select Cubic Capacity'), ['class' => 'active'] }}
{{ Form::select('record[cc]', $ccArr,'0', ['class'=>'form-control', 'style'=> 'border:1px solid;', 'id' => 'cc_id']) }}