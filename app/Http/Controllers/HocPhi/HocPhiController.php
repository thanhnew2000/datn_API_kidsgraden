<?php

namespace App\Http\Controllers\HocPhi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DanhSachThuTienRepository;
use App\Repositories\QuanLyThangThuTienRepository;
use App\Repositories\HocSinhRepository;
use App\Repositories\ChinhSachCuaHocSinhRepository;
use Illuminate\Support\Facades\DB;
class HocPhiController extends Controller
{
    protected $DanhSachThuTienRepository;
    protected $QuanLyThangThuTienRepository;
    protected $ChinhSachCuaHocSinhRepository;
    public function __construct(
        DanhSachThuTienRepository $DanhSachThuTienRepository,
        QuanLyThangThuTienRepository $QuanLyThangThuTienRepository,
        ChinhSachCuaHocSinhRepository $ChinhSachCuaHocSinhRepository,
        HocSinhRepository $HocSinhRepository
    )
    {
        $this->DanhSachThuTienRepository = $DanhSachThuTienRepository;
        $this->QuanLyThangThuTienRepository = $QuanLyThangThuTienRepository;
        $this->ChinhSachCuaHocSinhRepository = $ChinhSachCuaHocSinhRepository;
        $this->HocSinhRepository = $HocSinhRepository;
    }
    // public function getThangIdNamHocOfHs($id){
    //     $id_thang_thu_tien = $this->DanhSachThuTienRepository->get_id_thang_thu_tien($id);
    //     $id_thang_thu_tien->each(function ($item){
    //         $item->ThangThuTien;
    //         $item->ThangThuTien->NamHoc;
    //     });
    //     return $id_thang_thu_tien;
    // }

    public function getNamThangOfHocPhiHs($id){
        $arr_object_thang_thu_tien = $this->DanhSachThuTienRepository->get_arr_id_thang_thu_tien($id);
        // return $arr_object_thang_thu_tien;
        $arr_id_thang_thu_tien = [];
        foreach($arr_object_thang_thu_tien as $object){
            array_push($arr_id_thang_thu_tien,$object->id_thang_thu_tien);
        }
        $arr_nam_groupby =  $this->QuanLyThangThuTienRepository->get_nam_from_arr_thang_thu($arr_id_thang_thu_tien);
        $arr_thang_thu =  $this->QuanLyThangThuTienRepository->get_thang_thu_from_arr_thang_thu($arr_id_thang_thu_tien);

        // tinh xem da hoan thanh hoc phi cua thang hay chua
        $DanhSachThuTienCuaHs =  $this->DanhSachThuTienRepository->getDanhSachByArrIdThangThu($arr_id_thang_thu_tien,$id);

        $arr_trang_thai_dong_hoc = [];
        $tong_tien_id_thang = [];

        foreach($DanhSachThuTienCuaHs as $dstt){
            $count_id_thang = 0;
            $so_lan_da_dong = 0;
            $tong_tien_thang = 0;

            foreach($arr_id_thang_thu_tien as $id_thang_thu){
                if($dstt->id_thang_thu_tien == $id_thang_thu){
                    $tong_tien_thang = $tong_tien_thang + $dstt->so_tien_phai_dong;
                    $count_id_thang++;
                    if($dstt->trang_thai == 1){
                       $so_lan_da_dong++;
                    }
                }
            }
            $tong_tien_id_thang[$dstt->id_thang_thu_tien] = $tong_tien_thang;

            if($count_id_thang == $so_lan_da_dong){
                // 'Đã hoàn thành' -> 2;
                $arr_trang_thai_dong_hoc[$dstt->id_thang_thu_tien] = 2;
            }else if($so_lan_da_dong == 0){
                $arr_trang_thai_dong_hoc[$dstt->id_thang_thu_tien] = 0;
                // 'Chưa đóng' -> 0;
            }else if($so_lan_da_dong < $count_id_thang){
                // Chưa hoàn thành '-> 1 ( tức là đóng thiếu);
                $arr_trang_thai_dong_hoc[$dstt->id_thang_thu_tien] = 1;
            }
        }
        // ket thuc

    //    return $arr_trang_thai_dong_hoc;


        $arr_nam_groupby->each(function ($item){
            $item->NamHoc;
        });
        // return $arr_nam_groupby;

        $arr_data=[];
        foreach($arr_nam_groupby as $nam){
            $only_nam = [];
            foreach($arr_thang_thu as $data){
                if($nam->id_nam_hoc == $data->id_nam_hoc){
                        $data->trang_thai = $arr_trang_thai_dong_hoc[$data->id];
                        $data->tong_tien_phai_dong = number_format($tong_tien_id_thang[$data->id]);
                      array_push($only_nam,$data);
                  }
            }
             $arr_data[$nam->NamHoc->name]=$only_nam;
        }
        return $arr_data;
      
    }




