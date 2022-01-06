
<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Homestay-Resort</th>
                <th>Địa chỉ</th>
                <th>Sđt</th>
                <th>Email</th>
                <th>Người đăng</th>
                <th>Ngày tạo</th>
                <th>Xem toàn bộ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($list as $data)
                <tr>
                    <td>{{ $loop->iteration + $list->firstItem() - 1 }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{ $data->address.', '.$data->district.', '.$data->location->province }}</td>
                    <td>{{ $data->phone}}</td>
                    <td>{{ $data->email}}</td>
                    <td>{{ $data->user->first_name.' '.$data->user->last_name }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td><a href="{{route('admin.approval.post.show',['id'=> $data->id])}}" style="text-decoration: underline" >Xem</a></td>
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
      
