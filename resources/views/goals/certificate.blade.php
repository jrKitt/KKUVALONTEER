<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>บันทึกการเข้าร่วมโครงการ/กิจกรรม</title>
        <style>
            @page {
                size: A4;
                margin: 15mm;
            }

            body {
                font-family: 'TH Sarabun New', 'Sarabun', sans-serif;
                margin: 0;
                padding: 0;
                background: white;
                font-size: 14px;
                line-height: 1.2;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .logos {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 50px;
                margin-bottom: 20px;
            }

            .logo,
            .logo-ava {
                width: 100px;
                height: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            .logo img,
            .logo-ava img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }

            .logo.fallback::before {
                content: 'มหาวิทยาลัยขอนแก่น';
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                background: #8b0000;
                color: white;
                border-radius: 10px;
                font-size: 10px;
                text-align: center;
                line-height: 1.2;
                padding: 5px;
                position: absolute;
                top: 0;
                left: 0;
            }

            .logo-ava.fallback::before {
                content: 'กยศ.';
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                background: #ff6b6b;
                color: white;
                border-radius: 10px;
                font-size: 16px;
                text-align: center;
                font-weight: bold;
                position: absolute;
                top: 0;
                left: 0;
            }

            .title {
                font-size: 16px;
                font-weight: bold;
                margin: 10px 0;
            }

            .form-info {
                text-align: left;
                margin: 20px 0;
                font-size: 14px;
            }

            .form-info span {
                display: inline-block;
                margin-right: 20px;
            }

            .underline {
                border-bottom: 1px dotted #000;
                display: inline-block;
                min-width: 100px;
                margin-left: 5px;
                margin-right: 5px;
            }

            .table-container {
                margin: 20px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border: 2px solid #000;
                font-size: 12px;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
                vertical-align: middle;
            }

            th {
                background-color: #f5f5f5;
                font-weight: bold;
            }

            .col-no {
                width: 8%;
            }

            .col-activity {
                width: 20%;
            }

            .col-location {
                width: 15%;
            }

            .col-date {
                width: 12%;
            }

            .col-hours {
                width: 10%;
            }

            .col-type {
                width: 15%;
            }

            .col-signature {
                width: 20%;
            }

            .signature-cell {
                height: 80px;
                position: relative;
            }

            .signature-lines {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 10px;
                line-height: 1.2;
            }

            .signature-line {
                border-bottom: 1px dotted #000;
                width: 120px;
                height: 12px;
                margin-bottom: 2px;
            }

            .footer-note {
                margin-top: 10px;
                font-size: 10px;
                text-align: right;
            }

            .data-row {
                height: 60px;
            }

            @media print {
                body {
                    font-size: 12px;
                }

                .no-print {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logos">
                <div class="logo">
                    <img
                        src="https://img2.pic.in.th/pic/LogoKKUthai_150px1f7f57a18880823f.png"
                        alt="มหาวิทยาลัยขอนแก่น"
                        onerror="this.style.display='none'; this.parentNode.classList.add('fallback');"
                    />
                </div>
                <div class="logo-ava">
                    <img
                        src="https://img2.pic.in.th/pic/-01238e8da8f8e982c9.png"
                        alt="กยศ."
                        onerror="this.style.display='none'; this.parentNode.classList.add('fallback');"
                    />
                </div>
            </div>

            <div class="title">
                บันทึก การเข้าร่วมโครงการ/กิจกรรม
                ที่ทำประโยชน์ต่อสังคมหรือสาธารณะ ภาคเรียนที่
                <span class="underline">{{ date("n") <= 6 ? "2" : "1" }}</span>
                ปีการศึกษา
                <span class="underline">
                    {{ date("n") <= 6 ? date("Y") : date("Y") + 1 }}
                </span>
            </div>
        </div>

        <div class="form-info">
            <span>
                ชื่อ
                <span class="underline" style="min-width: 200px">
                    {{ $user->name }}
                </span>
            </span>
            <span>
                คณะ
                <span class="underline" style="min-width: 150px">
                    {{ $user->faculty ?? "ไม่ระบุ" }}
                </span>
            </span>
            <span>
                รหัสนักศึกษา
                <span class="underline" style="min-width: 100px">
                    {{ $user->student_id ?? "ไม่ระบุ" }}
                </span>
            </span>
            <span>
                ชั้นปี
                <span class="underline" style="min-width: 50px">
                    {{ $user->year ?? "" }}
                </span>
            </span>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" class="col-no">ลำดับ</th>
                        <th rowspan="2" class="col-activity">
                            ชื่อโครงการ/
                            <br />
                            กิจกรรม
                        </th>
                        <th rowspan="2" class="col-location">
                            สถานที่
                            <br />
                            ดำเนินโครงการ/กิจกรรม
                        </th>
                        <th rowspan="2" class="col-date">วัน/เดือน/ปี</th>
                        <th rowspan="2" class="col-hours">เวลา</th>
                        <th rowspan="2" class="col-type">
                            ลักษณะของกิจกรรม
                            <br />
                            (โดยเฉพาะมากที่สุด)
                        </th>
                        <th class="col-signature">
                            ลายมือชื่อผู้รับรอง
                            <br />
                            (หัวหน้าหน่วยงานที่รับรองได้)
                            <br />
                            ผู้ที่มีตำแหน่งตั้งแต่ตำแหน่ง
                        </th>
                    </tr>
                    <tr>
                        <th class="col-signature">
                            ลายชื่อ..........................................................
                            <br />
                            (ชื่อ-สกุล)....................................................
                            <br />
                            ตำแหน่ง.......................................................
                            <br />
                            หน่วยงาน.....................................................
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Get user's activities within the goal period
                        $activities = \DB::table("activity_participants")
                            ->join("activities", "activity_participants.activity_id", "=", "activities.id")
                            ->where("activity_participants.user_id", $user->id)
                            ->where("activity_participants.checked_in", true)
                            ->whereDate("activities.start_time", ">=", $goal->start_date)
                            ->whereDate("activities.start_time", "<=", $goal->end_date)
                            ->select(
                                "activities.name_th",
                                "activities.location",
                                "activities.start_time",
                                "activities.total_hour",
                                "activities.tags",
                                "activity_participants.actual_hours",
                            )
                            ->orderBy("activities.start_time", "asc")
                            ->get();

                        $counter = 1;
                    @endphp

                    @foreach ($activities as $activity)
                        <tr class="data-row">
                            <td>{{ $counter++ }}</td>
                            <td style="text-align: left; padding: 5px">
                                {{ $activity->name_th }}
                            </td>
                            <td style="text-align: left; padding: 5px">
                                {{ $activity->location ?? "ไม่ระบุ" }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($activity->start_time)->format("d/m/Y") }}
                            </td>
                            <td>
                                {{ $activity->actual_hours ?? $activity->total_hour }}
                                ชม.
                            </td>
                            <td style="text-align: left; padding: 5px">
                                @if ($activity->tags)
                                    @php
                                        $tags = is_string($activity->tags) ? json_decode($activity->tags, true) : $activity->tags;
                                        if (is_array($tags) && ! empty($tags)) {
                                            echo implode(", ", array_slice($tags, 0, 2));
                                        } else {
                                            echo $goal->category ?? "กิจกรรมอาสาสมัคร";
                                        }
                                    @endphp
                                @else
                                    {{ $goal->category ?? "กิจกรรมอาสาสมัคร" }}
                                @endif
                            </td>
                            <td class="signature-cell">
                                <div class="signature-lines">
                                    <div>
                                        ลายชื่อ.....................................................
                                    </div>
                                    <div class="signature-line"></div>
                                    <div>
                                        (ชื่อ-สกุล).................................................
                                    </div>
                                    <div class="signature-line"></div>
                                    <div>
                                        ตำแหน่ง.....................................................
                                    </div>
                                    <div class="signature-line"></div>
                                    <div>
                                        หน่วยงาน.................................................
                                    </div>
                                    <div class="signature-line"></div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @for ($i = $activities->count(); $i < 4; $i++)
                        <tr class="data-row">
                            <td>{{ $i + 1 }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="signature-cell">
                                <div class="signature-lines">
                                    <div>
                                        ลายชื่อ.....................................................
                                    </div>
                                    <div class="signature-line"></div>
                                    <div>
                                        (ชื่อ-สกุล).................................................
                                    </div>
                                    <div class="signature-line"></div>
                                    <div>
                                        ตำแหน่ง.....................................................
                                    </div>
                                    <div class="signature-line"></div>
                                    <div>
                                        หน่วยงาน.................................................
                                    </div>
                                    <div class="signature-line"></div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="footer-note">
            หมายเหตุ : ผู้บันทึกต้องให้หัวหน้า อาจารย์
            หรือหัวหน้าที่เกี่ยวข้องลงนาม
        </div>

        <script>
            // Auto print when page loads
            window.onload = function () {
                setTimeout(() => {
                    window.print();
                }, 500);
            };
        </script>
    </body>
</html>