    public function getAllDanhSachThuTienFromIdThangThuHs($id_thang_thu_tien,$id_hs){
        // di vào đợt
        $danh_sach_thu_tien_of = $this->DanhSachThuTienRepository->getDanhSachThuTienOfHs($id_thang_thu_tien,$id_hs);
        $danh_sach_thu_tien_of->each(function ($item){
            $item->ChiTietDotThu;
        });
        return $danh_sach_thu_tien_of;
        //  danh sach đã có chi tiết đợt thu 
        // id chi tiet dot thu -> danh sach thu tien 
    }


    public function mienGiam($id){
        return $this->ChinhSachCuaHocSinhRepository->maxMienGiam($id);
    }

    //  đã show màn hình đợt h thì click chi tiết đợt
    public function getChiTietDot($id_chi_tiet_dot,$id_hs){
        //  lấy cái id danh sách thu tiền ( chỉ có 1 )
        // $hoc_sinh = $this->HocSinhRepository->find($id_hs);
        $OneDanhSachThuTien = $this->DanhSachThuTienRepository->getOneDanhSachThuTienByIdChiTietDot($id_chi_tiet_dot,$id_hs);
        $OneDanhSachThuTien->ChiTietDongTienHocSinh;

        $hoc_sinh = $this->HocSinhRepository->find($id_hs);
        $phan_tram_giam_hoc_phi = 0;

        $khoan_thu_co_phi = [];

        
        if($hoc_sinh->doi_tuong_chinh_sach == 1){
            $phan_tram_giam_hoc_phi =   $this->ChinhSachCuaHocSinhRepository->maxMienGiam($id_hs);
        }

        $arr_mien_giam = [];
        foreach ($OneDanhSachThuTien->ChiTietDongTienHocSinh as $key => $item) {
            $item->KhoanThu;
            if($item->phan_tram_mien_giam !== null){
                array_push($arr_mien_giam,$item);
            }
        }

        $OneDanhSachThuTien->arr_mien_giam = $arr_mien_giam ;
        
        // foreach ($OneDanhSachThuTien->ChiTietDongTienHocSinh as $key => $item) {
        //     $item->KhoanThu;
        //         if($hoc_sinh->doi_tuong_chinh_sach == 1){
        //                 if($item->KhoanThu->mien_giam !== 0){
        //                         $khoan_thu = $item->KhoanThu;
        //                         // $khoan_thu->so_tien = $item->so_tien;
        //                         $khoan_thu->phan_tram = 100 - ((int)$item->so_tien / (int)$khoan_thu->muc_thu)*100;
        //                         // $tong_phan_tram = 100 - ((int)$khoan_thu->so_tien / (int)$khoan_thu->muc_thu)*100;
        //                         array_push($khoan_thu_co_phi,$khoan_thu);
        //                 }

        //                 if( $item->KhoanThu->mac_dinh == 2){
        //                     $giam_tien =  $item->KhoanThu;
        //                     $giam_tien->phan_tram = $phan_tram_giam_hoc_phi;
        //                     array_push($khoan_thu_co_phi,$giam_tien);   
        //                 }
        //         }
        // }

        return $OneDanhSachThuTien;

    }


}
