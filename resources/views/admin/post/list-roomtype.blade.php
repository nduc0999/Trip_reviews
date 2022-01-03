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
        {{-- <td><input type="checkbox" class="select-roomtype" name="select" data-id="{{ $item->id }}" data-name='{{ $item->name }}'></td> --}}
        <td>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input select-roomtype" id='roomtype-{{$item->id}}' data-id="{{ $item->id }}" data-name='{{ $item->name }}'>
            <label class="custom-control-label" for="roomtype-{{$item->id}}"></label>
          </div>
        </td>
       
        <td><label for="roomtype-{{$item->id}}">{{ $item->name }}</label></td>
        <td><label for="roomtype-{{$item->id}}">{{ $item->description }}</label></td>
      </tr>
          
      @empty
          <td colspan=""></td>
      @endforelse
 
  </tbody>
</table>