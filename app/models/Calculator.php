<?php

class Calculator extends Model
{
  public function escapeJsonString($value)
  {
    # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = ["\""];
    $replacements = [""];
    $result = str_replace($escapers, $replacements, $value);
    return $result;
  }

  public function generateSiriNo()
  {
    $siriNo = mt_rand(100000, 999999);
    $year = date("y");
    return $year . $siriNo;
  }

  public function rentSubmit($userId, $siriNo, $acctNo, $compare, $breadth_land, $price_land, $total_land, $main, $out, $rental, $corner, $round, $yearly, $rate, $tax)
  {
    $compare = empty($compare) ? null : $compare;
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $total_land = empty($total_land) ? 0 : $total_land;
    $rental = empty($rental) ? 0 : $rental;
    $round = empty($round) ? 0 : $round;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $corner = $corner == false ? "false" : "true";

    $database = Database::openConnection();
    $dboracle = new Oracle();

    $dboracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $acctNo);
    $row = $dboracle->fetchAssociative();
    $info = $this->getSubmissionInfo($siriNo);

    $land = "INSERT INTO data.items_land(siri_no, breadth, price, total) values ('" . $siriNo . "', " . $breadth_land . ", " . $price_land . ", " . $total_land . ")";
    $database->prepare($land);
    $database->execute();
    $land_id = $database->lastInsertedId();

