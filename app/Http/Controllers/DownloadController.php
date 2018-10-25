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
        $data = DownloadController::get_data_from_ftp();

        return view('downloads.index');
    }

    public function get_data_from_ftp()
    {
        $ftp_server = "ftp.zakupki.gov.ru";
        $username = "free";
        $password = "free";
        $connect = ftp_connect($ftp_server);

        $login_to_ftp = ftp_login($connect, $username, $password);
        ftp_pasv($connect, true);
        $move_to_dir = ftp_chdir($connect, "/fcs_regions/Tatarstan_Resp/notifications/currMonth");

        if ($login_to_ftp && $move_to_dir) {
            $folder_file_lists = ftp_nlist($connect, '.');
        }

        $locale_file = "/home/vagrant/Downloads/notification_Tatarstan_Resp_2018102300_2018102400_001.xml.zip";
        $ftp_file = "notification_Tatarstan_Resp_2018102300_2018102400_001.xml.zip";

        if (ftp_get($connect, $locale_file, $ftp_file, FTP_BINARY, 0)) {
            $zip = new ZipArchive;
            $open_zip = $zip->open("/home/vagrant/Downloads/notification_Tatarstan_Resp_2018102300_2018102400_001.xml.zip");
            $extract_xml_array = [];

            if ($open_zip == true) {
                for ($i=0; $i < $zip->numFiles; $i++) {
                    $flag_type = $zip->getNameIndex($i);
                    if (fnmatch("*.xml", $flag_type)) {
                        array_push($extract_xml_array, $flag_type);
                    }
                }

                $zip->extractTo("/home/vagrant/Downloads/extract", $extract_xml_array);
            }
            $zip->close();
        }
        ftp_close($connect);

        $extract_files = scandir("/home/vagrant/Downloads/extract");

        for ($i=2; $i < sizeof($extract_files); $i++) {
            DownloadController::parse_tender_from_xml($extract_files[$i]);
        }

        // DownloadController::parse_tender_from_xml($extract_files[12]);
    }

    private function parse_tender_from_xml($xml_filename)
    {
        $path = "/home/vagrant/Downloads/extract/$xml_filename";
        $string_file_xml = file_get_contents($path);
        $string_file_xml = preg_replace('/<ns2:.* schemeVersion="\d+.\d+">/', "<tender>", $string_file_xml);
        $string_file_xml = preg_replace('/<\/ns.*Notification.*>/', "</tender>", $string_file_xml);
        $string_file_xml = preg_replace('/ns\d+:/', "", $string_file_xml);
        $n_xml = simplexml_load_string($string_file_xml);
        $json = json_encode($n_xml);
        $n_array = json_decode($json,TRUE);

        if (strpos($xml_filename, "EA44") != false) {
            DownloadController::eap44_tender($n_array);
        }elseif (strpos($xml_filename, "EP44") != false) {
            DownloadController::epp44_tender($n_array);
        }elseif (strpos($xml_filename, "OK44") != false) {
            DownloadController::okp44_tender($n_array);
        }elseif (strpos($xml_filename, "ZK44") != false) {
            DownloadController::zkp44_tender($n_array);
        }
    }

    private function eap44_tender($n_array)
    {
        $ensuring_order = "";
        $ensuring_contract = "";
        $address = "";

        if (array_key_exists('applicationGuarantee', $n_array)) {
            $ensuring_order = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['applicationGuarantee']['amount'];
        }
        if (array_key_exists('contractGuarantee', $n_array)) {
            $ensuring_contract = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['contractGuarantee']['amount'];
        }

        DownloadController::create_tender_with_params(
            $n_array['tender']['id'],
            $n_array['tender']['purchaseNumber'],
            $n_array['tender']['purchaseObjectInfo'],
            $n_array['tender']['placingWay']['code'],
            $n_array['tender']['placingWay']['name'],
            $n_array['tender']['lot']['maxPrice'],
            $ensuring_order,
            $ensuring_contract,
            $n_array['tender']['purchaseResponsible']['responsibleInfo']['orgFactAddress'],
            $n_array['tender']['procedureInfo']['collecting']['startDate'],
            $n_array['tender']['procedureInfo']['collecting']['endDate']
        );
    }

    private function epp44_tender($n_array)
    {
        $ensuring_order = "";
        $ensuring_contract = "";
        $address = "";

        if (array_key_exists('applicationGuarantee', $n_array)) {
            $ensuring_order = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['applicationGuarantee']['amount'];
        }
        if (array_key_exists('contractGuarantee', $n_array)) {
            $ensuring_contract = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['contractGuarantee']['amount'];
        }

        DownloadController::create_tender_with_params(
            $n_array['tender']['id'],
            $n_array['tender']['purchaseNumber'],
            $n_array['tender']['purchaseObjectInfo'],
            $n_array['tender']['placingWay']['code'],
            $n_array['tender']['placingWay']['name'],
            $n_array['tender']['lot']['maxPrice'],
            $ensuring_order,
            $ensuring_contract,
            $n_array['tender']['purchaseResponsible']['responsibleInfo']['orgFactAddress'],
            $n_array['tender']['docPublishDate'],
            ""
        );
    }

    private function okp44_tender($n_array)
    {
        $ensuring_order = "";
        $ensuring_contract = "";
        $address = "";

        if (array_key_exists('applicationGuarantee', $n_array)) {
            $ensuring_order = $n_array['tender']['lots']['lot']['customerRequirements']['customerRequirement']['applicationGuarantee']['amount'];
        }
        if (array_key_exists('contractGuarantee', $n_array)) {
            $ensuring_contract = $n_array['tender']['lots']['lot']['customerRequirements']['customerRequirement']['contractGuarantee']['amount'];
        }

        DownloadController::create_tender_with_params(
            $n_array['tender']['id'],
            $n_array['tender']['purchaseNumber'],
            $n_array['tender']['purchaseObjectInfo'],
            $n_array['tender']['placingWay']['code'],
            $n_array['tender']['placingWay']['name'],
            $n_array['tender']['lots']['lot']['maxPrice'],
            $ensuring_order,
            $ensuring_contract,
            $n_array['tender']['purchaseResponsible']['responsibleInfo']['orgFactAddress'],
            $n_array['tender']['procedureInfo']['collecting']['startDate'],
            $n_array['tender']['procedureInfo']['collecting']['endDate']
        );
    }

    private function zkp44_tender($n_array)
    {
        $ensuring_order = "";
        $ensuring_contract = "";
        $address = "";

        if (array_key_exists('applicationGuarantee', $n_array)) {
            $ensuring_order = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['applicationGuarantee']['amount'];
        }
        if (array_key_exists('contractGuarantee', $n_array)) {
            $ensuring_contract = $n_array['tender']['lot']['customerRequirements']['customerRequirement']['contractGuarantee']['amount'];
        }

        DownloadController::create_tender_with_params(
            $n_array['tender']['id'],
            $n_array['tender']['purchaseNumber'],
            $n_array['tender']['purchaseObjectInfo'],
            $n_array['tender']['placingWay']['code'],
            $n_array['tender']['placingWay']['name'],
            $n_array['tender']['lot']['maxPrice'],
            $ensuring_order,
            $ensuring_contract,
            $n_array['tender']['purchaseResponsible']['responsibleInfo']['orgFactAddress'],
            $n_array['tender']['procedureInfo']['collecting']['startDate'],
            $n_array['tender']['procedureInfo']['collecting']['endDate']
        );
    }

    private function create_tender_with_params($notification_xml_id,$purchase_number,$purchase_object_info,$placing_way_code,$placing_way_name,$lot_max_price,$ensuring_order,$ensuring_contract,$address,$start_date,$end_date)
    {
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
