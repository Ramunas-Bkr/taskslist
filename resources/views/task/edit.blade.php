@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                    <h3>Koreguoti darbą</h3>
                </div>
               <div class="card-body">
                    <form method="POST" action="{{route('task.update', [$task])}}">
                        <div class="form-group">
                            <label>Darbo pavadinimas</label>
                            <input type="text" name="task_title" class="form-control" value="{{$task->title}}">
                        </div>
                        <div class="form-group">
                            <label>Darbo aprašymas</label>
                            <textarea name="task_description" class="form-control" style="min-height:150px; max-height:300px">{{$task->description}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>Darbo statusas</label>
                            <select name="task_isDone" class="form-control">
                                <option value="0" @if(!$task->isDone) selected @endif>NEPADARYTAS</option>
                                <option value="1" @if($task->isDone) selected @endif>PADARYTAS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Darbą atliks:</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" @if($user->id == $task->user_id) selected @endif>
                                        {{$user->name}}
                                            (@if($user->isAdmin) Administratorius
                                                @else Darbuotojas
                                            @endif)
                                    </option>
                                 @endforeach
                            </select>
                        </div>
                        @csrf
                    <button type="submit" class="btn btn-outline-success">Pakeisti</button>
                 </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection