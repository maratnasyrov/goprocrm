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
        $unzip_files = DownloadController::unzip($data['url'], $data['path'], $data['file_list_001']);
        for ($i=2; $i < sizeof($unzip_files); $i++) {
            DownloadController::parse_tender_from_xml($unzip_files[$i]);
        }

        return view('downloads.index');
    }

    public function get_data_from_ftp()
    {
        $ftp = Storage::disk('ftp');
        $region = "Tatarstan_Resp";
        $target = "notifications";
        $month = "currMonth";
        $all_path = "fcs_regions/$region/$target/$month";
        $ftp_file_lists = $ftp->allFiles($all_path);
        $ftp_file_lists_001 = [];
        $locale_file = Storage::disk('public');
        $url = $locale_file->getDriver()->getAdapter()->getPathPrefix();

        foreach ($ftp_file_lists as $name) {
            if (fnmatch("$all_path/notification_*_001.xml.zip", $name)) {
                $locale_file->put($name, $ftp->get($name));
                array_push($ftp_file_lists_001, str_replace("$all_path/", '', $name));
            }
        }
        $ftp->getDriver()->getAdapter()->disconnect();

        return ['url' => $url, 'path' => $all_path, 'file_list_001' => $ftp_file_lists_001];
    }

    private function unzip($url, $all_path, $ftp_file_lists_001)
    {
        for ($i=1; $i < sizeof($ftp_file_lists_001); $i++) {
            $zip = new ZipArchive;
            $open_zip = $zip->open("$url$all_path/$ftp_file_lists_001[$i]");
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
        $extract_files = scandir("/home/vagrant/Downloads/extract");

        return $extract_files;
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
            "name" => mb_strimwidth($purchase_object_info, 0, 497, "..."),
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
