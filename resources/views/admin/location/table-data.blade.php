
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Vùng</th>
                                        <th>Vĩ độ</th>
                                        <th>Kinh độ</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($arr_data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration + $arr_data->firstItem() - 1 }}</td>
                                            <td>{{ $data->province }}</td>
                                            <td class="text-bold-500">{{ $data->region }}</td>
                                            <td class="text-bold-500">{{ $data->latitude }}</td>
                                            <td class="text-bold-500">{{ $data->longtitude }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td >
                                              
                                                    <i class="bi bi-pencil-square text-primary me-3" data-bs-toggle="modal" data-bs-target="#formEdit"></i>
                                              
                                                    <i class="bi bi-trash text-danger bi-2x" data-id={{ $data->id }}></i>
                                              
                                            </td>
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                        </tr>
                                        
                                    @empty
                                        <tr>
                                            <td class="text-bold-500" colspan="7">No data</td>
                                        </tr>
                                    @endforelse
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {!! $arr_data->links('admin.pagination') !!}
                        </div>
      
