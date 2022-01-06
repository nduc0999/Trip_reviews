
<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Homestay-Resort</th>
                <th>Địa chỉ</th>
                <th>Rate</th>
                <th>Sđt</th>
                <th>Email</th>
                <th>Người đăng</th>
                <th>Ngày tạo</th>
                <th>Hoạt động</th>
                <th>Nháp</th>
                <th>Sửa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
                <tr>
                    <td>{{ $loop->iteration + $list->firstItem() - 1 }}</td>
                    <td>
                        @if ($data->status == 0)
                            <a href="{{ route('post.show',['slug' => Str::slug($data->name),'id' => $data->id]) }}" target="_blank">{{ $data->name }}</a>
                        @else
                            {{$data->name}}
                        @endif
                    </td>
                    <td>{{ $data->address.', '.$data->district.', '.$data->location->province }}</td>
                    <td>{{$data->avg_rate}}</td>
                    <td>{{ $data->phone}}</td>
                    <td>{{ $data->email}}</td>
                    <td>{{ $data->user->first_name.' '.$data->user->last_name }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input activity-inactive-post" 
                            data-id={{ $data->id }} type="checkbox" value="{{$data->status}}" data-change='{{ $data->status == 0 ? 1 : 0}}' {{$data->status == 3? 'disabled':''}} {{ $data->status == 0 ? 'checked':''}}>
                        </div>
                    </td>
                    <td>
                        @if ($data->status == 3)
                            <span class="badge rounded-pill bg-warning">Drafts</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.manager.post.edit.show',['id'=>$data->id])}}">
                            <i class="bi bi-pencil-square text-primary me-3"></i>
                        </a>
                        @if($data->status == 3)
                            <i class="bi bi-trash text-danger bi-2x" data-id={{ $data->id }}></i>
                        @endif
                        </td>
                    <input type="hidden" name="id" value="{{ $data->id }}">
                </tr>
                
            @empty
                <tr>
                    <td class="text-bold-500" colspan="5">Không có giá trị đánh giá nào</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    {!! $list->links('admin.pagination') !!}
</div>
      
