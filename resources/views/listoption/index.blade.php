@extends('master')
@section('content')
    <h2>List defined options</h2>   
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}



    @if(count($listOption) > 0)
      <form class="form-inline float-xs-right" id="form-search-list" style="display:none">
        <input class="form-control" type="text" placeholder="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div class="clearfix"></div>

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
            @foreach($listOption as $option)
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
     
      {{ $listOption->links() }}

    @else
      <h1 class="text-center">There are no options</h1>
    @endif


@endsection