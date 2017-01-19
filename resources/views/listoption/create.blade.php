@extends('master')
@section('content')
    <h2>Add new value for options {!! $optionParent->name !!}</h2>   
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}

    @if($optionParent->id > 0)
      {!! Form::open(['data-remote', 'route' => ['delete_list_option_path_ajax'],'method' => 'POST']) !!}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>             
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php ($i = 0)
            @foreach($optionChild as $option)
                @php ($i++)
            <tr>
              <th scope="row">{{ $i }}</th>
              <td><a href="{{ route('create_list_option_child_path', $option->id )}}">{!! $option->name !!}</a></td>
              
              <td>
                @if($option->default == 0)
                <label class="custom-control custom-checkbox">
                  {!! Form::checkbox('id_user[]', $option->id, '', ['class' => 'custom-control-input check-delete-option']) !!}                
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description" style="font-size:0px">a</span>
                </label>              
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      
        <a role="button" class="btn btn-danger btn-sm float-lg-right" href="#" id="delete-user-btn">Delete</a>
        
      {!! Form::close() !!}

      {!! Form::open(['route' => ['create_list_option_child_path', $optionParent->id],'files' => true]) !!}
        <div class="form-group">
          {!! Form::label('name','Name:') !!}
          {!! Form::text('name', null, ['class' => 'form-control']) !!}
          {!! $errors->first('name','<span class="error-input">:message</span>')  !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Add new', ['class' => 'btn btn-primary']) !!}
        </div>

        {{ Form::hidden('parent_id', $optionParent->id) }}
        
      {!! Form::close() !!}

    @else
      <h1 class="text-center">There are a problem</h1>
    @endif


@endsection