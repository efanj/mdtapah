<?php

class Printing extends Model
{
  public function checkSiriNo($data)
  {
    if ($data == null || $data == "") {
      return "-";
    } else {
      return Encryption::encryptId($data);
    }
  }

  public function checkNull($data)
  {
    if ($data == null || $data == "") {
      return "-";
    } else {
      return $data;
    }
  }

  public function checkCalcNull($data)
  {
    if ($data == null || $data == "") {
      return "Tiada";
    } else {
      return "Ada";
    }
  }

  public function checkAttachNull($data)
  {
    if ($data == null || $data == "") {
      return "Tiada (0)";
    } else {
      return "Ada (" . $data . ")";
    }
  }

  public function checkNullNumber($data)
  {
    if ($data == null || $data == "") {
      return 0;
    } else {
      return $data;
    }
  }

  public function datesubmition($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT * FROM data.submission ";
    $query .= "WHERE id = :id ";

    $database->prepare($query);
    $database->bindValue(":id", Encryption::decryptId($fileId));
    $database->execute();
    $date = $database->fetchAssociative();
    // date("d/m/Y", strtotime($date["submition_date"]));
    return array("date" => date("d/m/Y", strtotime($date["submition_date"])), "rujukan" => $date["reference"]);
  }

  public function getAllImgs($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT * FROM data.files ";
    $query .= "WHERE no_akaun = :no_akaun ";
    $query .= "ORDER BY files.date DESC limit 2";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $fileId);
    $database->execute();
    $files = $database->fetchAllAssociative();

