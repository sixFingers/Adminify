<div class="well well-white main-cont">

<div class="page-header">
	<h2>Edit {{$model}}</h2>
</div>

@if($errors->has())
<div class="alert alert-error">
	<p><strong>Oops!</strong></p>
	<ul>
		{{implode('', $errors->all('<li>:message</li>'))}}
	</ul>
</div>
@endif

@if(Session::get('updated'))
<div class="alert alert-success">
	<p><strong>Awesome!</strong></p>
	<p>The {{$model}} was updated successfully!</p>
</div>
@endif

{{Form::open(null, 'PUT')}}

<div class="columns">

@foreach($structure as $field)
	
	<?php if(in_array($field->field, $excluded)) continue ?>

	{{Form::label($field->field, ucwords($field->field))}}

	<?php $name = $field->field ?>

	@if(stristr($field->type, 'text'))
    {{Form::textarea($field->field, $entry->$name)}}
	@elseif($field->field == 'password')
		{{Form::password($field->field)}}
	@else
    <?php 
    $out = Form::text($field->field, $entry->$name); 
    $field_name = $field->field;
    ?>
    @if(array_key_exists($field->field, $model::$rules))
      <?php $field_rules = explode("|", $model::$rules[$field->field]); ?>
      @foreach($field_rules as $rule)
        @if(substr($rule, 0, 3) == 'in:')
          <?php 
          $values = substr($rule, 3);
          $values = explode(",", $values);
          $values = array_combine($values, $values);
          $out = Form::select($field->field, $values, $entry->$field_name); 
          ?>
        @endif
      @endforeach
    @endif
    {{$out}}
	@endif

@endforeach

</div>

<div class="form-actions">
	{{Form::submit('Edit '.$model, array('class' => 'btn btn-success'))}}
</div>

{{Form::token()}}
{{Form::close()}}

</div>