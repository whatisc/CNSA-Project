<div>
    <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
            <button name="edit-button" type='button' class='btn btn-default edit-button grey-back'>Edit Stadium</button>
        </div>
    </div>
    <div class="object-div grey-back">
      <table width="100%">
        <tr>
            <td width="33%"><a href=#>Stadium ID: {{$stadium->stadiumId}}</a></td>
            <td width="33%"><a href=#>{{$stadium->stadiumName}}</a></td>
            <td width="33%">{{$stadium->stadiumCapacity}}</td>
        </tr>
      </table>
    </div>
</div>