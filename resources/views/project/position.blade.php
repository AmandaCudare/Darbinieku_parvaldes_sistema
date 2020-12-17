

@if(count($positions)>0)

        <table class="table">
            <thead>
              <tr>
                <th>Amats</th>
                <th>Amatu skaits</th>
                <th></th>
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
                       {{-- --}} 
                       <?php $a=0 ?>
        @foreach($upositions as $uposition)  
          @if($uposition->position_id == $position->id)  
          <?php $a-- ?>     
    @if($uposition->accepted== '1' )
  <td> Status: Pieņemts</td>
  <td> </td>
   @elseif($uposition->accepted== '0' )
  <td> Status: Noraidīts </td>
  <td> </td>
    @else
  <td> Status: Pieteicies </td>
 @if($project->assign_till>$today) 
  <td>
   <a href="/userposition/delete/{{$position->id}}" class="btn btn-outline-danger">Noņemt pieteikumu</a>
    </td>
 @endif
     @endif 
     @endif
     <?php $a++ ?>
     @if(count($upositions) == $a && $project->assign_till>$today)
<td>
    <form method="post" action="{{ route('user_position.add') }}">
        @csrf
    <input type="hidden" name="position_id" value="{{ $position ->id }}" >
    <input type="submit" class="btn btn-outline-secondary" value="Pieteikties" >
    </form>
</td>
<td> </td>
     @endif
    </div>@endforeach
                    
                   {{-- <td>
                     @if($project->assign_till>$today) 
                    <a href="/userposition/delete/{{$position->id}}" class="btn btn-outline-danger">Noņemt pieteikumu</a>
                     @else
                    Nevar vairs pieteikties
                     @endif
                    </td>--}}
                    <td>
                     @if(Auth::user()->id == $project->creator_id)
                     <a href="/projects/positions/{{$position->id}}/edit" class="btn btn-warning">Rediģēt</a>
                    </td>
                    @endif 
                <td>
                  @if(Auth::user()->id == $project->creator_id)
                  <a href="/projects/positions/{{$position->id}}/delete" class="btn btn-danger">Dzēst </a>
                  @endif 
                </td>   

                     
                
              </tr>
              @endforeach 
            </tbody>
          </table>
 
@else 
<p>no positions </p>
@endif
