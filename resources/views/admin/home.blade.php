@extends('template.master')

@section('title', 'User')


@section('content')


 <!-- Main Menu area End-->
	<!-- Breadcomb area Start-->
    @breadcomb([
    'breadcomb' => ['title' => 'All User Data','content' => 'Add Data'],
    'button' => ['title' => 'Add User','datatarget' => 'myModalone','icon'  => 'plus-symbol', 'id' => 'btn-add']])
    @endbreadcomb
	<!-- Breadcomb area End-->
    <!-- Data Table area Start-->
  
    @datatable(['id' => 'user-table', 'style' => 'table-striped', 
    'datas' => ['id', 'Name', 'Email', 'Author', 'Reputation', 'Roles', 'Edit', 'Delete'] ])

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
                                        <input type="text" name="name" id="name" class="form-control input-left-space" placeholder="Full Name" required>
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
                                        <input type="email" name="email" id='email' class="form-control email-no-border" placeholder="Email" required >
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
                                        <input type="password" name="password" id="password" class="form-control input-left-space" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group float-lb form-elet-mg">
                                    <div class="form-ic-cmp">
                                       {{-- <i class="right-space-10px"></i> --}}
                                    </div>
                                    <div class="nk-int-st">
                                        <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row top-space-30px" >
                            <div class="col-lg-12">
                                <div class="form-group  form-elet-mg" >
                                  
                                   <div class="bootstrap-select" >
                                    <select class="selectpicker" id='role-select'
                                     title='Assign Role' multiple data-max-options="3" name="roles[]" style="padding-left:-10px;" required>
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="send-type" name="send-type" value="post">


              
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

    let userId;
    let typeSend = document.querySelector('#send-type').value; 

    const select = document.getElementById('role-select');

    const csrfToken =  $('meta[name="csrf-token"]').attr('content');

    const form = document.getElementById('form-create');

    const btnAdd = document.querySelector('#btn-add');


        $(document).ready(function () {
        
        var table = $('#user-table').DataTable({
        "columnDefs": [
        {'targets' : 0, 'visible' : false},
        {"className": "dt-center", "targets": "_all"}
       
      ],
            order:[[0,"desc"]],
      
            "ajax": "{{route('user.index')}}",
            "columns": [
                {
                    data : 'id'
                },
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
                    "defaultContent": "<button class='btn btn-info edit-data'>Edit Data!</button>"
                },
                {
                    "defaultContent": "<button class='btn btn-danger delete-data' data-send='put'>Delete Data!</button>"
                }
            ],
        });

        $('#user-table').css('visibility', 'visible');

        $('#user-table tbody').on( 'click', '.edit-data', function () {
                var data = table.row( $(this).parents('tr') ).data();

                typeSend = "put";

                $('#myModalone').modal('show');
                 form.reset();

                form.elements['name'].value = data.name;
                form.elements['email'].value = data.email;
                let values = data.roles;

                // console.log(values[0].name);

                let selectValues = [];

               Object.keys(values).forEach(function (key) {
                    selectValues.push(values[key].id);
                    });

            $('#role-select').selectpicker('val', selectValues);

            //  form.elements['password'].style.visibility = "hidden";

             hideComponents([form.elements['password'], form.elements['password_confirmation']]);

                userId = data.id;
            } );

        $('#user-table tbody').on( 'click', '.delete-data', function () {
                var data = table.row( $(this).parents('tr') ).data();

                let urlDelete = '{{route('user.store')}}' + '/'+ data.id;

                 if (confirm("Data will deleted. Are You Sure?")) {
                     deleteData(urlDelete);
                 }

             
            } );

        });

        function hideComponents(params){
            params.forEach(element => {
                element.style.visibility = "hidden";
                element.required = false;
            });
        }

          function showComponents(params){
            params.forEach(element => {
                element.style.visibility = "visible";
            });

        }

            btnAdd.addEventListener('click', function() {
               typeSend = 'post'; 
               form.reset();
                showComponents([form.elements['password'], form.elements['password_confirmation']]);
                $('#role-select').selectpicker('refresh');
            });
           

            form.addEventListener("submit", function(event){

                event.preventDefault();                


                const urlPost = '{{route('user.store')}}';

                const urlPut =  urlPost + '/' + userId;

                let formData = new FormData(this);

                if(typeSend == 'post'){
                    postData(urlPost, formData);
                }else{
                    putData(urlPut, formData);
                }

             
            });

              function putData(urlPut, formData){

                  formData.append('_method', 'PUT');
                  formData.delete('password');

                axios.post(urlPut, formData)
                .then(function (response) {
                    refreshDataTable();
                    alert('succ');
                })
                .catch(function (error) {

                    const errors = error.response.data.errors;

                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            const element = errors[key];

                            alert(element);
                            
                        }
                    }
                    
                });
            }

            function deleteData(urlDelete){

                axios.delete(urlDelete)
                .then(function (response) {
                    refreshDataTable();
                    alert('succ');
                })
                .catch(function (error) {

                    const errors = error.response.data.errors;

                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            const element = errors[key];

                            alert(element);
                            
                        }
                    }
                    
                });
            }

             function postData(urlPost, formData){

                axios.post(urlPost, formData)
                .then(function (response) {
                    refreshDataTable();
                    alert('succ');
                })
                .catch(function (error) {

                    const errors = error.response.data.errors;

                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            const element = errors[key];

                            alert(element);
                            
                        }
                    }
                    
                });

            }

        const url = '{{route('role.index')}}';
      
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

         function refreshDataTable(){
             $('#user-table').DataTable().ajax.reload();  
        }

    </script>
    
@endsection


