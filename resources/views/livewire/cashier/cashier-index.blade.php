<div>
    <section class="mb-3">
        <button wire:click="addOrder" class="btn btn-sm btn-primary"><i class="fas fa-plus"> </i> Order</button>
    </section>

    <section class="mb-3">
        <ul class="nav nav-tabs">
            @foreach ($sales_active as $item)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.sales', $item->id) }}">{{ $item->sale_code }}</a>
                </li>
            @endforeach
        </ul>
    </section>

    <section>
        <div class="table-responsive">
            <table class="table table-sm" id="basic-datatables">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Total Item</th>
                        <th>Harga (Rp)</th>
                        <th>Discount %</th>
                        <th>Total (Rp)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $index => $item)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                            <td>{{ $item->sale_code }}</td>
                            <td class="text-center">{{ $item->salesDetails->sum('total_products') }}</td>
                            <td class="text-end">{{ number_format($item->total_price) }}</td>
                            <td class="text-center">{{ $item->discount }}</td>
                            <td class="text-end">{{ number_format($item->discount_price) }}</td>
                            <td class="text-center">
                                @if ($item->status == 'Pending')
                                    <span class="badge text-bg-warning">{{ $item->status }}</span>
                                @elseif ($item->status == 'k-pending')
                                    <span class="badge text-bg-warning">Pending</span>
                                @else
                                    <span class="badge text-bg-success">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('print.receipt', $item->id) }}"
                                        class="btn btn-xs btn-info" target="_blank"><i class="fas fa-print"></i></a>
                                    <button onclick="deleteData({{ $item->id }}, '{{ $item->sale_code }}')"
                                        class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable();
            })
        </script>
        <script>
            $(window).on('load', function() {
                // menyembunyikan shidebar otomatis
                $('.gg-menu-right').click();
                $('.main-header').none();
            });
        </script>
    @endpush
</div>
