


   <div class="modal fade" id="{{$modalId}}" role="dialog">
                                        <div class="modal-dialog  {{$modalSize == 'default' ? 'modals-' : 'modal-'}}{{$modalSize}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h2> {{ $modalTitle}}</h2>
                                             <p> {{ $modalContent }} </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Save changes</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            

