<h2>Đơn hàng # {{ $order->id }}</h2>
<table border="1">
    <tr>
        <th style="width:10%" >STT</th>
        <th style="width:35%" >Sản phẩm</th>
        <th style="width:20%" >Giá</th>
        <th style="width:15%" >Số lượng</th>
        <th style="width:20%">Tổng</th>
    </tr>
    @php
        $total = 0;
    @endphp
    @foreach ($order->order_items as $item)
    @php
        $total += $item['product_price'] * $item['qty'];
    @endphp
        <tr>
            <td style="text-align: center;">{{ $loop->iteration }}</td>
            <td >{{ $item->product_name }}</td>
            <td style="text-align: center;">{{ number_format($item->product_price,0) }}</td>
            <td style="text-align: center;">{{ $item->qty }}</td>
            <td style="text-align: center;">{{ number_format($item->product_price * $item->qty, 0) }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="5"  style="padding: 5px"><strong>Tổng đơn hàng</strong></td>
    </tr>
    <tr>
        <td colspan="5" style="padding: 5px"><strong><span style="color: red">{{ number_format($total, 0) }}</span></strong></td>
    </tr>
</table>

