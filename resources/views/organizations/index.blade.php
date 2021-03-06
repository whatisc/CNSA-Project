@extends ('layout.header')

@section ('content')

<div>
    <div class='btn-toolbar pull-right'>
        <div class='btn-group'>
            <a class="btn btn-default new-button grey-back" href="/organizations/create">New Organization</a>
        </div>
    </div>
     <h1 class="content-header grey-back">All Organizations</h1>
</div>
<hr/>

@foreach ($organizations as $organization)
	@include ('organizations.organization')
	<br/>
@endforeach

@endsection