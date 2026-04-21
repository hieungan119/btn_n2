<x-laptop-layout>
    <x-slot name="title">
        Danh sách Laptop
    </x-slot>

    <div class="mb-3 d-flex justify-content-center align-items-center" style="gap: 10px; background-color: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #dee2e6;">
        <p class="mb-0 font-weight-bold">Tìm kiếm theo:</p>
        
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" 
           class="btn btn-sm {{ request('sort') == 'asc' ? 'btn-dark' : 'btn-outline-dark' }}">
           Giá tăng dần
        </a>
        
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" 
           class="btn btn-sm {{ request('sort') == 'desc' ? 'btn-dark' : 'btn-outline-dark' }}">
           Giá giảm dần
        </a>

    </div>

    @if(request('brand_id'))
        <div class="text-center mb-3">
            <span class="badge badge-info p-2">
                Đang hiển thị thương hiệu: {{ $brands->firstWhere('id', request('brand_id'))->ten_danh_muc ?? 'Không xác định' }}
            </span>
        </div>
    @endif

   
 <div class="list-laptop">
        @foreach($laptops as $item)
            <div class="laptop shadow-sm bg-white mb-3 rounded" style="border: 1px solid #e0e0e0; position: relative;">
                <a href="{{ url('home/detail/'.$item->id) }}" style="text-decoration: none; color: inherit; display: block;">
                    <div class="p-2 text-center">
                        <img src="{{ asset('storage/image/'.$item->hinh_anh) }}" 
                             alt="{{ $item->tieu_de }}" 
                             class="img-fluid" 
                             style="height: 160px; object-fit: contain; width: 100%;">
                    </div>
                    
                    <div class="p-2">
                        <h6 class="font-weight-bold mb-1" style="font-size: 14px; line-height: 1.3; white-space: normal;">
                            {{ $item->tieu_de }}
                        </h6>
                    </div>
                </a>
                <div class="px-2 pb-2">
                    <i><p class="text-danger font-weight-bold mb-0 text-center" style="font-size: 15px;">
                        {{ number_format($item->gia, 0, ',', '.') }} đ
                    </p></i>
                </div>
            </div>
        @endforeach
    </div>

    @if($laptops->isEmpty())
        <div class="alert alert-info mt-4 text-center">
            Không tìm thấy sản phẩm nào phù hợp với lựa chọn của bạn.
        </div>
    @endif
</x-laptop-layout>