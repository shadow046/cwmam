@extends('layouts.app')

@section('content')
  <div class="table-responsive table-hover" style="height: 400px;">
    <table class="table display" id="example">
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
        <tr>
            <th><input type="text" size="14" /></th>           
            <th><input type="text" size="45" /></th>           
          @for($i = 1; $i <= 5; $i++)
            <th><input type="text" size="16" /></th>           
          @endfor
        </tr>
      </thead>
      <tbody>
        @foreach( $branch as $branch )
          <tr class="edittr" id="datarow" data-toggle="modal" data-status="{{ $branch->status }}" data-id="{{ $branch->id }}" data-area="{{ $branch->area->id }}" data-target="#branchModal">
            <td>
              {{ $branch->name }}
            </td>
            <td>
              {{ $branch->address }}
            </td>
              <td>
                {{ $branch->area->name }}
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
  </div><br>
  <input type="button" id="addBtn" class="button" value="Add Branch">
  @include('modal.branch')  
@endsection