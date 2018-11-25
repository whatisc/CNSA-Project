<!--Displays an object from the database and display it on the index-->

<div>
    <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
            <button name="edit-button" type='button' class='btn btn-default edit-button grey-back'>Edit School</button>
        </div>
    </div>
    <div class="object-div grey-back">
      <table width="100%">
        <tr>
          <td width="25%">School ID: {{$school->schoolId }} </td>
          <td width="25%"><a href="/schools/{{$school->schoolId}}">{{$school->schoolName}}</a></td>
          <td width="25%">School Population: {{$school->schoolPopulation}} </td>
          <td width="25%">School Rating: {{$school->schoolRanking}}</td>
        </tr>
      </table>
    </div>
</div>