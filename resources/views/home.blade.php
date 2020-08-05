@extends('layouts.app')

@include('layouts.header')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 dashboard  container">

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

            <div class="row mt-5 ">
                <div class="col-md-12 mb-2 ">
                    <h4 class="">information sur le depart : </h4>
                </div>
                <div class="col-md-12">

                    <table class="table table-hover">

                        <tbody>
                            <tr>
                                <td>nombre total de clients</td>
                                <td>1452</td>
                            </tr>
                            <tr>
                                <td>nombre d'omt hors bouclage</td>
                                <td>1452</td>
                            </tr>
                            <tr>
                                <td>nombre de depart secours</td>
                                <td>1452</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        info flash sur le depart survolé
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-4">

                <div class="col-md-6">
                    <h5>chercher un poste par : </h5>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">gdo</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">nom</label>
                    </div>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <input class="form-control" type="text" id="default" list="languages" placeholder="e.g. JavaScript">

                    <datalist id="languages">
                        <option value="HTML">
                        <option value="CSS">
                        <option value="JavaScript">
                        <option value="Java">

                    </datalist>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block">go</button>
                </div>
            </div>
            <hr>
            <div class="row mt-3 poste-coupe">
                <div class="col-md-12">
                    <div class="scrollabale">
                        <table class="table table-fixed">
                            <thead class="thead-dark">
                                <tr>
                                    <th>poste coupé</th>
                                    <th>nombre de client </th>
                                    <th>ge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">

                                        <input class="form-check-input" type="checkbox" name="" id="">

                                    </td>
                                </tr>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">
                                        <input class="form-check-input" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">
                                        <input class="form-check-input" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">
                                        <input class="form-check-input" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">
                                        <input class="form-check-input" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">
                                        <input class="form-check-input" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>poste name</td>
                                    <td>457</td>
                                    <td class="ge">
                                        <input class="form-check-input" type="checkbox" name="" id="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div id="slider"></div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>clients coupées</th>
                                <th>puissance coupée </th>
                                <th>durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10</td>
                                <td>457</td>
                                <td class="ge">

                                    xxxxx

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>





        </div>


        <div class=" col-md-9 schema">
            schema
        </div>
    </div>

</div>
@endsection