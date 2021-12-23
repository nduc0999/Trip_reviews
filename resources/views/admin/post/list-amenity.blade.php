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
      
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input select" id='amenity-{{$item->id}}' name="select" data-id="{{ $item->id }}" data-name='{{ $item->name }}'>
            <label class="custom-control-label" for="amenity-{{$item->id}}"></label>
          </div>
        </td>
       
        <td>{{ $item->name }}</td>
        <td>{{ $item->description }}</td>
      </tr>
          
      @empty
          <td colspan=""></td>
      @endforelse
 
  </tbody>
</table>