@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                    <h4> Darbų sąrašas, kuriuos atlieka <b> {{$user->name}} </b></h4>
                </div>
                   <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Darbas</th>
                            <th scope="col" colspan="4">Darbo aprašymas</th>
                            <th scope="col">Darbo statusas</th>
                            <th scope="col">Keisti statusą</th>
                            @if ($user->isAdmin)
                                <th scope="col">Trinti darbą</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            @if ($user->id != $task->user_id) @continue @endif
                            <tr>
                                <th scope="row">{{$task->title}}</th>
                                <td colspan="4">{{$task->description}}</td>
                                    @if($task->isDone)
                                        <td class="bg-success"> 
                                        Padaryta
                                    @else
                                        <td class="bg-danger"> 
                                        Nepadaryta
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{route('task.smallupdate', [$task])}}">
                                        <div class="container" style="display: none;">
                                            Pavadinimas: <input type="text" name="task_title" value="{{$task->title}}">
                                            Aprašymas: <textarea name="task_description">{{$task->description}}</textarea>
                                            <select name="user_id">
                                            <option value="{{$user->id}}" @if($user->id == $task->user_id) selected @endif>{{$user->name}}</option>
                                        </select>
                                        </div>
                                        <select name="task_isDone">
                                            <option value="0" @if(!$task->isDone) selected @endif>Nepadaryta</option>
                                            <option value="1" @if($task->isDone) selected @endif>Padaryta</option>
                                        </select>
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">PAKEISTI</button>
                                    </form>
                                </td>
                                @if ($user->isAdmin)
                                <td>
                                    <form method="POST" action="{{route('task.destroy', [$task])}}" style="display: inline-block;">
                                     @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">IŠTRINTI</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection