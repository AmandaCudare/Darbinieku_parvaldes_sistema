
{{--Amata apskates lapa--}}
@if(count($positions)>0)

        <table class="table">
            <thead>
              <tr>
                <th>Amats</th>
                <th>Amatu skaits</th>
                <th>Status</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>@foreach($positions as $position)
             
              <tr>
                <td>{{ $position->name}}</td>
                <td>{{ $position->people_count}}</td>
                 
                        {{--Ja nav neviens pieteicis kādam amatam projektā--}}
                         @if(count($upositions) == 0 && $project->assign_till>$today)
                     <td>   <form method="post" action="{{ route('user_position.add') }}">
                          @csrf
                     <input type="hidden" name="position_id" value="{{ $position->id }}" >
                      <input type="submit" class="btn btn-outline-secondary" value="Pieteikties" >
                      </form> </td>
                      
                      @endif  
                      {{-- Pieteikšanās amatam pogas vai status--}} 
                        
        @foreach($upositions as $uposition)  
          {{--Parbauda vai amats sakrīt ar pieteikumu --}}
        @if($uposition->position_id == $position->id)  
        {{--Parbauda vai amata pieteikums ir aptiprināts --}}     
    @if($uposition->accepted== '1' )
  <td> Status: Pieņemts</td>
  {{--Parbauda vai amata pieteikums ir noraidīts --}}
   @elseif($uposition->accepted== '0' )
  <td> Status: Noraidīts </td>
    @else
  <td> Status: Pieteicies </td>
  {{--Parbauda vai projekta pieteikties datums ir pirms šodienas --}}
 @if($project->assign_till>$today) 
 {{--Amata pieteikuma noņemšanas poga --}}
  <td>
   <a href="/userposition/delete/{{$position->id}}" class="btn btn-outline-danger">Noņemt pieteikumu</a>
    </td>
     @endif
     @endif 
     
     @endif
     {{--Pārbauda vai projekta pieteikties datums ir pirms šodienas un vai šim amatam ir kāds pieteikums šim lietotājam--}}
     @if(App\Http\Controllers\ProjectsController::IfPositionEntry($position->id, $project->id) == true && $project->assign_till>$today)
    {{--Amata pieteikuma poga--}}
     <td>
    <form method="post" action="{{ route('user_position.add') }}">
        @csrf
    <input type="hidden" name="position_id" value="{{ $position ->id }}" >
    <input type="submit" class="btn btn-outline-secondary" value="Pieteikties" >
    </form>
</td>

@break
     @endif
     @endforeach
    </div>
    @if(App\Http\Controllers\ProjectsController::IfPositionEntry($position->id, $project->id) == true && $project->assign_till<=$today)
    <td></td>
    @endif
                    {{--Amata rediģēšanas poga--}}
                    <td>
                      {{--Pārbauda vai lietotājs ir projekta veidotājs--}}
                     @if(Auth::user()->id == $project->creator_id)
                     <a href="/projects/positions/{{$position->id}}/edit" class="btn btn-warning">Rediģēt</a>
                    </td>
                    @endif 
                    {{--Amata dzēšanas poga--}}
                <td>
                  {{--Pārbauda vai lietotājs ir projekta veidotājs--}}
                  @if(Auth::user()->id == $project->creator_id)
                  <a href="/projects/positions/{{$position->id}}/delete" class="btn btn-danger">Dzēst </a>
                  @endif 
                </td>   

              </tr>
              @endforeach 
            </tbody>
          </table>
 
@else 
<p>Nav neviens amatas izveidots šim projektam </p>
@endif
