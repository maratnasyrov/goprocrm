<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tender;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use SimpleXMLElement;
use App\Http\Controllers\DownloadController;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('downloads.index', [
            'data' => DownloadController::get_data_from_ftp()
        ]);
    }

    public function get_data_from_ftp()
    {
        // $ftp_server = "ftp.zakupki.gov.ru";
        // $username = "free";
        // $password = "free";
        // $connect = ftp_connect($ftp_server);
        //
        // $login_to_ftp = ftp_login($connect, $username, $password);
        // ftp_pasv($connect, true);
        // $move_to_dir = ftp_chdir($connect, "/fcs_regions/Tatarstan_Resp/notifications/currMonth");

        // if ($login_to_ftp && $move_to_dir) {
        //     $folder_file_lists = ftp_nlist($connect, '.');
        //
        //
        //     return $folder_file_lists;
        // }

        // $locale_file = "/home/vagrant/Downloads/notification_Tatarstan_Resp_2018100400_2018100500_001.xml.zip";
        // $ftp_file = "notification_Tatarstan_Resp_2018100400_2018100500_001.xml.zip";
        //
        // if (ftp_get($connect, $locale_file, $ftp_file, FTP_BINARY, 0)) {
        //     $zip = new ZipArchive;
        //     $open_zip = $zip->open("/home/vagrant/Downloads/notification_Tatarstan_Resp_2018100400_2018100500_001.xml.zip");
        //     $extract_xml_array = [];
        //
        //     if ($open_zip == true) {
        //         for ($i=0; $i < $zip->numFiles; $i++) {
        //             $flag_type = $zip->getNameIndex($i);
        //             if (fnmatch("*.xml", $flag_type)) {
        //                 array_push($extract_xml_array, $flag_type);
        //             }
        //         }
        //
        //         $zip->extractTo("/home/vagrant/Downloads/extract", $extract_xml_array);
        //     }
        //     $zip->close();
        // }
        // ftp_close($connect);

        $extract_files = scandir("/home/vagrant/Downloads/extract");

        for ($i=2; $i < sizeof($extract_files); $i++) {
            DownloadController::create_tender_from_xml($extract_files[$i]);
        }

        // DownloadController::create_tender_from_xml($extract_files[2]);
    }

    private function create_tender_from_xml($xml_filename)
    {
        $path = "/home/vagrant/Downloads/extract/$xml_filename";
        $string_file_xml = file_get_contents($path);

        $string_file_xml = preg_replace('/<ns2:fcsNotificationEF schemeVersion="\d+.\d+">/', "<tender>", $string_file_xml);
        $string_file_xml = str_replace('</ns2:fcsNotificationEF>', "</tender>", $string_file_xml);
        $n_xml = simplexml_load_string($string_file_xml);

        $json = json_encode($n_xml);
        $n_array = json_decode($json,TRUE);

        $notification_xml_id = $n_array['tender']['id'];
        $purchase_number = $n_array['tender']['purchaseNumber'];
        $purchase_object_info = $n_array['tender']['purchaseObjectInfo'];
        $placing_way_code = $n_array['tender']['placingWay']['code'];
        $placing_way_name = $n_array['tender']['placingWay']['name'];
        $lot_max_price = $n_array['tender']['lot']['maxPrice'];
        $ensuring_order = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['applicationGuarantee']['amount'];
        $ensuring_contract = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['contractGuarantee']['amount'];
        $address = $n_array['tender']['procedureInfo']['collecting']['place'];
        $start_date = $n_array['tender']['procedureInfo']['collecting']['startDate'];
        $end_date = $n_array['tender']['procedureInfo']['collecting']['endDate'];

        $tender_params = [
            "notification_xml_id" => $notification_xml_id,
            "number" => $purchase_number,
            "name" => $purchase_object_info,
            "placing_way_code" => $placing_way_code,
            "placing_way_name" => $placing_way_name,
            "contract_price" => $lot_max_price,
            "ensuring_order" => $ensuring_order,
            "ensuring_contract" => $ensuring_contract,
            "address" => $address,
            "start_time" => $start_date,
            "end_time" => $end_date
        ];
        $tender = Tender::create($tender_params);
    }

}
