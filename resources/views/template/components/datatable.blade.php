  <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="table-responsive">
                        <table id="{{$id}}" class="table {{$style}}">
                                <thead>
                                    <tr>
                                       

                                        @foreach ($datas as $data)

                                        <th>{{$data}}</th>
                                            
                                        @endforeach

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