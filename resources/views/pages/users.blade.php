@extends('layouts.app')

@section('content')
  <div class="table-responsive" style="height: 400px;">
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
            BRANCH
          </th>
          <th>
            LEVEL
          </th>
          <th>
            STATUS
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>
            {{ $user->name }}
          </td>
          <td>
            {{ $user->email }}
          </td>
          <td>
            {{ $user->branch->name }}
          </td>
          <td>
            {{ $user->roles->first()->name }}
          </td>
          <td>
            @if ( $user->status == 1 )
              active
            @else 
              inactive
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <input type="button" value="Add">
  <input type="button" value="Edit">
  <input type="button" value="Save">
  <input type="button" value="Cancel">
@endsection