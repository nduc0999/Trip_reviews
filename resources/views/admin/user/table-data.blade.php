
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Họ</th>
                                        <th>Email</th>
                                        <th>Xác nhận email</th>
                                        <th>Trạng thái</th>
                                        <th>Cấm bình luận</th>
                                        <th>Thao tác</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($arr_data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration + $arr_data->firstItem() - 1 }}</td>
                                            <td>{{ $data->first_name }}</td>
                                            <td>{{ $data->last_name }}</td>
                                            <td>{{ $data->email}}</td>
                                            <td>
                                                <input class="form-check-input" disabled type="checkbox" value="" id="" {{ $data->email_verified_at != null ? 'checked':''}}>
                                            </td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input ban-unban-review" 
                                                    data-id={{ $data->id }} type="checkbox" value='{{$data->status}}' id="ban-review" {{ $data->status == 1 ? 'checked':''}}>
                                                </div>
                                            </td>
                                            <td >

                                                    <i class="bi bi-eye-fill text-primary me-3" ></i>
                                              
                                                    {{-- <i class="bi bi-trash text-danger bi-2x" data-id={{ $data->id }}></i> --}}

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
      
