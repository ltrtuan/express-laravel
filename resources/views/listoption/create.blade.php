@extends('master')
@section('content')
    <h2>Add new value for options {!! $optionParent->name !!}</h2>   
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}

   
    @if($optionParent->id > 0)
      {!! Form::open(['route' => ['edit_option_child_path', $optionParent->id],'method' => 'PATCH']) !!}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>             
              <th><a role="button" class="btn btn-danger btn-sm" href="#" id="delete-option-btn">Delete</a></th>
            </tr>
          </thead>
          <tbody>
            @php ($i = 0)
            @foreach($optionChild as $option)
                @php ($i++)
            <tr>
              <th scope="row">{{ $i }}</th>
              <td>
                <input type="text" name="name_option[]" class="form-control" value="<?php echo $option->name?>" />              
                {!! $errors->first('name_option.8','<span class="error-input">:message</span>')  !!}
              </td>
              
              <td>
                @if($option->default == 0)
                <label class="custom-control custom-checkbox">
                  {!! Form::checkbox('id_option[]', $option->id, '', ['class' => 'custom-control-input check-delete-option']) !!}                
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description" style="font-size:0px">a</span>
                </label>              
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        @if(count($optionChild) > 0)
        <div class="clearfix">          
          {!! Form::submit('Update', ['class' => 'btn btn-primary float-lg-right']) !!}
        </div>          
        @endif

      {!! Form::close() !!}

      {!! Form::open(['route' => ['create_list_option_child_path', $optionParent->id],'files' => true]) !!}
        <div class="form-group">
          {!! Form::label('name_option','Name:') !!}
          {!! Form::text('name_option', null, ['class' => 'form-control']) !!}
          {!! $errors->first('name_option','<span class="error-input">:message</span>')  !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Add new option', ['class' => 'btn btn-primary']) !!}
        </div>

        {{ Form::hidden('parent_id', $optionParent->id) }}
        
      {!! Form::close() !!}

      <!--  DELETE FORM -->
      {!! Form::open(['route' => ['delete_option_child_path', $optionParent->id],'method' => 'DELETE']) !!}
         {{ Form::hidden('id_option_delete', '') }}
      {!! Form::close() !!}
    @else
      <h1 class="text-center">There are a problem</h1>
    @endif


@endsection