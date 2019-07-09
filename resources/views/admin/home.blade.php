@extends('template.master')

@section('title', 'User')


@section('content')

{{-- <table class="table">
    <th>Name</th>
    <th>Email</th>
    @foreach ($userWithRoles as $userWithRole)
    <tr>
<td>{{$userWithRole->name}}</td> 
<td>{{$userWithRole->email}}</td>   
    <td>@foreach ($userWithRole->roles as $role)
        {{$role->name}}
        {{','}}
    @endforeach</td>

</tr>
    @endforeach
</table> --}}
    

 <!-- Main Menu area End-->
	<!-- Breadcomb area Start-->
	<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-windows"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>All User Data</h2>
										<p>Add Data </p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Add user" class="btn"><i class="notika-icon notika-plus-symbol"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
@endsection


@section('javascript')

 <script src="{{asset('js/data-table/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/data-table/data-table-act.js')}}"></script>
    
@endsection


