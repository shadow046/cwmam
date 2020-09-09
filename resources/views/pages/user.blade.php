@extends('layouts.app')

@section('content')
  <div class="table-responsive table-hover card" style="height: 400px;">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>
            FULL NAME
          </th>
          <th>
            EMAIL
          </th>
          <th>
            AREA
          </th>
          <th>
            BRANCH
          </th>
          <th>
            LEVEL
          </th>
          <th>
            STATUS
          </th>
        </tr>
        <tr>
          @for($i = 1; $i <= 6; $i++)
            <th><input type="text" /></th>           
          @endfor
      </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr class="edittr" id="datarow" data-toggle="modal" data-status="{{ $user->status }}" data-role="{{ $user->roles->first()->id }}" data-id="{{ $user->id }}" data-area="{{ $user->area->id }}" data-branch="{{ $user->branch->id }}" data-target="#userModal">
          <td>
            {{ $user->name }}
          </td>
          <td>
            {{ $user->email }}
          </td>
          <td>
            {{ $user->area->name }}
          </td>
          <td>
            {{ $user->branch->name }}
          </td>
          <td>
            {{ $user->roles->first()->name }}
          </td>
          <td>
            @if ( $user->status == 1 )
              Active
            @else 
              Inactive
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <input type="button" id="addBtn" class="button" value="New User">
  @include('modal.user') 
@endsection