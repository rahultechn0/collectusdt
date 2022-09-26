<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>S No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Sponsor</th>
            <th>Team Business</th>
            <th>Date Joined	</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key => $user )

            @php 
                $business       = \App\Models\Transaction::where("user_id",$user['id'])->where("trans",0)->sum("amount");
            @endphp

            <tr>
            <td>@php echo $key+1;@endphp</td>
            <td>@php echo $user['fname'];@endphp</td>
            <td>@php echo $user['username'];@endphp</td>
            <td>@php echo $user->userDetails->username;@endphp</td>
            <td>$@php echo number_format($business,2); @endphp</td>
            <td>@php echo date("Y-m-d",strtotime($user['created_at'])); @endphp</td>
            </tr>
        @endforeach                                                
                                                                
            
    </tbody>
</table> 