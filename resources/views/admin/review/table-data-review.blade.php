
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
                <th>Đã ẩn</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listReview as $data)
                <tr>
                    <td>{{ $loop->iteration + $listReview->firstItem() - 1 }}</td>
                    <td>{{$data->title}}</td>
                    <td><span class="less">{!! \Illuminate\Support\Str::limit(nl2br($data->comment), 100, $end = '...') !!}</span> 
                        <span class="full d-none">{!! nl2br($data->comment) !!}</span>
                        <a href="#" class="read-more">[Đọc thêm]</a>
                    </td>
                    <td><a href="{{ route('post.show',['slug' => Str::slug($data->post->name),'id' => $data->post->id]) }}" target="_blank">{{ $data->post->name }}</a></td>
                    <td>{{ $data->user->first_name." ".$data->user->last_name }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input hide-unhide-review" 
                            data-id={{ $data->id }} type="checkbox" data-change='{{ $data->status == 1 ? 0 : 1}}' value='{{$data->status}}' {{ $data->status == 1 ? 'checked':''}}>
                        </div>
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
    {!! $listReview->links('admin.pagination') !!}
</div>
      
