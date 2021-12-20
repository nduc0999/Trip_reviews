
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Câu hỏi</th>
                                        <th>Hoạt động</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($arr_data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration + $arr_data->firstItem() - 1 }}</td>
                                            <td>{{ $data->question }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input activity-question" 
                                                    data-id={{ $data->id }} type="checkbox" id="activity-question" {{ $data->status == 0 ? 'checked':''}}>
                                                </div>
                                            </td>
                                            <td >
                                              
                                                    <i class="bi bi-pencil-square text-primary me-3" data-bs-toggle="modal" data-bs-target="#formEdit"></i>
                                              
                                                    <i class="bi bi-trash text-danger bi-2x" data-id={{ $data->id }}></i>
                                              
                                            </td>
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                        </tr>
                                        
                                    @empty
                                        <tr>
                                            <td class="text-bold-500" colspan="4">No data</td>
                                        </tr>
                                    @endforelse
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {!! $arr_data->links('admin.pagination') !!}
                        </div>
      
