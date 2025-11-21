<div>
    <h1>Semua Laporan</h1>
    <p>Total: {{ $reports->count() }}</p>
    
    @if ($reports->count() > 0)
        <ul>
            @foreach ($reports as $report)
                <li>{{ $report->title }}</li>
            @endforeach
        </ul>
        
        <div>
            {{ $reports->links() }}
        </div>
    @else
        <p>Tidak ada laporan</p>
    @endif
</div>