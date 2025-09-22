@extends('layouts.volunteer')

@section('title', 'แก้ไขชั่วโมงจิตอาสา')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit text-warning me-2"></i>แก้ไขชั่วโมงจิตอาสา
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('volunteer-hours.update', $volunteerHour) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="activity_name" class="form-label">ชื่อกิจกรรม <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('activity_name') is-invalid @enderror"
                               id="activity_name" name="activity_name"
                               value="{{ old('activity_name', $volunteerHour->activity_name) }}"
                               placeholder="เช่น ทำความสะอาดสวนสาธารณะ">
                        @error('activity_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4"
                                  placeholder="อธิบายรายละเอียดของกิจกรรมที่ทำ">{{ old('description', $volunteerHour->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hours" class="form-label">จำนวนชั่วโมง <span class="text-danger">*</span></label>
                                <input type="number" step="0.5" min="0.5" max="24"
                                       class="form-control @error('hours') is-invalid @enderror"
                                       id="hours" name="hours"
                                       value="{{ old('hours', $volunteerHour->hours) }}"
                                       placeholder="เช่น 2.5">
                                @error('hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">ใส่จำนวนชั่วโมงที่ทำกิจกรรม (ขั้นต่ำ 0.5 ชั่วโมง)</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">วันที่ทำกิจกรรม <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                       id="date" name="date"
                                       value="{{ old('date', $volunteerHour->date->format('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">เลือกวันที่ทำกิจกรรม (ไม่เกินวันปัจจุบัน)</div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>หมายเหตุ:</strong> คุณสามารถแก้ไขข้อมูลได้เฉพาะรายการที่อยู่ในสถานะ "รออนุมัติ" เท่านั้น
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('volunteer-hours.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>ย้อนกลับ
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>อัปเดตข้อมูล
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
