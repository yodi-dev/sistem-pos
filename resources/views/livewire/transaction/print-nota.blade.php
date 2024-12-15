<div>
    <div class="nota-header">
        <h2>Nama Toko</h2>
        <p>Alamat Toko: Jalan XYZ No. 123</p>
        <p>Telp: 0812-3456-7890</p>
    </div>
    <hr>
    <table class="nota-table">
        @foreach ($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', '.') }}</td>
                <td>{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>
    <hr>
    <p>Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
    <div class="nota-footer">
        <p>Terima kasih atas kunjungan Anda!</p>
    </div>
</div>
