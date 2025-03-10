@include('partials.meta')

<input type="hidden" value="{{ request()-> category }}" name="categoy_id" id="categoy_id">
<h5 class="card-title">
    @if (request()->category == 1)
    UGD
    @endif

    @if (request()->category == 2)
    Perawatan
    @endif

    @if (request()->category == 3)
    Laboratorium
    @endif

    @if (request()->category == 4)
    Tindakan
    @endif

    @if (request()->category == 5)
    Penunjang
    @endif

    @if (request()->category == 6)
    Peralatan
    @endif

    @if (request()->category == 7)
    Obat -Obatan
    @endif
</h5>

<!-- Table with stripped rows -->
<table class="table datatable table-hover">
    <thead>
        <tr>
            <th>
                No
            </th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        @if (request()->category == 1)
        @foreach ($emergencies as $emergency)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $emergency->emergency_name }}</td>
            <td>Rp. {{ number_format($emergency->emergency_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('emergency.edit', $emergency->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah" class="badge bg-info border-0"><i class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

        @if (request()->category == 2)
        @foreach ($rooms as $room)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $room->room_name }}</td>
            <td>Rp. {{ number_format($room->room_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('room.edit', $room->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah" class="badge bg-info border-0"><i class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

        @if (request()->category == 3)
        @foreach ($laboratories as $laboratory)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $laboratory->laboratory_name }}</td>
            <td>Rp. {{ number_format($laboratory->laboratory_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('laboratory.edit', $laboratory->id)}}" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="Tambah" class="badge bg-info border-0"><i
                        class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

        @if (request()->category == 4)
        @foreach ($actions as $action)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $action->action_name }}</td>
            <td>Rp. {{ number_format($action->action_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('action.edit', $action->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah" class="badge bg-info border-0"><i class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

        @if (request()->category == 5)
        @foreach ($suports as $suport)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $suport->suport_name }}</td>
            <td>Rp. {{ number_format($suport->suport_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('suport.edit', $suport->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah" class="badge bg-info border-0"><i class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

        @if (request()->category == 6)
        @foreach ($tools as $tool)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $tool->tool_name }}</td>
            <td>Rp. {{ number_format($tool->tool_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('tool.edit', $tool->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah" class="badge bg-info border-0"><i class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

        @if (request()->category == 7)
        @foreach ($medicines as $medicine)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $medicine->medicine_name }}</td>
            <td>Rp. {{ number_format($medicine->medicine_price,2,",",".") }}</td>
            <td>
                <a href="{{ route('medicine.edit', $medicine->id)}}" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Tambah" class="badge bg-info border-0"><i class="bi bi-plus-square me-1"></i></a>
            </td>
        </tr>
        @endforeach
        @endif

    </tbody>
</table>
<!-- End Table with stripped rows -->

@include('partials.footer')