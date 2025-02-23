<div>
    <div class="page-header">
        <h4 class="page-title">Daftar Penjualan</h4>
    </div>

    <div class="page-category">
        <section class="card">
            <div class="card-header">
                <div class="row align-items-end">
                    <div class="col">
                        <label for="" class="form-label">Tanggal Awal</label>
                        <input wire:model="start_date" type="date" class="form-control">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Tanggal Akhir</label>
                        <input wire:model="end_date" type="date" class="form-control">
                    </div>
                    <div class="col">
                        <button wire:click="search" class="btn btn-info"><i class="fas fa-filter"> </i> Filter</button>
                        <button onclick="location.reload()" class="btn btn-warning"><i class="fas fa-sync-alt"> </i>
                            Reset</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <div class="btn-group mb-3 me-2">
                        <button wire:click="exportPdf" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"> </i> PDF</button>
                        <button wire:click="exportExcel" class="btn btn-sm btn-success"><i class="fas fa-file-excel"> </i> Excel</button>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="basic-datatables">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>Pelanggan</th>
                                <th>Total Item</th>
                                <th>Harga (Rp)</th>
                                <th>Discount</th>
                                <th>Total (Rp)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $index => $item)
                                <tr>
                                    <td class="text-center">{{ ++$index }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                    <td>{{ $item->sale_code }}</td>
                                    <td>{{ $item->costumer }}</td>
                                    <td class="text-center">{{ $item->salesDetails->sum('total_products') }}</td>
                                    <td class="text-end">{{ number_format($item->total_price) }}</td>
                                    <td class="text-center">{{ $item->discount }}%</td>
                                    <td class="text-end">{{ number_format($item->discount_price) }}</td>
                                    <td class="text-center">
                                        <a wire:navigate href="{{ route('sale.show', $item->id) }}"
                                            class="btn btn-xs btn-secondary"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#basic-datatables').DataTable();

                Livewire.on('datatables', (data) => {
                    setTimeout(() => {
                        $('#basic-datatables').DataTable().destroy();
                        $('#basic-datatables').DataTable();
                    }, 100); // Tunda 100 milidetik
                });
            })
        </script>
    @endpush
</div>
