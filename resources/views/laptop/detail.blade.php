<x-laptop-layout>
    <x-slot name='title'>
        Laptop
    </x-slot>

    <div class='laptop-info'> 
        <div>
            <img src="{{asset('storage/image/'.$data->hinh_anh)}}" width="270px" height="300px">
        </div>

        <div>
            <h4>{{$data->tieu_de}}</h4>
            <div style="line-height: 1.6; margin-bottom: 15px;">
                CPU: {{$data->cpu}}<br>
                RAM: {{$data->ram}}<br>
                Ổ cứng: {{$data->luu_tru}}<br>
                Chip đồ họa: {{$data->chip_do_hoa}}<br>
                Nhu cầu: {{$data->nhu_cau}}<br>
                Màn hình: {{$data->man_hinh}}<br>
                Hệ điều hành: {{$data->he_dieu_hanh}}<br>
            </div>

            <p>Giá: <b class="price-style">{{number_format($data->gia, 0, ",", ".")}} VNĐ</b></p>    
            
            <div class='mt-1 mb-3'> 
                Số lượng mua:
                <input type='number' id='product-number' style="width: 60px; padding: 2px 5px;" min="1" value="1">
                <button class='btn btn-primary btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
            </div>

            <hr>
            
            <div>
                <h5>Thông tin khác</h5>
                Khối lượng: {{$data->khoi_luong}}<br>
                Webcam: {{$data->webcam}}<br>
                Pin: {{$data->pin}}<br>
                Kết nối không dây: {{$data->ket_noi_khong_day}}<br>
                Bàn phím:{{$data->ban_phim}}<br>
                Cổng kết nối: {{$data->cong_ket_noi}}<br>
            </div>
        </div>
    </div>
</x-laptop-layout>
<script>
$(document).ready(function(){
    $("#add-to-cart").click(function(){
        let id = "{{$data->id}}";
        let num = $("#product-number").val();
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('cartadd')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "num": num
            },
            success: function(data){
                $("#cart-number-product").html(data.total_items); 
                alert("Đã thêm sản phẩm vào giỏ hàng thành công!");
            },
            error: function (xhr, status, error){
                console.error(error);
                alert("Có lỗi xảy ra, vui lòng thử lại.");
            }
        });
    });
});
</script>
