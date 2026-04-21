<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .main-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 30px; }
        .header-title { text-align:center; font-weight:bold; font-size: 26px; color: #1a73e8; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px; }
        .btn-add-green { background-color: #28a745; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; display: inline-block; transition: 0.3s; border: none; }
        .btn-add-green:hover { background-color: #218838; color: white; text-decoration: none; }
        .img-product { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11 main-container">
                <div class="header-title">
                    Hệ Thống Quản Lý Sản Phẩm 
                </div>

                <div class="mb-4">
                    <a href="{{ url('/order/create') }}" class="btn-add-green">
                        <i class="fas fa-plus"></i> Thêm 
                    </a>
                </div>

                <table id="laptop-table" class="table table-bordered table-hover w-100">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>CPU</th>
                            <th>RAM</th>
                            <th>Ổ cứng</th>
                            <th>Khối lượng</th>
                            <th>Nhu cầu</th>
                            <th>Giá bán</th>
                            <th>Ảnh</th>
                            <th style="width: 130px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ds_sanpham as $sp)
                        <tr>
                            <td class="font-weight-bold">{{ $sp->tieu_de }}</td>
                            <td>{{ $sp->cpu }}</td>
                            <td>{{ $sp->ram }}</td>
                            <td>{{ $sp->luu_tru }}</td>
                            <td>{{ $sp->khoi_luong }}</td>
                            <td>{{ $sp->nhu_cau }}</td>
                            <td><b class="text-success">{{ number_format($sp->gia, 0, ',', '.') }}đ</b></td>
                            <td class="text-center">
                                <img src="{{ asset('storage/image/' . $sp->hinh_anh) }}" class="img-product" alt="laptop-img">
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ url('/home/detail/'.$sp->id) }}" class='btn btn-sm btn-primary'>Xem</a>
                                    &nbsp;
                                    <form method='post' action="{{ route('laptop.delete', ['id' => $sp->id]) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                        @csrf
                                        <input type='submit' class='btn btn-sm btn-danger' value='Xóa'>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>

    <script>
    $(document).ready(function() {
        $('#laptop-table').DataTable({
            responsive: true,
            pageLength: 10, 
            lengthMenu: [10, 25, 50, 100], 
            bStateSave: true,
            
        });
    });
    </script>
</body>
</html>