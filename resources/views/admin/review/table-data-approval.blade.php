
<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Đánh giá</th>
                <th>Homestay-Resort</th>
                <th>Người đánh giá</th>
                <th>Ngày đánh giá</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listApproval as $data)
                <tr>
                    <td>{{ $loop->iteration + $listApproval->firstItem() - 1 }}</td>
                    <td>{{$data->title}}</td>
                    <td><span class="less">{!! \Illuminate\Support\Str::limit(nl2br($data->comment), 80, $end = '...') !!}</span> 
                        <span class="full d-none">{!! nl2br($data->comment) !!}</span>
                        <a href="#" class="read-more">[Đọc thêm]</a>
                    </td>
                    <td>{{ $data->post->name }}</td>
                    <td>{{ $data->user->first_name." ".$data->user->last_name }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <i class="bi bi-check2-square  text-primary me-3" data-status='0' data-id={{ $data->id }}></i>
                        <i class="bi bi-slash-circle  text-danger" data-status='1' data-id={{ $data->id }}></i>
                    </td>
                    <input type="hidden" name="id" value="{{ $data->id }}">
                </tr>
                
            @empty
                <tr>
                    <td class="text-bold-500" colspan="5">Không có đánh giá nào cần duyệt</td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    {!! $listApproval->links('admin.pagination') !!}
</div>
      
