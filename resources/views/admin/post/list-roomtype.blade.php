<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Select</th>
      <th scope="col">Tiện ích</th>
      <th scope="col">Mô tả</th>
    </tr>
  </thead>
  <tbody>
      @forelse ($arrayData as $item)
      <tr>
        <td><input type="checkbox" class="select-roomtype" name="select" data-id="{{ $item->id }}" data-name='{{ $item->name }}'></td>
       
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
      </tr>
          
      @empty
          <td colspan=""></td>
      @endforelse
 
  </tbody>
</table>