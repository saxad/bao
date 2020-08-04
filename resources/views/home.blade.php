@extends('layouts.app')

@include('layouts.header')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 dashboard">

            <div class="row d-flex justify-content-center">

                
                    <div class="form-group col-md-6">
                    <select class="custom-select form-control ">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    </div>

                    <div class="form-group col-md-6 ">
                    <select class="custom-select form-control">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    </div>
                

            </div>
        </div>


        <div class=" col-md-9 schema">
            schema
        </div>
    </div>

</div>
@endsection