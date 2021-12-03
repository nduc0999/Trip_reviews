
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($arr_data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration + $arr_data->firstItem() - 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td class="text-bold-500">{{ $data->description }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <i class="bi bi-pencil-square text-primary me-2" data-bs-toggle="modal" data-bs-target="#formEdit"></i>
                                                <i class="bi bi-trash text-danger" data-id={{ $data->id }}></i>
                                            </td>
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                        </tr>
                                        
                                    @empty
                                        <tr>
                                            <td class="text-bold-500" colspan="5">No data</td>
                                        </tr>
                                    @endforelse
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {!! $arr_data->links('admin.pagination') !!}
                        </div>
      
