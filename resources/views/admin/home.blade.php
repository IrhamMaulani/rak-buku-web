@extends('template.master')

@section('title', 'User')


@section('content')


 <!-- Main Menu area End-->
	<!-- Breadcomb area Start-->
    @breadcomb([
    'breadcomb' => ['title' => 'All User Data','content' => 'Add Data'],
    'button' => ['title' => 'Add User','datatarget' => 'myModalone','icon'  => 'plus-symbol']])
    @endbreadcomb
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
  
    @datatable(['id' => 'user-table', 'style' => 'table-striped', 
    'datas' => ['Name', 'Email', 'Author', 'Reputation', 'Roles', 'Edit', 'Delete'] ])

    @enddatatable

    @modal(['modalId' => 'myModalone', 'modalSize' => 'large', 'modalTitle' => 'Add Data'])
    
    @slot('modalContent')
                    <div class="">
                        <form id='form-create'>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="right-space-10px" ></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="text" name="name" id="name" class="form-control input-left-space" placeholder="Full Name">
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group form-elet-mg">
                                    <div class="form-ic-cmp">
                                        <i class="right-space-10px"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="email" name="email" class="form-control email-no-border" placeholder="Email" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row top-space-15px ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group float-lb form-elet-mg">
                                    <div class="form-ic-cmp">
                                       {{-- <i class="right-space-10px"></i> --}}
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" name="password" class="form-control input-left-space" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group float-lb form-elet-mg">
                                    <div class="form-ic-cmp">
                                       {{-- <i class="right-space-10px"></i> --}}
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row top-space-30px" >
                            <div class="col-lg-12">
                                <div class="form-group  form-elet-mg" >
                                  
                                   <div class="bootstrap-select" >
                                    <select class="selectpicker" id='role-select'
                                     title='Assign Role' multiple data-max-options="3" name="roles[]" style="padding-left:-10px;">
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>


              
{{-- <button type="submit" id="btn-form" value="Submit" class="btn btn-default" > aa</button> --}}
                        @slot('buttonTitle')
                            Submit
                        @endslot

                        @slot('footerContent')
                        </form>
                            
                        @endslot
                        
                     
                    </div>
              
           
    @endslot
        
    @endmodal

       </form>


    <button id="btn-click">click</button>

    
@endsection

@section('css')

 <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    
@endsection

@section('javascript')

 <script src="{{asset('js/data-table/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/data-table/data-table-act.js')}}"></script>

      <script src="{{asset('js/base-function.js')}}"></script>

    <script>

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


        $(document).ready(function () {
        
        var table = $('#user-table').DataTable({
            order:[[0,"desc"]],
            "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
            "ajax": "{{route('user.index')}}",
            "columns": [
                {
                    data: 'name'
                },
                 {
                    data: 'email'
                },
                 {
                    data: 'is_author'
                },
                  {
                    data: 'reputation'
                },
                 {
                    data: 'roles[,].name'
                },
                {
                    "defaultContent": "<button class='btn btn-info get-data'>Edit Data!</button>"
                },
                {
                    "defaultContent": "<button class='btn btn-danger delete-data'>Delete Data!</button>"
                }
            ],
        });
        });


        

        // const select = document.getElementById('role-select');

   
            const url = '{{route('role.index')}}';
            let select = document.getElementById('role-select');

            const button = document.getElementById('btn-click');

            

            button.addEventListener("click", function(){

            const selected = document.querySelectorAll('#role-select option:checked');

            });

            const csrfToken =  $('meta[name="csrf-token"]').attr('content');

            console.log(csrfToken);

            // let form = document.getElementById('btn-form');

            let form = document.getElementById('form-create');
            

            form.addEventListener("submit", function(event){

                event.preventDefault();

                const urlPost = '{{route('user.store')}}';

                let formData = new FormData(this);

                axios.post(urlPost, formData)
                .then(function (response) {
                    alert('succ')
                })
                .catch(function (error) {
                    console.log(error.response.data.message);
                });
            });
      
        fetchData(url);


    function fetchData(url){
   

    axios.get(url)
  .then(function (response) {
    let results = response.data.data;

    return results.map(function(result) {
      let option = createNode('option'),
          span = createNode('span');
     
      span.innerHTML = `${result.name}`;
      option.value = `${result.id}`;
      append(option, span);
      append(select, option);

      $('#role-select').selectpicker('refresh');
    })
    
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  })
  .finally(function () {
    // always executed
  });

        }

    </script>
    
@endsection


