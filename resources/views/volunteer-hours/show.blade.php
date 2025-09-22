@extends("../components/layouts/layoutAdmin.blade.php")

@section('title', 'รายละเอียดชั่วโมงจิตอาสา')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-eye text-info me-2"></i>รายละเอียดชั่วโมงจิตอาสา
                    </h5>
                    <div>
                        @switch($volunteerHour->status)
                            @case('approved')
                                <span class="badge bg-success fs-6">อนุมัติแล้ว</span>
                                @break
                            @case('rejected')
                                <span class="badge bg-danger fs-6">ไม่อนุมัติ</span>
                                @break
                            @default
                                <span class="badge bg-warning fs-6">รออนุมัติ</span>
                        @endswitch
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">ชื่อกิจกรรม</label>
                            <p class="fs-5">{{ $volunteerHour->activity_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">วันที่ทำกิจกรรม</label>
                            <p class="fs-5">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                {{ $volunteerHour->date->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-muted">รายละเอียดกิจกรรม</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            @if($volunteerHour->description)
                                <p class="mb-0">{{ $volunteerHour->description }}</p>
                            @else
                                <p class="text-muted mb-0 fst-italic">ไม่มีรายละเอียด</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">จำนวนชั่วโมง</label>
                            <p class="fs-4">
                                <span class="badge bg-info text-dark fs-6 px-3 py-2">
                                    <i class="fas fa-clock me-2"></i>{{ $volunteerHour->hours }} ชั่วโมง
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">วันที่บันทึก</label>
                            <p class="fs-6 text-muted">
                                <i class="fas fa-clock me-2"></i>
                                {{ $volunteerHour->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                @if($volunteerHour->updated_at != $volunteerHour->created_at)
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted">วันที่แก้ไขล่าสุด</label>
                        <p class="fs-6 text-muted">
                            <i class="fas fa-edit me-2"></i>
                            {{ $volunteerHour->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                @endif

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('volunteer-hours.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>ย้อนกลับ
                    </a>

                    @if($volunteerHour->status === 'pending')
                        <div>
                            <a href="{{ route('volunteer-hours.edit', $volunteerHour) }}" class="btn btn-warning me-2">
                                <i class="fas fa-edit me-1"></i>แก้ไข
                            </a>
                            <form method="POST" action="{{ route('volunteer-hours.destroy', $volunteerHour) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                    <i class="fas fa-trash me-1"></i>ลบ
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
