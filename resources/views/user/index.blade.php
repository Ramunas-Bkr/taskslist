@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                   <h3>Darbuotojų sąrašas</h3>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Vardas Pavardė</th>
                        <th scope="col" style="text-align:center">Darbų sąrašas</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tbody>
                      <tr>
                        <td scope="row"><b> {{$user->name}} </b></td>
                        <td style="text-align:center">
                            <form action="{{route('user.show',[$user])}}">
                                <button type="submit" class="btn btn-outline-primary btn-sm">DARBAI</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{route('user.update',[$user])}}">
                                <select name="user_isAdmin">
                                    <option value="0" @if(!$user->isAdmin) selected @endif>Darbuotojas</option>
                                    <option value="1" @if($user->isAdmin) selected @endif>Administratorius</option>
                                </select>
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">KEISTI STATUSĄ</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{route('user.destroy', [$user])}}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">TRINTI</button>
                            </form>
                        </td>
                      </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
