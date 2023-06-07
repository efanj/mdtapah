<?php

class Amendment extends Model
{
  public function escapeJsonString($value)
  {
    # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = ["\\", "'", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c"];
    $replacements = ["\\\\", "\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b"];
    $result = str_replace($escapers, $replacements, $value);
    return $result;
  }

  public function checkNull($data)
  {
    if ($data == null) {
      return "-";
    } else {
      return $data;
    }
  }

  public function checkDigitNull($data)
  {
    if ($data == null) {
      return "0";
    } else {
      return number_format($data, 2, '.', '');
    }
  }

  public function macthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery =
        "CAST(peg_akaun AS TEXT) = '" .
        $searchValue .
        "%' OR pmk_nmbil LIKE '%" .
        $searchValue .
        "%' OR adpg1 LIKE '%" .
        $searchValue .
        "%' OR adpg2 LIKE '%" .
        $searchValue .
        "%' OR adpg3 LIKE '%" .
        $searchValue .
        "%' OR adpg4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt1 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt2 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt3 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt5 LIKE '%" .
        $searchValue .
        "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    } else {
      $sql .= " WHERE peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hvnduk h ";
    if ($searchValue != "") {
      $query .= " WHERE " . $searchQuery . " AND peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    } else {
      $query .= " WHERE peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $rowOutput["id"] = Encryption::encryptId($val["peg_akaun"]);
      $rowOutput["peg_akaun"] = $val["peg_akaun"];
      $rowOutput["peg_nompt"] = $val["peg_nompt"];
      $rowOutput["pmk_nmbil"] = $val["pmk_nmbil"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["jln_knama"] = $val["jln_knama"];
      $rowOutput["jpk_jnama"] = $val["jpk_jnama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];

      $rowOutput["adpg1"] = $val["adpg1"];
      $rowOutput["adpg2"] = $val["adpg2"];
      $rowOutput["adpg3"] = $val["adpg3"];
      $rowOutput["adpg4"] = $val["adpg4"];
      $rowOutput["pvd_almt1"] = $val["pvd_almt1"];
      $rowOutput["pvd_almt2"] = $val["pvd_almt2"];
      $rowOutput["pvd_almt3"] = $val["pvd_almt3"];
      $rowOutput["pvd_almt4"] = $val["pvd_almt4"];
      $rowOutput["pvd_almt5"] = $val["pvd_almt5"];
      $rowOutput["role"] = Session::getUserRole();
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function remacthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery =
        "CAST(peg_akaun AS TEXT) = '" .
        $searchValue .
        "%' OR pmk_nmbil LIKE '%" .
        $searchValue .
        "%' OR adpg1 LIKE '%" .
        $searchValue .
        "%' OR adpg2 LIKE '%" .
        $searchValue .
        "%' OR adpg3 LIKE '%" .
        $searchValue .
        "%' OR adpg4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt1 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt2 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt3 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt5 LIKE '%" .
        $searchValue .
        "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is not null AND peg_codey is not null";
    } else {
      $sql .= " WHERE peg_codex is not null AND peg_codey is not null";
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hvnduk h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is not null AND peg_codey is not null";
    } else {
      $sql .= " WHERE peg_codex is not null AND peg_codey is not null";
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $rowOutput["id"] = Encryption::encryptId($val["peg_akaun"]);
      $rowOutput["peg_akaun"] = $val["peg_akaun"];
      $rowOutput["peg_nompt"] = $val["peg_nompt"];
      $rowOutput["pmk_nmbil"] = $val["pmk_nmbil"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["jln_knama"] = $val["jln_knama"];
      $rowOutput["jpk_jnama"] = $val["jpk_jnama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];

      $rowOutput["adpg1"] = $val["adpg1"];
      $rowOutput["adpg2"] = $val["adpg2"];
      $rowOutput["adpg3"] = $val["adpg3"];
      $rowOutput["adpg4"] = $val["adpg4"];
      $rowOutput["pvd_almt1"] = $val["pvd_almt1"];
      $rowOutput["pvd_almt2"] = $val["pvd_almt2"];
      $rowOutput["pvd_almt3"] = $val["pvd_almt3"];
      $rowOutput["pvd_almt4"] = $val["pvd_almt4"];
      $rowOutput["pvd_almt5"] = $val["pvd_almt5"];
      $rowOutput["role"] = Session::getUserRole();
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function getAccountInfo($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT s.*, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM data.hvnduk s ";
    $query .= "LEFT JOIN data.htanah h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn b ON s.peg_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON s.peg_stkod = st.stb_stkod ";
    $query .= "WHERE s.peg_akaun = :akaun ";
    $database->prepare($query);
    $database->bindValue(":akaun", Encryption::decryptId($fileId));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function getAmendTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "(CAST(no_siri AS TEXT) = '" . $searchValue . "' OR CAST(no_akaun AS TEXT) = '" . $searchValue . "' OR no_lot LIKE '%" . $searchValue . "%' OR CAST(plgid AS TEXT) = '" . $searchValue . "' OR nmbil LIKE '%" . $searchValue . "%' OR form LIKE '%" . $searchValue . "%')";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfo ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfo ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.v_submitioninfo ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;

    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $dboracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $val["no_akaun"]);
      $info = $dboracle->fetchAssociative();

      $rowOutput["noSiri"] = Encryption::encryptId($val["no_siri"]);
      $rowOutput["noAcct"] = Encryption::encryptId($val["no_akaun"]);
      $rowOutput["no_siri"] = $val["no_siri"];
      $rowOutput["no_akaun"] = $val["no_akaun"];
      $rowOutput["tkhpl"] = date("d/m/Y", strtotime($val["tkhpl"]));
      $rowOutput["tkhtk"] = date("d/m/Y", strtotime($val["tkhtk"]));
      if ($val["thkod"] != 0) {
        $rowOutput["tnama"] = $dboracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["thkod"]);
      } else {
        $rowOutput["tnama"] = $dboracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $info["peg_thkod"]);
      }
      if ($val["htkod"] != 0) {
        $rowOutput["hnama"] = $dboracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $val["htkod"]);
      } else {
        $rowOutput["hnama"] = $dboracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $info["peg_htkod"]);
      }
      if ($val["bgkod"] != 0) {
        $rowOutput["bnama"] = $dboracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $val["bgkod"]);
      } else {
        $rowOutput["bnama"] = $dboracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $info["peg_bgkod"]);
      }
      if ($val["stkod"] != 0) {
        $rowOutput["snama"] = $dboracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $val["stkod"]);
      } else {
        $rowOutput["snama"] = $dboracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $info["peg_stkod"]);
      }

      if ($val["form"] == "A") {
        $rowOutput["nilth_asal"] = $this->checkDigitNull($info["peg_nilth"]);
        $rowOutput["kadar_asal"] = $info["kaw_kadar"];
        $rowOutput["cukai_asal"] = $this->checkDigitNull($info["peg_tksir"]);
        $rowOutput["nilth_baru"] = 0;
        $rowOutput["kadar_baru"] = 0;
        $rowOutput["cukai_baru"] = 0;
        $rowOutput["beza_nilth"] = 0;
        $rowOutput["beza_kadar"] = 0;
        $rowOutput["beza_cukai"] = 0;
      } elseif ($val["form"] == "B") {
        $rowOutput["nilth_asal"] = $this->checkDigitNull($info["peg_nilth"]);
        $rowOutput["kadar_asal"] = $info["kaw_kadar"];
        $rowOutput["cukai_asal"] = $this->checkDigitNull($info["peg_tksir"]);
        $rowOutput["nilth_baru"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["kadar_baru"] = $val["new_rate"];
        $rowOutput["cukai_baru"] = $this->checkDigitNull($val["new_tax"]);
        $rowOutput["beza_nilth"] = number_format($this->checkDigitNull($val["new_nilth"]) - $this->checkDigitNull($info["peg_nilth"]), 2);
        $rowOutput["beza_kadar"] = $info["kaw_kadar"] - $val["new_rate"];
        $rowOutput["beza_cukai"] = number_format($this->checkDigitNull($val["new_tax"]) - $this->checkDigitNull($info["peg_tksir"]), 2);
      } elseif ($val["form"] == "C") {
        $rowOutput["nilth_asal"] = 0;
        $rowOutput["kadar_asal"] = 0;
        $rowOutput["cukai_asal"] = 0;
        $rowOutput["nilth_baru"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["kadar_baru"] = $val["new_rate"];
        $rowOutput["cukai_baru"] = $this->checkDigitNull($val["new_tax"]);
        $rowOutput["beza_nilth"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["beza_kadar"] = $val["new_rate"];
        $rowOutput["beza_cukai"] = $this->checkDigitNull($val["new_tax"]);
      } elseif ($val["form"] == "PS") {
        $rowOutput["nilth_asal"] = $this->checkDigitNull($info["peg_nilth"]);
        $rowOutput["kadar_asal"] = $info["kaw_kadar"];
        $rowOutput["cukai_asal"] = $this->checkDigitNull($info["peg_tksir"]);
        $rowOutput["nilth_baru"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["kadar_baru"] = $val["new_rate"];
        $rowOutput["cukai_baru"] = $this->checkDigitNull($val["new_tax"]);
        $rowOutput["beza_nilth"] = number_format($this->checkDigitNull($val["new_nilth"]) - $this->checkDigitNull($info["peg_nilth"]), 2);
        $rowOutput["beza_kadar"] = $info["kaw_kadar"] - $val["new_rate"];
        $rowOutput["beza_cukai"] = number_format($this->checkDigitNull($val["new_tax"]) - $this->checkDigitNull($info["peg_tksir"]), 2);
      }
      $rowOutput["sebab"] = $dboracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $val["sebab"]);
      $rowOutput["mesej"] = $val["mesej"];
      // $rowOutput["status"] = $val["status"];
      $rowOutput["vstatus"] = $val["vstatus"];
      $rowOutput["entry"] = $val["entry"];
      $rowOutput["verifier"] = $val["verifier"];
      $rowOutput["form"] = $val["form"];
      $rowOutput["calctype"] = $val["calctype"];
      array_push($output, $rowOutput);
    }
    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function getVerifyTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "(CAST(no_siri AS TEXT) = '" . $searchValue . "' OR CAST(no_akaun AS TEXT) = '" . $searchValue . "' OR no_lot LIKE '%" . $searchValue . "%' OR CAST(plgid AS TEXT) = '" . $searchValue . "' OR nmbil LIKE '%" . $searchValue . "%' OR form LIKE '%" . $searchValue . "%')";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfo ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfo ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.v_submitioninfo ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;

    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $dboracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $val["no_akaun"]);
      $info = $dboracle->fetchAssociative();

      $rowOutput["noSiri"] = Encryption::encryptId($val["no_siri"]);
      $rowOutput["noAcct"] = Encryption::encryptId($val["no_akaun"]);
      $rowOutput["no_siri"] = $val["no_siri"];
      $rowOutput["no_akaun"] = $val["no_akaun"];
      $rowOutput["tkhpl"] = date("d/m/Y", strtotime($val["tkhpl"]));
      $rowOutput["tkhtk"] = date("d/m/Y", strtotime($val["tkhtk"]));
      if ($val["thkod"] != 0) {
        $rowOutput["tnama"] = $dboracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["thkod"]);
      } else {
        $rowOutput["tnama"] = $dboracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $info["peg_thkod"]);
      }
      if ($val["htkod"] != 0) {
        $rowOutput["hnama"] = $dboracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $val["htkod"]);
      } else {
        $rowOutput["hnama"] = $dboracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $info["peg_htkod"]);
      }
      if ($val["bgkod"] != 0) {
        $rowOutput["bnama"] = $dboracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $val["bgkod"]);
      } else {
        $rowOutput["bnama"] = $dboracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $info["peg_bgkod"]);
      }
      if ($val["stkod"] != 0) {
        $rowOutput["snama"] = $dboracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $val["stkod"]);
      } else {
        $rowOutput["snama"] = $dboracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $info["peg_stkod"]);
      }

      if ($val["form"] == "A") {
        $rowOutput["nilth_asal"] = $this->checkDigitNull($info["peg_nilth"]);
        $rowOutput["kadar_asal"] = $info["kaw_kadar"];
        $rowOutput["cukai_asal"] = $this->checkDigitNull($info["peg_tksir"]);
        $rowOutput["nilth_baru"] = 0;
        $rowOutput["kadar_baru"] = 0;
        $rowOutput["cukai_baru"] = 0;
        $rowOutput["beza_nilth"] = 0;
        $rowOutput["beza_kadar"] = 0;
        $rowOutput["beza_cukai"] = 0;
      } elseif ($val["form"] == "B") {
        $rowOutput["nilth_asal"] = $this->checkDigitNull($info["peg_nilth"]);
        $rowOutput["kadar_asal"] = $info["kaw_kadar"];
        $rowOutput["cukai_asal"] = $this->checkDigitNull($info["peg_tksir"]);
        $rowOutput["nilth_baru"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["kadar_baru"] = $val["new_rate"];
        $rowOutput["cukai_baru"] = $this->checkDigitNull($val["new_tax"]);
        $rowOutput["beza_nilth"] = number_format($this->checkDigitNull($val["new_nilth"]) - $this->checkDigitNull($info["peg_nilth"]), 2);
        $rowOutput["beza_kadar"] = $info["kaw_kadar"] - $val["new_rate"];
        $rowOutput["beza_cukai"] = number_format($this->checkDigitNull($val["new_tax"]) - $this->checkDigitNull($info["peg_tksir"]), 2);
      } elseif ($val["form"] == "C") {
        $rowOutput["nilth_asal"] = 0;
        $rowOutput["kadar_asal"] = 0;
        $rowOutput["cukai_asal"] = 0;
        $rowOutput["nilth_baru"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["kadar_baru"] = $val["new_rate"];
        $rowOutput["cukai_baru"] = $this->checkDigitNull($val["new_tax"]);
        $rowOutput["beza_nilth"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["beza_kadar"] = $val["new_rate"];
        $rowOutput["beza_cukai"] = $this->checkDigitNull($val["new_tax"]);
      } elseif ($val["form"] == "PS") {
        $rowOutput["nilth_asal"] = $this->checkDigitNull($info["peg_nilth"]);
        $rowOutput["kadar_asal"] = $info["kaw_kadar"];
        $rowOutput["cukai_asal"] = $this->checkDigitNull($info["peg_tksir"]);
        $rowOutput["nilth_baru"] = $this->checkDigitNull($val["new_nilth"]);
        $rowOutput["kadar_baru"] = $val["new_rate"];
        $rowOutput["cukai_baru"] = $this->checkDigitNull($val["new_tax"]);
        $rowOutput["beza_nilth"] = number_format($this->checkDigitNull($val["new_nilth"]) - $this->checkDigitNull($info["peg_nilth"]), 2);
        $rowOutput["beza_kadar"] = $info["kaw_kadar"] - $val["new_rate"];
        $rowOutput["beza_cukai"] = number_format($this->checkDigitNull($val["new_tax"]) - $this->checkDigitNull($info["peg_tksir"]), 2);
      }
      $rowOutput["sebab"] = $dboracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $val["sebab"]);
      $rowOutput["mesej"] = $val["mesej"];
      // $rowOutput["status"] = $val["status"];
      $rowOutput["vstatus"] = $val["vstatus"];
      $rowOutput["entry"] = $val["entry"];
      $rowOutput["verifier"] = $val["verifier"];
      $rowOutput["form"] = $val["form"];
      $rowOutput["calctype"] = $val["calctype"];
      array_push($output, $rowOutput);
    }
    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function getVerifyPsTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "(CAST(no_siri AS TEXT) = '" . $searchValue . "' OR CAST(no_akaun AS TEXT) = '" . $searchValue . "')";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfops ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfops ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.v_submitioninfops ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;

    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $qry  = "SELECT vh.peg_nilth, vh.kaw_kadar, vh.peg_tksir, vb.bgn_bnama, vc.hrt_hnama, vd.tnh_tnama, ve.stb_snama FROM SPMC.V_HVNDUK vh ";
      $qry  .= "LEFT JOIN SPMC.V_HBANGN vb ON vh.peg_bgkod = vb.bgn_bgkod ";
      $qry  .= "LEFT JOIN SPMC.V_HHARTA vc ON vh.peg_htkod = vc.hrt_htkod ";
      $qry  .= "LEFT JOIN SPMC.V_HTANAH vd ON vh.peg_thkod = vd.tnh_thkod ";
      $qry  .= "LEFT JOIN SPMC.V_HSTBGN ve ON vh.peg_bgkod = ve.stb_stkod ";
      $qry  .= "WHERE vh.peg_akaun = " . $val['no_akaun'];
      $dbOracle->prepare($qry);
      $dbOracle->execute();
      $res = $dbOracle->fetchAssociative();

      if ($res) {
        $nilth_asal = $res["peg_nilth"];
        $kadar_asal = $res["kaw_kadar"];
        $cukai_asal = $res["peg_tksir"];
        $tnama = $res["tnh_tnama"];
        $hnama = $res["hrt_hnama"];
        $bnama = $res["bgn_bnama"];
        $snama = $res["stb_snama"];
      } else {
        $nilth_asal = 0;
        $kadar_asal = 0;
        $cukai_asal = 0;
        $tnama = "-";
        $hnama = "-";
        $bnama = "-";
        $snama = "-";
      }

      $rowOutput["noSiri"] = empty($val["no_siri"]) ? null : Encryption::encryptId($val["no_siri"]);
      $rowOutput["noAcct"] = Encryption::encryptId($val["no_akaun"]);
      $rowOutput["no_siri"] = $val["no_siri"];
      $rowOutput["no_akaun"] = $val["no_akaun"];
      $rowOutput["tkhpl"] = $val["tkhpl"];
      $rowOutput["tkhtk"] = $val["tkhtk"];
      $rowOutput["tnama"] = $tnama;
      $rowOutput["hnama"] = $hnama;
      $rowOutput["bnama"] = $bnama;
      $rowOutput["snama"] = $snama;
      $rowOutput["nilth_asal"] = number_format($nilth_asal, "2");
      $rowOutput["kadar_asal"] = $kadar_asal;
      $rowOutput["cukai_asal"] = number_format($cukai_asal, "2");
      $rowOutput["nilth_baru"] = number_format($val["new_nilth"], "2");
      $rowOutput["kadar_baru"] = $val["new_rate"];
      $rowOutput["cukai_baru"] = number_format($val["new_tax"], "2");
      $rowOutput["nilth_beza"] = number_format($val["new_nilth"] - $nilth_asal, "2");
      $rowOutput["kadar_beza"] = $val["new_rate"] - $kadar_asal;
      $rowOutput["cukai_beza"] = number_format($val["new_tax"] - $cukai_asal, "2");
      if ($val["sebab"] != null) {
        $rowOutput["sebab"] = $dbOracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $val["sebab"]);
      } else {
        $rowOutput["sebab"] = $this->checkNull($val["sebab"]);
      }
      $rowOutput["mesej"] = $val["mesej"];
      $rowOutput["status"] = $val["vstatus"];
      $rowOutput["entry"] = $val["entry"];
      $rowOutput["verifier"] = $val["verifier"];
      $rowOutput["form"] = $val["form"];
      $rowOutput["calctype"] = $val["calctype"];
      array_push($output, $rowOutput);
    }
    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function getReviewTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "(CAST(no_siri AS TEXT) = '" . $searchValue . "' OR CAST(no_akaun AS TEXT) = '" . $searchValue . "')";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfops v ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_submitioninfops v ";
    $sql .= "LEFT JOIN data.calculator c ON v.no_akaun = c.acct_no ";
    $sql .= "LEFT JOIN (select count(*) as file, no_akaun from data.files group by no_akaun) cf ON v.no_akaun = cf.no_akaun ";
    $sql .= "LEFT JOIN (select count(*) as doc, no_akaun from data.fdocs group by no_akaun) cd ON v.no_akaun = cd.no_akaun ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT v.*, cf.file, cd.doc FROM data.v_submitioninfops v ";
    $query .= "LEFT JOIN data.calculator c ON v.no_akaun = c.acct_no ";
    $query .= "LEFT JOIN (select count(*) as file, no_akaun from data.files group by no_akaun) cf ON v.no_akaun = cf.no_akaun ";
    $query .= "LEFT JOIN (select count(*) as doc, no_akaun from data.fdocs group by no_akaun) cd ON v.no_akaun = cd.no_akaun ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;

    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {

      $qry  = "SELECT vh.peg_nilth, vh.kaw_kadar, vh.peg_tksir, vb.bgn_bnama, vc.hrt_hnama, vd.tnh_tnama, ve.stb_snama FROM SPMC.V_HVNDUK vh ";
      $qry  .= "LEFT JOIN SPMC.V_HBANGN vb ON vh.peg_bgkod = vb.bgn_bgkod ";
      $qry  .= "LEFT JOIN SPMC.V_HHARTA vc ON vh.peg_htkod = vc.hrt_htkod ";
      $qry  .= "LEFT JOIN SPMC.V_HTANAH vd ON vh.peg_thkod = vd.tnh_thkod ";
      $qry  .= "LEFT JOIN SPMC.V_HSTBGN ve ON vh.peg_bgkod = ve.stb_stkod ";
      $qry  .= "WHERE vh.peg_akaun = " . $val['no_akaun'];
      $dbOracle->prepare($qry);
      $dbOracle->execute();
      $res = $dbOracle->fetchAssociative();

      if ($res) {
        $nilth_asal = $res["peg_nilth"];
        $kadar_asal = $res["kaw_kadar"];
        $cukai_asal = $res["peg_tksir"];
        $tnama = $res["tnh_tnama"];
        $hnama = $res["hrt_hnama"];
        $bnama = $res["bgn_bnama"];
        $snama = $res["stb_snama"];
      } else {
        $nilth_asal = 0;
        $kadar_asal = 0;
        $cukai_asal = 0;
        $tnama = "-";
        $hnama = "-";
        $bnama = "-";
        $snama = "-";
      }

      $rowOutput["noSiri"] = empty($val["no_siri"]) ? null : Encryption::encryptId($val["no_siri"]);
      $rowOutput["noAcct"] = Encryption::encryptId($val["no_akaun"]);
      $rowOutput["no_siri"] = $val["no_siri"];
      $rowOutput["no_akaun"] = $val["no_akaun"];
      $rowOutput["tkhpl"] = $val["tkhpl"];
      $rowOutput["tkhtk"] = $val["tkhtk"];
      $rowOutput["tnama"] = $tnama;
      $rowOutput["hnama"] = $hnama;
      $rowOutput["bnama"] = $bnama;
      $rowOutput["snama"] = $snama;
      $rowOutput["nilth_asal"] = number_format($nilth_asal, "2");
      $rowOutput["kadar_asal"] = $kadar_asal;
      $rowOutput["cukai_asal"] = number_format($cukai_asal, "2");
      $rowOutput["nilth_baru"] = number_format($val["new_nilth"], "2");
      $rowOutput["kadar_baru"] = $val["new_rate"];
      $rowOutput["cukai_baru"] = number_format($val["new_tax"], "2");
      $rowOutput["nilth_beza"] = number_format($val["new_nilth"] - $nilth_asal, "2");
      $rowOutput["kadar_beza"] = $val["new_rate"] - $kadar_asal;
      $rowOutput["cukai_beza"] = number_format($val["new_tax"] - $cukai_asal, "2");
      if ($val["sebab"] != null) {
        $rowOutput["sebab"] = $dbOracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $val["sebab"]);
      } else {
        $rowOutput["sebab"] = $this->checkNull($val["sebab"]);
      }
      $rowOutput["mesej"] = $val["mesej"];
      $rowOutput["status"] = $val["vstatus"];
      $rowOutput["entry"] = $val["entry"];
      $rowOutput["verifier"] = $val["verifier"];
      $rowOutput["form"] = $val["form"];
      $rowOutput["calctype"] = $val["calctype"];
      $rowOutput["file"] = $val["file"];
      $rowOutput["doc"] = $val["doc"];

      $rowOutput["files"] = $this->getAllImgs($val["no_akaun"]);
      $rowOutput["docs"] = $this->getAllDocs($val["no_akaun"]);
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function checkagain($userId, $id, $catatan)
  {
    $database = Database::openConnection();

    $query = "UPDATE data.smktpk SET smk_stspn = 4, smk_nota=:catatan WHERE id=:id ";

    $database->prepare($query);
    $database->bindValue(":catatan", $catatan);
    $database->bindValue(":id", Encryption::decryptId($id));
    $database->execute();

    return ["success" => true];
  }

  public function createJadualBPS($userId, $workerId, $mjbNsiri, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbSbkod, $mjbMesej, $mjbCalty)
  {

    $mjbAkaun = empty($mjbAkaun) ? "0" : $mjbAkaun;
    $mjbDigit = empty($mjbDigit) ? "0" : $mjbDigit;
    $mjbThkod = empty($mjbThkod) ? "0" : $mjbThkod;
    $mjbBgkod = empty($mjbBgkod) ? "0" : $mjbBgkod;
    $mjbHtkod = empty($mjbHtkod) ? "0" : $mjbHtkod;
    $mjbStkod = empty($mjbStkod) ? "0" : $mjbStkod;
    $mjbJpkod = empty($mjbJpkod) ? "0" : $mjbJpkod;
    $mjbSbkod = empty($mjbSbkod) ? null : $mjbSbkod;
    $mjbMesej = empty($mjbMesej) ? null : $mjbMesej;
    $mjbStcbk = empty($mjbStcbk) ? "T" : $mjbStcbk;
    $mjbStatf = null;
    $mjbHsiri = "0";
    $mjbTkpos = null;
    $mjbEtdate = date("Y-m-d");

    $database = Database::openConnection();
    $dboracle = new Oracle();

    $dboracle->getByNoAcct("V_HVNDUK", "peg_akaun", $mjbAkaun);
    $info = $dboracle->fetchAssociative();

    $database->getByNoAcct("v_submitioninfops", "no_siri", $mjbNsiri);
    $row = $database->fetchAssociative();

    $mjbBnilt = empty($row['new_nilth']) ? "0" : $row['new_nilth'];

    $query = "INSERT INTO data.v_hacmjb(mjb_nsiri, mjb_akaun, mjb_digit, mjb_thkod, mjb_htkod, mjb_jpkod, mjb_bgkod, mjb_stkod, ";
    $query .= "mjb_nilth, mjb_bnilt, mjb_sbkod, mjb_mesej, mjb_statf, mjb_hsiri, mjb_stcbk, mjb_tkpos, mjb_onama, mjb_etdate, mjb_calcty) ";
    $query .= "VALUES(:mjb_nsiri, :mjb_akaun, :mjb_digit, :mjb_thkod, :mjb_htkod, :mjb_jpkod, :mjb_bgkod, :mjb_stkod, :mjb_nilth, :mjb_bnilt, ";
    $query .= ":mjb_sbkod, :mjb_mesej, :mjb_statf, :mjb_hsiri, :mjb_stcbk, :mjb_tkpos, :mjb_onama, :mjb_etdate, :mjb_calcty)";

    $database->prepare($query);
    $database->bindValue(":mjb_nsiri", $mjbNsiri);
    $database->bindValue(":mjb_akaun", $mjbAkaun);
    $database->bindValue(":mjb_digit", $info['peg_digit']);
    $database->bindValue(":mjb_thkod", $mjbThkod);
    $database->bindValue(":mjb_htkod", $mjbHtkod);
    $database->bindValue(":mjb_jpkod", $mjbJpkod);
    $database->bindValue(":mjb_bgkod", $mjbBgkod);
    $database->bindValue(":mjb_stkod", $mjbStkod);
    $database->bindValue(":mjb_nilth", $info['peg_nilth']);
    $database->bindValue(":mjb_bnilt", $mjbBnilt);
    $database->bindValue(":mjb_sbkod", $mjbSbkod);
    $database->bindValue(":mjb_mesej", $mjbMesej);
    $database->bindValue(":mjb_statf", $mjbStatf);
    $database->bindValue(":mjb_hsiri", $mjbHsiri);
    $database->bindValue(":mjb_stcbk", $mjbStcbk);
    $database->bindValue(":mjb_tkpos", $mjbTkpos);
    $database->bindValue(":mjb_onama", $workerId);
    $database->bindValue(":mjb_etdate", $mjbEtdate);
    $database->bindValue(":mjb_calcty", $mjbCalty);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data pindaan.");
    }

    if ($result) {
      $activity = "Pindaan : No akaun - " . $mjbAkaun . " No Siri - " . $mjbNsiri;
      $database->logActivity($userId, $activity);
    }
    return ["success" => true];
  }

  public function getAllImgs($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT * FROM data.files ";
    $query .= "WHERE no_akaun = :no_akaun ";
    $query .= "ORDER BY files.date DESC ";

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
}
