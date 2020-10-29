@extends('layout.app')

@section('content')
<form>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="Start date">Start date</label>
        <input  class="form-control" type="date" id="Start date" >
      </div>
      <div class="form-group col-md-6">
        <label for="End date">End date</label>
        <input class="form-control" type="date" id="End date">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="vacationtype">Vacation tpe</label>
        <select id="vacationtype" class="form-control">
          <option selected>Paid</option>
          <option>Non-paid</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="Supervisor">Supervisor</label>
        <input type="text" class="form-control" id="Supervisor">
      </div>
    </div> 
    <a type="submit" class="btn btn-primary">Save</a>
    <a type="submit" class="btn btn-primary">Submit</a>

  </form>

  @endsection