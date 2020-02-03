@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Visų darbų sąrašas</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Vardas Pavardė</th>
                                <th scope="col">Darbas</th>
                                <th scope="col" colspan="4">Darbo aprašymas</th>
                                <th scope="col">Darbo statusas</th>
                                <th scope="col">Koreguoti darbą</th>
                                <th scope="col">Ištrinti darbą</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{$task->taskUser->name}}</th>
                                <td>{{$task->title}}</td>
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
                                    <form action="{{route('task.edit', [$task])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">Koreguoti</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{route('task.destroy', [$task])}}" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">IŠTRINTI</button>
                                    </form>
                                </td>
                                    
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
