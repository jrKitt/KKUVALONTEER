@extends("components/layouts/layoutAdmin")

@section('title', 'จัดการชั่วโมงจิตอาสา')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-clock text-primary me-2"></i>จัดการชั่วโมงจิตอาสา</h2>
    <a href="{{ route('volunteer-hours.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>เพิ่มชั่วโมงจิตอาสา
    </a>
</div>

@if($volunteerHours->count() > 0)
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">รวมชั่วโมงทั้งหมด</h6>
                            <h3>{{ $volunteerHours->sum('hours') }} ชั่วโมง</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">อนุมัติแล้ว</h6>
                            <h3>{{ $volunteerHours->where('status', 'approved')->sum('hours') }} ชั่วโมง</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">รออนุมัติ</h6>
                            <h3>{{ $volunteerHours->where('status', 'pending')->sum('hours') }} ชั่วโมง</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-hourglass-half fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">รายการชั่วโมงจิตอาสา</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>วันที่</th>
                            <th>กิจกรรม</th>
                            <th>รายละเอียด</th>
                            <th>ชั่วโมง</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volunteerHours->sortByDesc('date') as $hour)
                        <tr>
                            <td>{{ $hour->date->format('d/m/Y') }}</td>
                            <td>{{ $hour->activity_name }}</td>
                            <td>{{ Str::limit($hour->description ?? '-', 50) }}</td>
                            <td>
                                <span class="badge bg-info">{{ $hour->hours }} ชั่วโมง</span>
                            </td>
                            <td>
                                @switch($hour->status)
                                    @case('approved')
                                        <span class="badge bg-success">อนุมัติแล้ว</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">ไม่อนุมัติ</span>
                                        @break
                                    @default
                                        <span class="badge bg-warning">รออนุมัติ</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('volunteer-hours.show', $hour) }}" class="btn btn-outline-info btn-sm" title="ดู">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($hour->status === 'pending')
                                        <a href="{{ route('volunteer-hours.edit', $hour) }}" class="btn btn-outline-warning btn-sm" title="แก้ไข">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('volunteer-hours.destroy', $hour) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="ลบ"
                                                onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-clock fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">ยังไม่มีข้อมูลชั่วโมงจิตอาสา</h4>
        <p class="text-muted mb-4">เริ่มบันทึกชั่วโมงจิตอาสาของคุณได้เลย</p>
        <a href="{{ route('volunteer-hours.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>เพิ่มชั่วโมงจิตอาสา
        </a>
    </div>
@endif
@endsection
