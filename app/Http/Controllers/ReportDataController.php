<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel\ExportReportDataView;
use App\Imports\ImportReportData;
use Illuminate\Http\Request;
use App\Models\Pekertian;
use App\Models\Magang;
use App\Models\Serkom;
use App\Models\User;
use App\Models\Unit;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ReportDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $unitfilter = $request->input('unit');
        $status = $request->input('status');
        $tgl = $request->input('tgl');
        $bulan3 = Carbon::now()->subMonths(3)->startOfDay();
        $tahun1 = Carbon::now()->subYear()->startOfDay();
        $tahun2 = Carbon::now()->subYear(2)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $magangQuery = Magang::select('magangs.id', 'users.nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
            ->join('users', 'magangs.user_id', '=', 'users.id');

        $pekertianQuery = Pekertian::select('pekertians.id', 'users.nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
            ->join('users', 'pekertians.user_id', '=', 'users.id');

        $serkomQuery = Serkom::select('serkoms.id', 'users.nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'serkoms.status_serkom  AS status')
            ->join('users', 'serkoms.user_id', '=', 'users.id');

        // Apply the main filter based on user input
        if ($filter === 'magang') {
            $result = $magangQuery;
            // Apply additional filters based on user input
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                $result = $result->where('users.unit', $unitfilter);
            }

            if (!empty($status)) {
                if ($status === 'Seumur Hidup') {
                    $result = $result->where('status_seumur_hidup', 1);
                } else {
                    if ($tgl === "3bulan") {
                        $result = $result->whereBetween('masa_berlaku', [$bulan3, $endDate]);
                    } else if ($tgl === "1tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun1, $endDate]);
                    } else if ($tgl === "2tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun2, $endDate]);
                    }
                    // $result = $result->where('masa_berlaku', $tgl);

                }
            }
        } elseif ($filter === 'pekertian') {
            $result = $pekertianQuery;
            // Apply additional filters based on user input
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                $result = $result->where('users.unit', $unitfilter);
            }

            if (!empty($status)) {
                if ($status === 'Seumur Hidup') {
                    $result = $result->where('status_seumur_hidup', 1);
                } else {
                    if ($tgl === "3bulan") {
                        $result = $result->whereBetween('masa_berlaku', [$bulan3, $endDate]);
                    } else if ($tgl === "1tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun1, $endDate]);
                    } else if ($tgl === "2tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun2, $endDate]);
                    }
                }
            }
        } elseif ($filter === 'serkom') {
            $result = $serkomQuery;
            // Apply additional filters based on user input
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                $result = $result->where('users.unit', $unitfilter);
            }

            if (!empty($status)) {
                if ($status === 'Seumur Hidup') {
                    $result = $result->where('status_seumur_hidup', 1);
                } else {
                    if ($tgl === "3bulan") {
                        $result = $result->whereBetween('masa_berlaku', [$bulan3, $endDate]);
                    } else if ($tgl === "1tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun1, $endDate]);
                    } else if ($tgl === "2tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun2, $endDate]);
                    }
                }
            }
        } else {
            //begini karena union cuma baca where di chain terakhir
            //jika filter unit
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                //jika filter status
                if (!empty($status)) {
                    //jika pilih seumur hidup
                    if ($status === 'Seumur Hidup') {
                        $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                            ->join('users', 'magangs.user_id', '=', 'users.id')
                            ->where('users.unit', $unitfilter)
                            ->where('status_seumur_hidup', 1) // Apply the where condition to the first query
                            ->union(
                                Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                    ->join('users', 'pekertians.user_id', '=', 'users.id')
                                    ->where('users.unit', $unitfilter)
                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the second query
                            )
                            ->union(
                                Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                    ->join('users', 'serkoms.user_id', '=', 'users.id')
                                    ->where('users.unit', $unitfilter)
                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the third query
                            );
                    }
                    //jika pilih tanggal
                    else {
                        if ($tgl === "3bulan") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter)
                                ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "1tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter)
                                ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "2tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter)
                                ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the third query
                                );
                        }
                    }
                }
                //jika filter unit tapi tidak filter status
                else {
                    $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                        ->join('users', 'magangs.user_id', '=', 'users.id')
                        ->where('users.unit', $unitfilter) // Apply the where condition to the first query
                        ->union(
                            Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                ->join('users', 'pekertians.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter) // Apply the where condition to the second query
                        )
                        ->union(
                            Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                ->join('users', 'serkoms.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter) // Apply the where condition to the third query
                        );
                }
            }
            //jika dia tidak filter unit 
            else {
                //jika dia tidak filter unit dan filter status
                if (!empty($status)) {
                    //jika pilih seumur hidup
                    if ($status === 'Seumur Hidup') {
                        $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                            ->join('users', 'magangs.user_id', '=', 'users.id')
                            ->where('status_seumur_hidup', 1) // Apply the where condition to the first query
                            ->union(
                                Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                    ->join('users', 'pekertians.user_id', '=', 'users.id')

                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the second query
                            )
                            ->union(
                                Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                    ->join('users', 'serkoms.user_id', '=', 'users.id')

                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the third query
                            );
                    }
                    //jika pilih tanggal
                    else {
                        if ($tgl === "3bulan") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "1tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "2tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the third query
                                );
                        }
                    }
                }
                //tidak unit tidak status
                else {
                    $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                        ->join('users', 'magangs.user_id', '=', 'users.id')
                        ->union(
                            Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                ->join('users', 'pekertians.user_id', '=', 'users.id')
                        )
                        ->union(
                            Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                ->join('users', 'serkoms.user_id', '=', 'users.id')
                        );
                }
            }
        }



        $result = $result->get();
        // dd($result);
        $unit = Unit::get();

        return view('reportdata.index', ['data' => $result, 'unit' => $unit]);
    }

    public function importReportData(Request $request)
    {
        function toDate($date)
        {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
        }
        $kategori = $request->kategori;
        $file = $request->file('file');
        $importData = Excel::toCollection(new ImportReportData, $file)[0];

        if ($kategori == 1) {

            foreach ($importData as $key => $value) {
                if ($key == 0) continue;



                $nip = $value[1];
                $topik = $value[2];
                $periode = $value[3];
                $skema = $value[4];
                $instansi = $value[5];
                $tanggalDaftar = $value[6];
                $tanggalPelaksanaan = $value[7];
                $tanggalPenerbitan = $value[8];
                $masaBerlaku = $value[9];
                $statusSeumurHidup = 0;

                $nip = User::where('nip', $nip)->get()[0]->id;

                if ($masaBerlaku == "Seumur Hidup") {
                    $masaBerlaku = null;
                    $statusSeumurHidup = 1;
                } else {
                    $masaBerlaku = toDate($masaBerlaku);
                    $statusSeumurHidup = 0;
                }


                $data = [
                    'topik_magang'  => $topik,
                    'skema_id'      => $skema,
                    'instansi_id'   => $instansi,
                    'periode_id'               => $periode,
                    'tgl_daftar'  => toDate($tanggalDaftar),
                    'tgl_pelaksanaan'  => toDate($tanggalPelaksanaan),
                    'tgl_penerbitan' => toDate($tanggalPenerbitan),
                    'status_magang' => 'Belum Disetujui',
                    'masa_berlaku'  => $masaBerlaku,
                    'status_seumur_hidup' => $statusSeumurHidup,
                    'user_id' =>  $nip
                ];

                Magang::create($data);
            }

            // dd($importData);
        } else if ($kategori == 2) {
            // dd($importData);
            foreach ($importData as $key => $value) {
                if ($key == 0) continue;

                $nip = $value[1];
                $nomorSertif = $value[2];
                $tanggalPelaksanaan = $value[3];
                $tanggalPenerbitan = $value[4];
                $masaBerlaku = $value[5];
                $statusSeumurHidup = 0;

                // dd($nip);
                $nip = User::where('nip', $nip)->get()[0]->id;

                if ($masaBerlaku == "Seumur Hidup") {
                    $masaBerlaku = null;
                    $statusSeumurHidup = 1;
                } else {
                    $masaBerlaku = toDate($masaBerlaku);
                    $statusSeumurHidup = 0;
                }
                $data = [
                    'nomor_sertifikat' => $nomorSertif,
                    'tgl_pelaksanaan'  => toDate($tanggalPelaksanaan),
                    'tgl_penerbitan' => toDate($tanggalPenerbitan),
                    'status_pekerti'   => 'Belum Disetujui',
                    'masa_berlaku'  => $masaBerlaku,
                    'status_seumur_hidup' => $statusSeumurHidup,
                    'user_id' =>  $nip,
                ];

                Pekertian::create($data);
            }
        } else {
            // dd($importData);
            foreach ($importData as $key => $value) {
                if ($key == 0) continue;

                $nip = $value[1];
                $namaSertif = $value[2];
                $skema = $value[3];
                $instansi = $value[4];
                $penyelenggara = $value[5];
                $tanggalPenerbitan = $value[6];
                $masaBerlaku = $value[7];
                $statusSeumurHidup = 0;

                // dd($nip);
                $nip = User::where('nip', $nip)->get()[0]->id;

                if ($masaBerlaku == "Seumur Hidup") {
                    $masaBerlaku = null;
                    $statusSeumurHidup = 1;
                } else {
                    $masaBerlaku = toDate($masaBerlaku);
                    $statusSeumurHidup = 0;
                }
                $data = [
                    'nama_sertifikasi'  => $namaSertif,
                    'skema_id'      => $skema,
                    'penyelenggara_id'   => $penyelenggara,
                    'tgl_penerbitan' => toDate($tanggalPenerbitan),
                    'masa_berlaku'  => $masaBerlaku,
                    'status_seumur_hidup' => $statusSeumurHidup,
                    'status_serkom' => 'Belum Disetujui',
                    'user_id' =>  $nip
                ];

                Serkom::create($data);
            }
        }
        return redirect()->back();
        // dd($request->file('file'));
    }

    public function exportReportData(Request $request)
    {
        $filter = $request->input('filter');
        $unitfilter = $request->input('unit');
        $status = $request->input('status');
        $tgl = $request->input('tgl');
        $bulan3 = Carbon::now()->subMonths(3)->startOfDay();
        $tahun1 = Carbon::now()->subYear()->startOfDay();
        $tahun2 = Carbon::now()->subYear(2)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $magangQuery = Magang::select('magangs.id', 'users.nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
            ->join('users', 'magangs.user_id', '=', 'users.id');

        $pekertianQuery = Pekertian::select('pekertians.id', 'users.nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
            ->join('users', 'pekertians.user_id', '=', 'users.id');

        $serkomQuery = Serkom::select('serkoms.id', 'users.nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'serkoms.status_serkom  AS status')
            ->join('users', 'serkoms.user_id', '=', 'users.id');

        // Apply the main filter based on user input
        if ($filter === 'magang') {
            $result = $magangQuery;
            // Apply additional filters based on user input
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                $result = $result->where('users.unit', $unitfilter);
            }

            if (!empty($status)) {
                if ($status === 'Seumur Hidup') {
                    $result = $result->where('status_seumur_hidup', 1);
                } else {
                    if ($tgl === "3bulan") {
                        $result = $result->whereBetween('masa_berlaku', [$bulan3, $endDate]);
                    } else if ($tgl === "1tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun1, $endDate]);
                    } else if ($tgl === "2tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun2, $endDate]);
                    }
                    // $result = $result->where('masa_berlaku', $tgl);

                }
            }
        } elseif ($filter === 'pekertian') {
            $result = $pekertianQuery;
            // Apply additional filters based on user input
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                $result = $result->where('users.unit', $unitfilter);
            }

            if (!empty($status)) {
                if ($status === 'Seumur Hidup') {
                    $result = $result->where('status_seumur_hidup', 1);
                } else {
                    if ($tgl === "3bulan") {
                        $result = $result->whereBetween('masa_berlaku', [$bulan3, $endDate]);
                    } else if ($tgl === "1tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun1, $endDate]);
                    } else if ($tgl === "2tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun2, $endDate]);
                    }
                }
            }
        } elseif ($filter === 'serkom') {
            $result = $serkomQuery;
            // Apply additional filters based on user input
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                $result = $result->where('users.unit', $unitfilter);
            }

            if (!empty($status)) {
                if ($status === 'Seumur Hidup') {
                    $result = $result->where('status_seumur_hidup', 1);
                } else {
                    if ($tgl === "3bulan") {
                        $result = $result->whereBetween('masa_berlaku', [$bulan3, $endDate]);
                    } else if ($tgl === "1tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun1, $endDate]);
                    } else if ($tgl === "2tahun") {
                        $result = $result->whereBetween('masa_berlaku', [$tahun2, $endDate]);
                    }
                }
            }
        } else {
            //begini karena union cuma baca where di chain terakhir
            //jika filter unit
            if (!empty($unitfilter) && $unitfilter !== 'all') {
                //jika filter status
                if (!empty($status)) {
                    //jika pilih seumur hidup
                    if ($status === 'Seumur Hidup') {
                        $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                            ->join('users', 'magangs.user_id', '=', 'users.id')
                            ->where('users.unit', $unitfilter)
                            ->where('status_seumur_hidup', 1) // Apply the where condition to the first query
                            ->union(
                                Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                    ->join('users', 'pekertians.user_id', '=', 'users.id')
                                    ->where('users.unit', $unitfilter)
                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the second query
                            )
                            ->union(
                                Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                    ->join('users', 'serkoms.user_id', '=', 'users.id')
                                    ->where('users.unit', $unitfilter)
                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the third query
                            );
                    }
                    //jika pilih tanggal
                    else {
                        if ($tgl === "3bulan") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter)
                                ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "1tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter)
                                ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "2tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter)
                                ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->where('users.unit', $unitfilter)
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the third query
                                );
                        }
                    }
                }
                //jika filter unit tapi tidak filter status
                else {
                    $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                        ->join('users', 'magangs.user_id', '=', 'users.id')
                        ->where('users.unit', $unitfilter) // Apply the where condition to the first query
                        ->union(
                            Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                ->join('users', 'pekertians.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter) // Apply the where condition to the second query
                        )
                        ->union(
                            Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                ->join('users', 'serkoms.user_id', '=', 'users.id')
                                ->where('users.unit', $unitfilter) // Apply the where condition to the third query
                        );
                }
            }
            //jika dia tidak filter unit 
            else {
                //jika dia tidak filter unit dan filter status
                if (!empty($status)) {
                    //jika pilih seumur hidup
                    if ($status === 'Seumur Hidup') {
                        $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                            ->join('users', 'magangs.user_id', '=', 'users.id')
                            ->where('status_seumur_hidup', 1) // Apply the where condition to the first query
                            ->union(
                                Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                    ->join('users', 'pekertians.user_id', '=', 'users.id')

                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the second query
                            )
                            ->union(
                                Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                    ->join('users', 'serkoms.user_id', '=', 'users.id')

                                    ->where('status_seumur_hidup', 1) // Apply the where condition to the third query
                            );
                    }
                    //jika pilih tanggal
                    else {
                        if ($tgl === "3bulan") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$bulan3, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "1tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun1, $endDate]) // Apply the where condition to the third query
                                );
                        } else if ($tgl === "2tahun") {
                            $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                                ->join('users', 'magangs.user_id', '=', 'users.id')
                                ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the first query
                                ->union(
                                    Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                        ->join('users', 'pekertians.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the second query
                                )
                                ->union(
                                    Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                        ->join('users', 'serkoms.user_id', '=', 'users.id')
                                        ->whereBetween('masa_berlaku', [$tahun2, $endDate]) // Apply the where condition to the third query
                                );
                        }
                    }
                }
                //tidak unit tidak status
                else {
                    $result = Magang::select('magangs.id', 'topik_magang AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'magangs.status_magang AS status')
                        ->join('users', 'magangs.user_id', '=', 'users.id')
                        ->union(
                            Pekertian::select('pekertians.id', 'nomor_sertifikat AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit', 'pekertians.status_pekerti  AS status')
                                ->join('users', 'pekertians.user_id', '=', 'users.id')
                        )
                        ->union(
                            Serkom::select('serkoms.id', 'nama_sertifikasi AS nama', 'masa_berlaku', 'status_seumur_hidup', 'users.unit',  'serkoms.status_serkom  AS status')
                                ->join('users', 'serkoms.user_id', '=', 'users.id')
                        );
                }
            }
        }

        $result = $result->get();

        return Excel::download(new ExportReportDataView($result), "Report Data.xlsx");
    }
}
