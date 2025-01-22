<div>
    <div class="pagetitle">
        <h1>Pembelian</h1>
    </div>

    <section class="bg-white p-2 shadow-sm">
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="product" class="form-label">Nama Produk</label>
                    <div class="row">
                        <div class="col-10">
                            <select name="" id="" class="form-select">
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary">+</button>
                        </div>
                    </div>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Rfjdsl</td>
                            <td class="text-end">{{ number_format(120000) }}</td>
                            <td class="text-center"><input type="number" class="w-25"></td>
                            <td class="text-end">{{ number_format(120000) }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="border p-2">
                    <h3 class="fw-bold text-center">Total Bayar : Rp12.000,000</h3>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="product" class="form-label">Supplayer</label>
                    <select name="" id="" class="form-select">
                        <option value=""></option>
                        @foreach ($suppliers as $item)
                            <option value="">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="product" class="form-label">Tanggal</label>
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>
    </section>
</div>
