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
          <td width="50%"><a href="/schools/{{$school->schoolId}}">{{$school->schoolName}}</a></td>
          <td width="25%">High School Athletes: </td>
          <td width="25%">School Rating: {{$school->schoolRanking}}</td>
        </tr>
      </table>
    </div>
</div>