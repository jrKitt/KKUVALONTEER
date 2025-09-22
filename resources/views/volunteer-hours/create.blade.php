@extends("components/layouts/layoutAdmin")

@section('title', 'เพิ่มชั่วโมงจิตอาสา')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus text-primary me-2"></i>เพิ่มชั่วโมงจิตอาสา
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('volunteer-hours.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="activity_name" class="form-label">ชื่อกิจกรรม <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('activity_name') is-invalid @enderror"
                               id="activity_name" name="activity_name" value="{{ old('activity_name') }}"
                               placeholder="เช่น ทำความสะอาดสวนสาธารณะ">
                        @error('activity_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4"
                                  placeholder="อธิบายรายละเอียดของกิจกรรมที่ทำ">{{ old('description') }}</textarea>
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
                                       id="hours" name="hours" value="{{ old('hours') }}"
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
                                       id="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">เลือกวันที่ทำกิจกรรม (ไม่เกินวันปัจจุบัน)</div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>หมายเหตุ:</strong> ข้อมูลที่บันทึกจะอยู่ในสถานะ "รออนุมัติ" และจะต้องรอการอนุมัติจากเจ้าหน้าที่
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('volunteer-hours.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>ย้อนกลับ
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>บันทึกข้อมูล
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
