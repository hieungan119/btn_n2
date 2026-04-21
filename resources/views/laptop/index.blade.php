<x-laptop-layout>
    <x-slot name="title">Danh sách Laptop</x-slot>

    <div class="mb-3 d-flex justify-content-center align-items-center" style="gap: 10px; background-color: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #dee2e6;">
        <p class="mb-0 font-weight-bold">Sắp xếp theo giá:</p>
        
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" 
           class="btn btn-sm {{ request('sort') == 'asc' ? 'btn-dark' : 'btn-outline-dark' }}">
           Giá tăng dần
        </a>
        
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" 
           class="btn btn-sm {{ request('sort') == 'desc' ? 'btn-dark' : 'btn-outline-dark' }}">
           Giá giảm dần
        </a>
    </div>

   

    <div class="list-laptop">
        @foreach($laptops as $item)
            <div class="laptop shadow-sm bg-white mb-3 rounded" style="border: 1px solid #e0e0e0;">
                <a href="{{ url('home/detail/'.$item->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="p-2 text-center">
                        <img src="{{ asset('storage/image/'.$item->hinh_anh) }}" 
                             class="img-fluid" style="height: 160px; object-fit: contain;">
                    </div>
                    <div class="p-2">
                        <h6 class="font-weight-bold">{{ $item->tieu_de }}</h6>
                    </div>
                </a>
                <div class="px-2 pb-2">
                    <i><p class="text-danger font-weight-bold text-center">
                        {{ number_format($item->gia, 0, ',', '.') }} đ
                    </p></i>
                </div>
            </div>
        @endforeach
    </div>
</x-laptop-layout>