    $itemsmain_id = [];
    $itemsmain_sum = [];
    foreach ($main as $value) {
      $title = empty($value["title"]) ? null : $value["title"];
      $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
      $price = empty($value["price"]) ? 0 : $value["price"];
      $total = empty($value["total"]) ? 0 : $value["total"];

      $sql = "INSERT INTO data.items_main(siri_no, title, breadth, breadthtype, price, pricetype, total) values ";
      $sql .= "('" . $siriNo . "','" . $title . "'," . $breadth . ",'" . $value["breadthtype"] . "'," . $price . ",'" . $value["pricetype"] . "'," . $total . ")";
      $database->prepare($sql);
      $database->execute();
      $itemsmain_id[] = $database->lastInsertedId();
      $itemsmain_sum[] = $value["total"];
    }
    $idItemsMain = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($itemsmain_id)));
    $sumItemMain = array_sum($itemsmain_sum);

    $itemsout_id = [];
    $itemsout_sum = [];
    foreach ($out as $value) {
      if ($value["breadth"] != 0 || $value["breadth"] != null) {
        $title = empty($value["title"]) ? null : $value["title"];
        $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
        $price = empty($value["price"]) ? 0 : $value["price"];
        $total = empty($value["total"]) ? 0 : $value["total"];

        $sql = "INSERT INTO data.items_out(siri_no, title, breadth, breadthtype, price, pricetype, total) values ";
        $sql .= "('" . $siriNo . "','" . $title . "'," . $breadth . ",'" . $value["breadthtype"] . "'," . $price . ",'" . $value["pricetype"] . "'," . $total . ")";
        $database->prepare($sql);
        $database->execute();
      }
      $itemsout_id[] = $database->lastInsertedId();
      $itemsout_sum[] = $value["total"];
    }
    $idItemsOut = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($itemsout_id)));
    $sumItemOut = array_sum($itemsout_sum);

    if ($compare != null) {
      $compare = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($compare)));
    } else {
      $compare = $compare;
    }

    $totalbuilding = $sumItemMain + $sumItemOut;

    $query = "INSERT INTO data.calculator(calc_type, siri_no, acct_no, compare, land, main, moverall, out, capital_rental, corner, yearly, round, rate, tax) ";
    $query .= "VALUES(1, '" . $siriNo . "', " . $acctNo . ", '" . $compare . "', '" . $land_id . "', '" . $idItemsMain . "', " . $totalbuilding . ", ";
    $query .= "'" . $idItemsOut . "', " . $rental . ", " . $corner . ", " . $yearly . ", " . $round . ", " . $rate . ", " . $tax . ")";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      if ($info['form'] == "B") {
        $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $row['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "C") {
        $update = "UPDATE data.t_hacmjc SET mjc_nilth = " . $yearly . " WHERE mjc_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "PS") {
        $update = "UPDATE data.v_hacmjb SET mjb_nilth = " . $row['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      }
      $database->prepare($update);
      $database->execute();
    }

    if ($result) {
      $activity = "Pengiraan Nilaian : No Siri - " . $siriNo;
      $database->logActivity($userId, $activity);
    }

    return true;
  }

  public function vendorRentSubmit($userId, $workerId, $acctNo, $compare, $breadth_land, $price_land, $total_land, $main, $out, $rental, $corner, $round, $yearly, $rate, $tax)
  {
    $compare = empty($compare) ? null : $compare;
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $rental = empty($rental) ? 0 : $rental;
    $even = empty($even) ? 0 : $even;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $corner = $corner == false ? "false" : "true";

    $database = Database::openConnection();

    $land = "INSERT INTO data.items_land(breadth, price, total, total_overall) values (" . $breadth_land . ", " . $price_land . ", " . $total_land . ", " . $total_land . ")";
    $database->prepare($land);
    $database->execute();
    $land_id = $database->lastInsertedId();

    $itemsmain_id = [];
    $itemsmain_sum = [];
    foreach ($main as $value) {
      $title = empty($value["title"]) ? null : $value["title"];
      $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
      $price = empty($value["price"]) ? 0 : $value["price"];
      $total = empty($value["total"]) ? 0 : $value["total"];

      $sql = "INSERT INTO data.items_main(title, breadth, breadthtype, price, pricetype, total) values ";
      $sql .= "('" . $title . "'," . $breadth . ",'" . $value["breadthtype"] . "'," . $price . ",'" . $value["pricetype"] . "'," . $total . ")";
      $database->prepare($sql);
      $database->execute();
      $itemsmain_id[] = $database->lastInsertedId();
      $itemsmain_sum[] = $value["total"];
    }
    $idItemsMain = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($itemsmain_id)));
    $sumItemMain = array_sum($itemsmain_sum);

    $itemsout_id = [];
    $itemsout_sum = [];
    foreach ($out as $value) {
      if ($value["breadth"] != 0 || $value["breadth"] != null) {
        $title = empty($value["title"]) ? null : $value["title"];
        $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
        $price = empty($value["price"]) ? 0 : $value["price"];
        $total = empty($value["total"]) ? 0 : $value["total"];

        $sql = "INSERT INTO data.items_out(title, breadth, breadthtype, price, pricetype, total) values ";
        $sql .= "('" . $title . "'," . $breadth . ",'" . $value["breadthtype"] . "'," . $price . ",'" . $value["pricetype"] . "'," . $total . ")";
        $database->prepare($sql);
        $database->execute();
      }
      $itemsout_id[] = $database->lastInsertedId();
      $itemsout_sum[] = $value["total"];
    }
    $idItemsOut = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($itemsout_id)));
    $sumItemOut = array_sum($itemsout_sum);

    if ($compare != null) {
      $compare = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($compare)));
    } else {
      $compare = $compare;
    }

    $totalbuilding = $sumItemMain + $sumItemOut;

    $query = "INSERT INTO data.calculator(calc_type, acct_no, compare, land, main, moverall, out, capital_rental, corner, yearly, round, rate, tax) ";
    $query .= "VALUES(1, " . $acctNo . ", '" . $compare . "', '" . $land_id . "', '" . $idItemsMain . "', " . $totalbuilding . ", ";
    $query .= "'" . $idItemsOut . "', " . $rental . ", " . $corner . ", " . $yearly . ", " . $round . ", " . $rate . ", " . $tax . ")";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      $activity = "Vendor Pengiraan Nilaian : No Akaun - " . $acctNo;
      $database->logActivity($userId, $activity);
    }

    return true;
  }

  public function costSubmit($userId, $workerId, $siriNo, $akaun, $breadth_land, $price_land, $total_land, $adjust_land, $ttl_land, $section, $overall, $capital, $round, $yearly, $rate, $tax)
  {
    $akaun = empty($akaun) ? 0 : $akaun;
    $comparison = empty($comparison) ? null : $comparison;
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $discount = empty($discount) ? 0 : $discount;
    $rental = empty($rental) ? 0 : $rental;
    $even = empty($even) ? 0 : $even;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $total = $breadth_land * $price_land;

    $database = Database::openConnection();
    $dboracle = new Oracle();

    if ($akaun != 0 || $akaun != "") {
      $dboracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $akaun);
      $row = $dboracle->fetchAssociative();
    }

    $info = $this->getSubmissionInfo($siriNo);

    $land = "INSERT INTO data.items_land(siri_no, breadth, price, total, adjustment, total_overall) values ('" . $siriNo . "', " . $breadth_land . ", " . $price_land . ", " . $total_land . ", " . $adjust_land . ", " . $ttl_land . ")";
    $database->prepare($land);
    $database->execute();
    $land_id = $database->lastInsertedId();

    $sectionCostId = [];
    $items_id = [];
    foreach ($section as $val) {
      $sectionCost = "INSERT INTO data.section(siri_no, title, total, adjust) values ('" . $siriNo . "','" . $val["main_title"] . "'," . $val["ttladjust"] . "," . $val["adjust"] . ")";
      $database->prepare($sectionCost);
      $database->execute();
      $sectionCost_id = $database->lastInsertedId();
      $sectionCostId[] = $sectionCost_id;
      foreach ($val['item'] as $value) {
        $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
        $price = empty($value["price"]) ? 0 : $value["price"];
        $total = empty($value["total"]) ? 0 : $value["total"];

        $sql = "INSERT INTO data.items_main(section_id, siri_no, title, breadth, breadthtype, price, pricetype, total) values ";
        $sql .= "(" . $sectionCost_id . ",'" . $siriNo . "','" . $value["title"] . "'," . $breadth . ",'" . $value["breadthtype"] . "'," . $price . ",'" . $value["pricetype"] . "'," . $total . ")";
        $database->prepare($sql);
        $database->execute();
        $items_id[] = $database->lastInsertedId();
      }
    }

    $idSectionCost = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($sectionCostId)));
    $idItemsCost = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($items_id)));

    $query = "INSERT INTO data.calculator(calc_type, siri_no, acct_no, land, section, main, moverall, capital_rental, yearly, round, rate, tax) ";
    $query .= "VALUES(2, '" . $siriNo . "', " . $akaun . ", " . $land_id . ", '" . $idSectionCost . "', '" . $idItemsCost . "', " . $overall . ", " . $capital . ", " . $yearly . ", " . $round . ", " . $rate . ", " . $tax . ")";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      if ($info['form'] == "B") {
        $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $row['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "C") {
        $update = "UPDATE data.t_hacmjc SET mjc_nilth = " . $yearly . " WHERE mjc_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "PS") {
        $update = "UPDATE data.p_hacmjb SET mjb_nilth = " . $row['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      }
      $database->prepare($update);
      $database->execute();
    }

    if ($result) {
      $activity = "Pengiraan Nilaian : No Siri - " . $siriNo;
      $database->logActivity($userId, $activity);
    }

    return true;
  }

  public function vendorcostSubmit($userId, $workerId, $akaun, $breadth_land, $price_land, $total_land, $adjust_land, $ttl_land, $section, $overall, $capital, $round, $yearly, $rate, $tax)
  {
    $siriNo = $this->generateSiriNo();
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $discount = empty($discount) ? 0 : $discount;
    $overall = empty($overall) ? 0 : $overall;
    $capital = empty($capital) ? 0 : $capital;
    $round = empty($round) ? 0 : $round;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $sectionCost_id = "";

    $database = Database::openConnection();
    $dboracle = new Oracle();

    $dboracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $akaun);
    $row = $dboracle->fetchAssociative();


    $land = "INSERT INTO data.items_land(siri_no, breadth, price, total, adjustment, total_overall) values ('" . $siriNo . "', " . $breadth_land . ", " . $price_land . ", " . $total_land . ", " . $adjust_land . ", " . $ttl_land . ")";
    $database->prepare($land);
    $database->execute();
    $land_id = $database->lastInsertedId();

    $sectionCostId = [];
    $items_id = [];
    foreach ($section as $val) {
      $sectionCost = "INSERT INTO data.section(siri_no, title, total, adjust) values ('" . $siriNo . "','" . $val["main_title"] . "'," . $val["ttladjust"] . "," . $val["adjust"] . ")";
      $database->prepare($sectionCost);
      $database->execute();
      $sectionCost_id = $database->lastInsertedId();
      $sectionCostId[] = $sectionCost_id;
      foreach ($val['item'] as $value) {
        $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
        $price = empty($value["price"]) ? 0 : $value["price"];
        $total = empty($value["total"]) ? 0 : $value["total"];

        $sql = "INSERT INTO data.items_main(section_id, siri_no, title, breadth, breadthtype, price, pricetype, total) values ";
        $sql .= "(" . $sectionCost_id . ",'" . $siriNo . "','" . $value["title"] . "'," . $breadth . ",'" . $value["breadthtype"] . "'," . $price . ",'" . $value["pricetype"] . "'," . $total . ")";
        $database->prepare($sql);
        $database->execute();
        $items_id[] = $database->lastInsertedId();
      }
    }

    $idSectionCost = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($sectionCostId)));
    $idItemsCost = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($items_id)));

    $query = "INSERT INTO data.calculator(calc_type, siri_no, acct_no, land, section, main, moverall, capital_rental, yearly, round, rate, tax) ";
    $query .= "VALUES(2, '" . $siriNo . "', " . $akaun . ", " . $land_id . ", '" . $idSectionCost . "', '" . $idItemsCost . "', " . $overall . ", " . $capital . ", " . $yearly . ", " . $round . ", " . $rate . ", " . $tax . ")";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      $activity = "Vendor Pengiraan Nilaian : No Siri - " . $siriNo;
      $database->logActivity($userId, $activity);
    }

    return true;
  }

  public function costEdit($userId, $workerId, $siriNo, $akaun, $id_land, $breadth_land, $price_land, $total_land, $adjust_land, $ttl_land, $section, $overall, $capital, $round, $yearly, $rate, $tax)
  {
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $discount = empty($discount) ? 0 : $discount;
    $overall = empty($overall) ? 0 : $overall;
    $round = empty($round) ? 0 : $round;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $total = $breadth_land * $price_land;

    $database = Database::openConnection();

    $land = "UPDATE data.items_land SET breadth = " . $breadth_land . ", price = " . $price_land . ", total = " . $total;
    $land .= " WHERE id = " . $id_land . " AND siri_no = '" . $siriNo . "'";
    $database->prepare($land);
    $database->execute();

    foreach ($section as $val) {
      $sectionCost = "UPDATE data.section SET title = '" . $val["main_title"] . "', total = " . $val["ttladjust"] . ", adjust = " . $val["adjust"] . " WHERE id =" . $val["id"] . " AND siri_no = '" . $siriNo . "'";
      $database->prepare($sectionCost);
      $database->execute();

      foreach ($val['item'] as $value) {
        $breadth = empty($value["breadth"]) ? 0 : $value["breadth"];
        $price = empty($value["price"]) ? 0 : $value["price"];
        $total = empty($value["total"]) ? 0 : $value["total"];

        $sql = "UPDATE data.items_main SET title='" . $value["title"] . "', breadth=" . $breadth . ", breadthtype='" . $value["breadthtype"] . "', price=" . $price . ", pricetype='" . $value["pricetype"] . "', total=" . $total . " ";
        $sql .= "WHERE id = " . $value["id"] . " AND siri_no = '" . $siriNo . "'";
        $database->prepare($sql);
        $database->execute();
      }
    }

    $query = "UPDATE data.calculator SET moverall = " . $overall . ", capital_rental = " . $capital . ", yearly = " . $yearly . ", round = " . $round . ", rate = " . $rate . ", tax = " . $tax . " ";
    $query .= "WHERE siri_no = '" . $siriNo . "'";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      $activity = "Kemaskini Pengiraan Nilaian : No Siri - " . $siriNo;
      $database->logActivity($userId, $activity);
    }

    return true;
  }

  public function getSubmissionInfo($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT form FROM data.v_submitioninfo ";
    $query .= "WHERE no_siri = :siriNo";
    $database->prepare($query);
    $database->bindValue(":siriNo", $siriNo);
    $database->execute();
    $info = $database->fetchAssociative();

    return $info;
  }

  public function getSubmissionVendorInfo($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT form FROM data.v_submitionvendorinfo ";
    $query .= "WHERE sirino = :siriNo";
    $database->prepare($query);
    $database->bindValue(":siriNo", $siriNo);
    $database->execute();
    $info = $database->fetchAssociative();

    return $info;
  }

  public function getCalculation($userId, $workerId, $siriNo, $form)
  {
    $database = Database::openConnection();
    $query = "SELECT h.*, v.form FROM data.v_submitioninfo v ";
    $query .= "LEFT JOIN data.hvnduk h ON v.no_akaun = h.peg_akaun ";
    $query .= "WHERE v.no_siri = :siriNo";
    $database->prepare($query);
    $database->bindValue(":siriNo", $siriNo);
    $database->execute();
    $info = $database->fetchAssociative();

    return $info;
  }
}
