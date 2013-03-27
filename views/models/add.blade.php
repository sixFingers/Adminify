<div class="well well-white main-cont">

<div class="page-header">
	<h2>Add {{$model}}</h2>
</div>

@if($errors->has())
<div class="alert alert-error">
	<p><strong>Oops!</strong></p>
	<ul>
		{{implode('', $errors->all('<li>:message</li>'))}}
	</ul>
</div>
@endif

{{Form::open()}}

<div class="columns">

@foreach($structure as $field)
	
	<?php if(in_array($field->field, $excluded)) continue ?>

	{{Form::label($field->field, ucwords($field->field))}}

	<?php $name = $field->field ?>

	@if(stristr($field->type, 'text'))
		{{Form::textarea($field->field, Input::old($name))}}
	@elseif($field->field == 'password')
		{{Form::password($field->field)}}
	@else
    <?php $out = Form::text($field->field, Input::old($name)); ?>
    @if(array_key_exists($field->field, $model::$rules))
      <?php $field_rules = explode("|", $model::$rules[$field->field]); ?>
      @foreach($field_rules as $rule)
        @if(substr($rule, 0, 3) == 'in:')
          <?php 
          $values = substr($rule, 3);
          $values = explode(",", $values);
          $values = array_combine($values, $values);
          $out = Form::select($field->field, $values, Input::old($name)); 
          ?>
        @endif
      @endforeach
    @endif
    {{$out}}
	@endif

@endforeach

</div>

<div class="form-actions">
	{{Form::submit('Add '.$model, array('class' => 'btn btn-success'))}}
</div>

{{Form::token()}}
{{Form::close()}}

</div>