    return $files;
  }

  public function getAllDocs($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT f.*, d.document as doc_name FROM data.fdocs f ";
    $query .= "LEFT JOIN data.doctype d ON f.file_type = d.id ";
    $query .= "WHERE f.no_akaun = :no_akaun";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $fileId);
    $database->execute();
    $files = $database->fetchAllAssociative();

    return $files;
  }

  public function datasubmition($id)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $query = "SELECT s.*, c.siri_no, cf.file, cd.doc FROM data.v_semak_raw s ";
    $query .= "LEFT JOIN data.calculator c ON s.smk_akaun = c.account_no ";
    $query .= "LEFT JOIN (select count(*) as file, no_akaun from data.files group by no_akaun) cf ON s.smk_akaun = cf.no_akaun ";
    $query .= "LEFT JOIN (select count(*) as doc, no_akaun from data.fdocs group by no_akaun) cd ON s.smk_akaun = cd.no_akaun ";
    $query .= "WHERE s.smk_submit_id = :id";
    $database->prepare($query);
    $database->bindValue(":id", Encryption::decryptId($id));
    $database->execute();

    $rows = $database->fetchAllAssociative();

    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {

      $dbOracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $val["smk_akaun"]);
      $info = $dbOracle->fetchAssociative();

      $rowOutput["id"] = Encryption::encryptId($val["smk_submit_id"]);
      $rowOutput["sid"] = $val["smk_submit_id"];
      $rowOutput["akaun"] = $val["smk_akaun"];
      $rowOutput["pmk_nmbil"] = $info["pmk_nmbil"];
      $rowOutput["pmk_plgid"] = $info["pmk_plgid"];
      $rowOutput["pmk_hkmlk"] = $info["pmk_hkmlk"];
      $rowOutput["peg_pelan"] = $info["peg_pelan"];
      $rowOutput["peg_rjmmk"] = $info["peg_rjmmk"];
      $rowOutput["peg_lstnh"] = $this->checkNullNumber($info["peg_lstnh"]);
      $rowOutput["peg_lsbgn"] = $this->checkNullNumber($info["peg_lsbgn"]);
      $rowOutput["peg_lsans"] = $this->checkNullNumber($info["peg_lsans"]);
      $rowOutput["peg_nilth"] = $info["peg_nilth"];
      $rowOutput["kaw_kadar"] = $info["kaw_kadar"];
      $rowOutput["peg_tksir"] = $info["peg_tksir"];
      $rowOutput["smk_akaun"] = $val["smk_akaun"];
      $rowOutput["smk_nolot"] = $info["peg_nolot"];
      $rowOutput["smk_nompt"] = $info["peg_nompt"];
      $rowOutput["smk_adpg1"] = $info["adpg1"];
      $rowOutput["smk_adpg2"] = $info["adpg2"];
      $rowOutput["smk_adpg3"] = $info["adpg3"];
      $rowOutput["smk_adpg4"] = $info["adpg4"];
      $rowOutput["jln_kname"] = $dbOracle->getElementById("SPMC.V_MKWJLN", "kws_knama", "jln_jlkod", $info["jln_jlkod"]);
      if ($val["smk_jstnh"] != null) {
        $rowOutput["tnh_tnama"] = $dbOracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["smk_jstnh"]);
      } else {
        $rowOutput["tnh_tnama"] = $this->checkNull($val["smk_jstnh"]);
      }
      $rowOutput["smk_lsbgn"] = $val["smk_lsbgn"];
      $rowOutput["smk_lstnh"] = $val["smk_lstnh"];
      $rowOutput["smk_lsans"] = $val["smk_lsans"];
      $rowOutput["smk_lsbgn_tmbh"] = $val["smk_lsbgn_tmbh"];
      $rowOutput["smk_lsans_tmbh"] = $val["smk_lsans_tmbh"];
      $rowOutput["smk_codex"] = $val["smk_codex"];
      $rowOutput["smk_codey"] = $val["smk_codey"];
      $rowOutput["smk_type"] = $val["smk_type"];
      $rowOutput["smk_stspn"] = $val["smk_stspn"];
      $rowOutput["hadapan"] = $val["hadapan"];
      $rowOutput["belakang"] = $val["belakang"];
      $rowOutput["hrt_hnama"] = $info["hrt_hnama"];
      $rowOutput["jln_jnama"] = $info["jln_jnama"];
      $rowOutput["siri_no"] = $this->checkCalcNull($val["siri_no"]);
      $rowOutput["file"] = $this->checkAttachNull($val["file"]);
      $rowOutput["doc"] = $this->checkAttachNull($val["doc"]);

      $rowOutput["files"] = $this->getAllImgs($val["smk_akaun"]);
      $rowOutput["docs"] = $this->getAllDocs($val["smk_akaun"]);
      $rowOutput["role"] = Session::getUserRole();
      array_push($output, $rowOutput);
    }

    return $output;
  }

  public function dataserahannilaiansemula()
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $query = "SELECT s.*, c.siri_no, f.*, d.*, cf.file, cd.doc FROM data.v_semak_raw s ";
    $query .= "LEFT JOIN data.calculator c ON s.smk_akaun = c.account_no ";
    $query .= "LEFT JOIN (select no_akaun, filename from data.files) f ON s.smk_akaun = f.no_akaun ";
    $query .= "LEFT JOIN (select no_akaun, filename, extension from data.fdocs) d ON s.smk_akaun = d.no_akaun ";
    $query .= "LEFT JOIN (select count(*) as file, no_akaun from data.files group by no_akaun) cf ON s.smk_akaun = cf.no_akaun ";
    $query .= "LEFT JOIN (select count(*) as doc, no_akaun from data.fdocs group by no_akaun) cd ON s.smk_akaun = cd.no_akaun ";
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();

    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {

      $dbOracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $val["smk_akaun"]);
      $info = $dbOracle->fetchAssociative();

      $rowOutput["id"] = $val["id"];
      $rowOutput["sid"] = $val["smk_submit_id"];
      $rowOutput["no_akaun"] = $val["smk_akaun"];
      $rowOutput["akaun"] = Encryption::encryptId($val["smk_akaun"]);
      $rowOutput["sirino"] = $this->checkSiriNo($val["siri_no"]);
      $rowOutput["pmk_nmbil"] = $info["pmk_nmbil"];
      $rowOutput["pmk_plgid"] = $info["pmk_plgid"];
      $rowOutput["pmk_hkmlk"] = $info["pmk_hkmlk"];
      $rowOutput["peg_pelan"] = $info["peg_pelan"];
      $rowOutput["peg_rjmmk"] = $info["peg_rjmmk"];
      $rowOutput["peg_nilth"] = $info["peg_nilth"];
      $rowOutput["kaw_kadar"] = $info["kaw_kadar"];
      $rowOutput["peg_tksir"] = $info["peg_tksir"];
      $rowOutput["smk_akaun"] = $val["smk_akaun"];
      $rowOutput["smk_nolot"] = $val["smk_nolot"];
      $rowOutput["smk_nompt"] = $val["smk_nompt"];
      $rowOutput["smk_adpg1"] = $val["smk_adpg1"];
      $rowOutput["smk_adpg2"] = $val["smk_adpg2"];
      $rowOutput["smk_adpg3"] = $val["smk_adpg3"];
      $rowOutput["smk_adpg4"] = $val["smk_adpg4"];
      $rowOutput["jln_kname"] = $dbOracle->getElementById("SPMC.V_MKWJLN", "kws_knama", "jln_jlkod", $info["jln_jlkod"]);
      if ($val["smk_jstnh"] != null) {
        $rowOutput["tnh_tnama"] = $dbOracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["smk_jstnh"]);
      } else {
        $rowOutput["tnh_tnama"] = $this->checkNull($val["smk_jstnh"]);
      }
      if ($val["smk_jsbgn"] != null) {
        $rowOutput["bgn_bnama"] = $dbOracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $val["smk_jsbgn"]);
      } else {
        $rowOutput["bgn_bnama"] = $this->checkNull($val["smk_jsbgn"]);
      }
      if ($val["smk_stbgn"] != null) {
        $rowOutput["stb_snama"] = $dbOracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $val["smk_stbgn"]);
      } else {
        $rowOutput["stb_snama"] = $this->checkNull($val["smk_stbgn"]);
      }
      $rowOutput["smk_lsbgn"] = $val["smk_lsbgn"];
      $rowOutput["smk_lstnh"] = $val["smk_lstnh"];
      $rowOutput["smk_lsans"] = $val["smk_lsans"];
      $rowOutput["smk_lsbgn_tmbh"] = $val["smk_lsbgn_tmbh"];
      $rowOutput["smk_lsans_tmbh"] = $val["smk_lsans_tmbh"];
      $rowOutput["smk_codex"] = $val["smk_codex"];
      $rowOutput["smk_codey"] = $val["smk_codey"];
      $rowOutput["smk_type"] = $val["smk_type"];
      $rowOutput["smk_stspn"] = $val["smk_stspn"];
      $rowOutput["hadapan"] = $val["hadapan"];
      $rowOutput["belakang"] = $val["belakang"];
      $rowOutput["hrt_hnama"] = $info["hrt_hnama"];
      $rowOutput["jln_jnama"] = $info["jln_jnama"];
      $rowOutput["smk_datevisit"] = date("d/m/Y", strtotime($val["smk_datevisit"]));
      $rowOutput["smk_timevisit"] = date("H:i:s", strtotime($val["smk_datevisit"]));
      $rowOutput["workerid"] = $val["workerid"];
      $rowOutput["name"] = $val["name"];
      $rowOutput["file"] = $val["file"];
      $rowOutput["doc"] = $val["doc"];
      $rowOutput["role"] = Session::getUserRole();
      array_push($output, $rowOutput);
    }

    return $output;
  }

  public function datanilaiansemula()
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $query = "SELECT no_siri, no_akaun, tkhpl, tkhtk, nilth_baru, kadar_baru, cukai_baru, sebab, mesej, entry, verifier, vstatus FROM data.v_submitioninfops ";
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();

    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {

      $dbOracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $val["no_akaun"]);
      $info = $dbOracle->fetchAssociative();

      $rowOutput["no_siri"] = $val["no_siri"];
      $rowOutput["no_akaun"] = $val["no_akaun"];
      $rowOutput["pmk_nmbil"] = $info["pmk_nmbil"];
      $rowOutput["pmk_plgid"] = $info["pmk_plgid"];
      $rowOutput["pmk_hkmlk"] = $info["pmk_hkmlk"];
      $rowOutput["peg_pelan"] = $info["peg_pelan"];
      $rowOutput["peg_rjmmk"] = $info["peg_rjmmk"];
      $rowOutput["peg_nilth"] = $info["peg_nilth"];
      $rowOutput["kaw_kadar"] = $info["kaw_kadar"];
      $rowOutput["peg_tksir"] = $info["peg_tksir"];
      $rowOutput["adpg1"] = $info["adpg1"];
      $rowOutput["adpg2"] = $info["adpg2"];
      $rowOutput["adpg3"] = $info["adpg3"];
      $rowOutput["adpg4"] = $info["adpg4"];
      $rowOutput["peg_nolot"] = $info["peg_nolot"];
      $rowOutput["peg_nompt"] = $info["peg_nompt"];
      $rowOutput["peg_lsbgn"] = $info["peg_lsbgn"];
      $rowOutput["peg_lstnh"] = $info["peg_lstnh"];
      $rowOutput["tkhpl"] = $val["tkhpl"];
      $rowOutput["tkhtk"] = $val["tkhtk"];
      $rowOutput["nilth_baru"] = $this->checkNullNumber($val["nilth_baru"]);
      $rowOutput["kadar_baru"] = $this->checkNullNumber($val["kadar_baru"]);
      $rowOutput["cukai_baru"] = $this->checkNullNumber($val["cukai_baru"]);
      $rowOutput["sebab"] = $dbOracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $val["sebab"]);
      $rowOutput["mesej"] = $val["mesej"];

      // $rowOutput["smk_lsbgn"] = $val["smk_lsbgn"];
      // $rowOutput["smk_lstnh"] = $val["smk_lstnh"];
      // $rowOutput["smk_lsans"] = $val["smk_lsans"];
      // $rowOutput["smk_lsbgn_tmbh"] = $val["smk_lsbgn_tmbh"];
      // $rowOutput["smk_lsans_tmbh"] = $val["smk_lsans_tmbh"];
      $rowOutput["role"] = Session::getUserRole();
      array_push($output, $rowOutput);
    }

    return $output;
  }
}
