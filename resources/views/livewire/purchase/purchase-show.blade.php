<div>
    <div class="page-header">
        <h4 class="page-title">Pembelian</h4>
    </div>

    <section class="card">
        <div class="card-body">
            {{-- kop --}}
            <section class="row">

                <div class="col-6">
                    <div class="d-flex align-items-center border-bottom border-black pb-2">
                        <img src="{{ Storage::url($company->company_logo) }}" alt="" width="55px">
                        <div class="d-flex flex-column ms-3" style="font-size: 12px">
                            <h5 class="fw-bold m-0 p-0">{{ $company->company_name }}</h4>
                                <small>{{ $company->address }}</small>
                                <small>Email: {{ $company->email . ', Telp. ' . $company->telephone }}</small>
                        </div>
                    </div>
                </div>
                <div class="col offset-1">
                    <table class="table table-sm" style="font-size: 14px">
                        <tr>
                            <td colspan="2" class="fw-bold">PEMBELIAN</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">No #</td>
                            <td>: {{ $purchase->purchase_code }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Tanggal</td>
                            <td>: {{ \Carbon\Carbon::parse($purchase->date)->format('d/m/Y') }}</td>
                        </tr>
                    </table>
                </div>
            </section>

            <hr>

            <section>
                <span style="font-size: 14px"><strong>Supplayer</strong> : {{ $purchase->supplier_name }}</span>
            </section>

            {{-- detail pembelian --}}
            <section class="mt-3">
                <table class="table table-sm table-bordered" style="font-size: 12px">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga Beli (Rp)</th>
                            <th>Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase_details as $index => $item)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ '(' . $item->product->product_code . ') - ' . $item->product->name }}</td>
                                <td class="text-center">{{ $item->total_products }}</td>
                                <td class="text-end">{{ number_format($item->purchase_price) }}</td>
                                <td class="text-end">{{ number_format($item->total_price) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">Subtotal</td>
                            <td class="text-end">{{ number_format($purchase->total_price) }}</td=>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end">Diskon %</td>
                            <td class="text-end">{{ $purchase->discount }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">TOTAL</td>
                            <td class="text-end fw-bold">{{ number_format($purchase->discount_price) }}</td>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="fw-bold">Ket.</div>
                                <div>{{ $purchase->description }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <hr>

            <div class="d-flex justify-content-end">
                <a wire:navigate href="{{ route('purchase') }}" class="btn btn-sm btn-secondary"><i class="fas fa-reply"> </i> Kembali</a>
                <button onclick="deletePurchase({{ $purchase->id }}, '{{ $purchase->purchase_code }}')" class="btn btn-sm btn-danger ms-2"><i class="far fa-trash-alt"> </i> Hapus</button>
            </div>

        </div>
    </section>

    @push('script')
        <script>
            function deletePurchase(id, name) {
                console.log(id, name);
                
                swal({
                    title: 'Yakin ingin hapus ' + name + ' ?',
                    buttons: {
                        confirm: {
                            text: 'Yes, delete it!',
                            className: 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            className: 'btn btn-danger'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {

                        Livewire.dispatch('destroy', {
                            id
                        });

                    } else {
                        swal.close();
                    }
                });
            }
        </script>
    @endpush
</div>
