@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                    <h3>Įrašyti darbą</h3>
                </div>
               <div class="card-body">
                    <form method="POST" action="{{route('task.store')}}">
                        <div class="form-group">
                            <label>Darbo pavadinimas</label>
                            <input type="text" name="task_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Darbo aprašymas</label>
                            <textarea name="task_description" class="form-control" style="min-height:150px; max-height:300px"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Darbą atliks:</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}
                                        (@if($user->isAdmin) Administratorius
                                            @else Darbuotojas @endif)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                    <button type="submit" class="btn btn-outline-success">ĮRAŠYTI</button>
                 </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
