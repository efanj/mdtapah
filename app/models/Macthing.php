<?php

class Macthing extends Model
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

  public function macthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $dbOracle = new Oracle();

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
    $sel = "SELECT count(*) AS allcount FROM SPMC.V_HVNDUK h";
    $dbOracle->prepare($sel);
    $dbOracle->execute();
    $records = $dbOracle->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM SPMC.V_HVNDUK h ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery . " AND peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    } else {
      $sql .= "WHERE peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    }
    $dbOracle->prepare($sql);
    $dbOracle->execute();

    $records = $dbOracle->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT h.* ";
    $query .= "FROM ( SELECT tmp.*, rownum rn ";
    $query .= "FROM( SELECT peg_akaun, peg_nompt, pmk_nmbil, jln_jnama, jln_knama, jpk_jnama, hrt_hnama, adpg1, adpg2, adpg3, adpg4, pvd_almt1, pvd_almt2, pvd_almt3, pvd_almt4, pvd_almt5 FROM SPMC.V_HVNDUK ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery . " AND peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    } else {
      $query .= "WHERE peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= ") tmp ";
    $query .= "WHERE rownum <= " . (int) ($row + $rowperpage) . " ) h ";
    $query .= "WHERE rn > " . (int) $row;
    $dbOracle->prepare($query);
    $dbOracle->execute();

    $row = $dbOracle->fetchAllAssociative();
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
    $dbOracle = new Oracle();

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
    $sql = "SELECT count(*) AS allcount FROM SPMC.V_HVNDUK h";
    $sel = $dbOracle->prepare($sql);
    $dbOracle->execute($sel);
    $records = $dbOracle->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM SPMC.V_HVNDUK h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is not null AND peg_codey is not null";
    } else {
      $sql .= " WHERE peg_codex is not null AND peg_codey is not null";
    }
    $sel = $dbOracle->prepare($sql);
    $dbOracle->execute($sel);

    $records = $dbOracle->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT h.* ";
    $query .= "FROM ( SELECT tmp.*, rownum rn ";
    $query .= "FROM( SELECT peg_akaun, peg_nompt, pmk_nmbil, jln_jnama, jln_knama, jpk_jnama, hrt_hnama, adpg1, adpg2, adpg3, adpg4, pvd_almt1, pvd_almt2, pvd_almt3, pvd_almt4, pvd_almt5 FROM SPMC.V_HVNDUK ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery . " AND peg_codex is not null AND peg_codey is not null AND peg_statf != 'H'";
    } else {
      $query .= "WHERE peg_codex is not null AND peg_codey is not null AND peg_statf != 'H'";
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= ") tmp ";
    $query .= "WHERE rownum <= " . (int) ($row + $rowperpage) . " ) h ";
    $query .= "WHERE rn > " . (int) $row;
    $dbOracle->prepare($query);
    $dbOracle->execute();

    $row = $dbOracle->fetchAllAssociative();
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
    $dbOracle = new Oracle();
    $query = "SELECT s.*, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM SPMC.V_HVNDUK s ";
    $query .= "LEFT JOIN SPMC.V_HTANAH h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN SPMC.V_HBANGN b ON s.peg_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN SPMC.V_HSTBGN st ON s.peg_stkod = st.stb_stkod ";
    $query .= "WHERE s.peg_akaun = :akaun ";
    $dbOracle->prepare($query);
    $dbOracle->bindValue(":akaun", Encryption::decryptId($fileId));
    $dbOracle->execute();

    $info = $dbOracle->fetchAssociative();
    return $info;
  }

  public function editcoords($userId, $no_akaun, $nolot, $codex, $codey)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $no_akaun = empty($no_akaun) ? null : $no_akaun;
    $koordinat_x = empty($codex) ? null : substr($codex, 0, 15);
    $koordinat_y = empty($codey) ? null : substr($codey, 0, 15);

    $localcount = $database->countByNoAcct("coordinates", "akaun", $no_akaun);
    $epbtcount = $dbOracle->countByNoAcct("KOORDINAT", "AKAUN", $no_akaun);

    $dbOracle->getByNoAcct("V_HVNDUK", "peg_akaun", $no_akaun);
    $info = $dbOracle->fetchAssociative();

    $nolot = empty($nolot) ? $info['peg_nolot'] : $nolot;

    if (!empty($no_akaun) && $localcount > 0) {
      $qry = "UPDATE data.coordinates SET codex= '" . $koordinat_x . "', codey = '" . $koordinat_y . "', geom=ST_SetSRID(ST_MakePoint($koordinat_y, $koordinat_x), 4326) WHERE akaun = " . $no_akaun;
      $database->prepare($qry);
      $database->execute();
    } elseif (!empty($no_akaun) && $localcount < 1) {
      $qry = "INSERT INTO data.coordinates (akaun, plgid, nama, codex, codey, nolot) ";
      $qry .= "VALUES($no_akaun, '" . $info['pmk_plgid'] . "', '" . $info['pmk_nmbil'] . "', $koordinat_x, $koordinat_y, '" . $nolot . "')";
      $database->prepare($qry);
      $database->execute();
    }

    if (!empty($no_akaun) && $epbtcount > 0) {
      $stmt = "UPDATE SPMC.KOORDINAT SET CODEX= '" . $koordinat_x . "', CODEY = '" . $koordinat_y . "'";
      $stmt .= " WHERE AKAUN = " . $no_akaun;
      $dbOracle->prepare($stmt);
      $dbOracle->execute();
    } elseif (!empty($no_akaun) && $epbtcount < 1) {
      $stmt = "INSERT INTO SPMC.KOORDINAT (AKAUN, PLGID, NAMA, CODEX, CODEY, NOLOT, NOMPT) ";
      $stmt .= "VALUES($no_akaun, '" . $info['pmk_plgid'] . "', '" . $info['pmk_nmbil'] . "', $koordinat_x, $koordinat_y, '" . $nolot . "', ";
      $stmt .= "'" . $info['peg_nompt'] . "')";
      $dbOracle->prepare($stmt);
      $dbOracle->execute();
    }

    return ["success" => true];
  }

  public function macthingSubmit($userId, $akaun, $codex, $codey)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $dbOracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $akaun);
    $info = $dbOracle->fetchAssociative();

    $query = "UPDATE data.pindaan_raw SET luas_bangunan=:lsbgn , luas_ansolari=:lsans, catatan_hadapan=:nota ";
    $query .= "WHERE id = :id";
    $dbOracle->prepare($query);
    $dbOracle->bindValue(":lsbgn", $akaun);
    $dbOracle->bindValue(":lsans", $codex);
    $dbOracle->bindValue(":nota", $codey);
    $result = $dbOracle->execute();

    if ($result) {
      $activity = "Kemaskini keluasan: No akaun - " . $akaun;
      $database->logActivity($userId, $activity);
    }

    return true;
  }
}
