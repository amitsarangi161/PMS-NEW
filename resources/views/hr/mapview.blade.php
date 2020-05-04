@extends('layouts.hr')

@section('content')
<table  class="table">
  <tr class="bg-blue">
    <td class="text-center">VIEW ATTENDANCE</td>
  </tr>
</table>
<table class="table">
  <form action="/showallempmapview" method="post">
    {{csrf_field()}}
  <tr>
    <td><strong>Select a Date</strong></td>
    <td><input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off"></td>
    <td><button type="submit" class="btn btn-primary">SHOW</button></td>
  </tr>
  </form>
  </table>

@endsection