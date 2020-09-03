@extends('layouts.app')

@section('content')
  <div class="table-responsive" style="height: 400px;">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>
            BRANCH NAME
          </th>
          <th>
            BRANCH ADDRESS
          </th>
          <th>
            AREA
          </th>
          <th>
            CONTACT PERSON
          </th>
          <th>
            PHONE 
          </th>
          <th>
            EMAIL 
          </th>
          <th>
            STATUS 
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach( $branch as $branch )
          <tr>
            <td>
              {{ $branch->name }}
            </td>
            <td>
              {{ $branch->address }}
            </td>
            <td>
              -----
            </td>
            <td>
              {{ $branch->head }}
            </td>
            <td>
              {{ $branch->phone }}
            </td>
            <td>
              {{ $branch->email }}
            </td>
            <td>
              @if ( $branch->status == 1)
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