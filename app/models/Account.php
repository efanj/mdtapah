<?php

class Account extends Model
{
  public function generateSiriNo()
  {
    $siriNo = mt_rand(100000, 999999);
    $year = date("y");
    return $year . $siriNo;
  }

  public function checkNull($data)
  {
    if ($data == null or $data == "0") {
      return "-";
    } else {
      return $data;
    }
  }

  public static function dateFormat($date)
  {
    $date = str_replace("-", "/", $date);
    $date = date("d/m/Y", strtotime($date));

    return $date;
  }

  public function createAcct(
    $userId,
    $workerId,
    $mjcTkhpl,
    $mjcTkhtk,
    $mjcTkhoc,
    $mjcAkaun,
    $mjcDigit,
    $mjcHsiri,
    $mjcStcbk,
    $mjcOldac,
    $mjcNobil,
    $mjcNolot,
    $mjcBllot,
    $mjcJlkod,
    $kawKwkod,
    $mjcAdpg1,
    $mjcAdpg2,
    $mjcThkod,
    $mjcBgkod,
    $mjcHtkod,
    $mjcStkod,
    $mjcJpkod,
    $mjcCodex,
    $mjcCodey,
    $mjcDiskn,
    $mjcSmpah,
    $mjcNompt,
    $mjcRjfil,
    $mjcPelan,
    $mjcHkmlk,
    $mjcBilpk,
    $mjcRjmmk,
    $mjcLsbgn,
    $mjcLstnh,
    $mjcLsans,
    $mjcSbkod,
    $mjcMesej,
    $mjcNmbil,
    $mjcPlgid,
    $mjcAmtid
  ) {
    $mjcTkhpl = empty($mjcTkhpl) ? null : $mjcTkhpl;
    $mjcTkhtk = empty($mjcTkhtk) ? null : $mjcTkhtk;
    $mjcTkhoc = empty($mjcTkhoc) ? null : $mjcTkhoc;
    $mjcHsiri = empty($mjcHsiri) ? "0" : $mjcHsiri;
    $mjcNsiri = $this->generateSiriNo();
    $mjcAkaun = empty($mjcAkaun) ? "0" : $mjcAkaun;
    $mjcStcbk = empty($mjcStcbk) ? "T" : $mjcStcbk;
    $mjcOldac = empty($mjcOldac) ? null : $mjcOldac;
    $mjcNobil = empty($mjcNobil) ? null : $mjcNobil;
    $mjcNolot = empty($mjcNolot) ? null : $mjcNolot;
    $mjcBllot = empty($mjcBllot) ? "0" : $mjcBllot;
    $mjcJlkod = empty($mjcJlkod) ? "0" : $mjcJlkod;
    $mjcThkod = empty($mjcThkod) ? "0" : $mjcThkod;
    $kawKwkod = empty($kawKwkod) ? "0" : $kawKwkod;
    $mjcAdpg1 = empty($mjcAdpg1) ? null : $mjcAdpg1;
    $mjcAdpg2 = empty($mjcAdpg2) ? null : $mjcAdpg2;
    $mjcBgkod = empty($mjcBgkod) ? "0" : $mjcBgkod;
    $mjcHtkod = empty($mjcHtkod) ? "0" : $mjcHtkod;
    $mjcStkod = empty($mjcStkod) ? "0" : $mjcStkod;
    $mjcJpkod = empty($mjcJpkod) ? "0" : $mjcJpkod;
    $mjcCodex = empty($mjcCodex) ? null : substr($mjcCodex, 0, 15);
    $mjcCodey = empty($mjcCodey) ? null : substr($mjcCodey, 0, 15);
    $mjcDiskn = empty($mjcDiskn) ? "0" : $mjcDiskn;
    $mjcSmpah = empty($mjcSmpah) ? null : $mjcSmpah;
    $mjcNompt = empty($mjcNompt) ? null : $mjcNompt;
    $mjcNilth = null;
    $mjcRjfil = empty($mjcRjfil) ? null : $mjcRjfil;
    $mjcPelan = empty($mjcPelan) ? null : $mjcPelan;
    $mjcHkmlk = empty($mjcHkmlk) ? null : $mjcHkmlk;
    $mjcBilpk = empty($mjcBilpk) ? "0" : $mjcBilpk;
    $mjcRjmmk = empty($mjcRjmmk) ? null : $mjcRjmmk;
    $mjcLsbgn = empty($mjcLsbgn) ? null : floatval($mjcLsbgn);
    $mjcLstnh = empty($mjcLstnh) ? null : floatval($mjcLstnh);
    $mjcLsans = empty($mjcLsans) ? null : floatval($mjcLsans);
    $mjcStatf = null;
    $mjcMesej = empty($mjcMesej) ? null : $mjcMesej;
    $mjcNmbil = empty($mjcNmbil) ? null : $mjcNmbil;
    $mjcPlgid = empty($mjcPlgid) ? null : $mjcPlgid;
    $mjcAmtid = empty($mjcAmtid) ? "0" : $mjcAmtid;
    $mjcDigit = empty($mjcDigit) ? "0" : $mjcDigit;
    $mjcOnama = empty($workerId) ? "0" : $workerId;
    $mjcEtdate = date("Y-m-d");
    $mjcTkpos = null;

    if ($mjcTkhpl != null) {
      $mjcTkhplPg = str_replace("/", "-", $mjcTkhpl);
      $mjcTkhplPg = date("Y-m-d", strtotime($mjcTkhplPg));
    }

    if ($mjcTkhtk != null) {
      $mjcTkhtkPg = str_replace("/", "-", $mjcTkhtk);
      $mjcTkhtkPg = date("Y-m-d", strtotime($mjcTkhtkPg));
    }

    if ($mjcTkhoc != null) {
      $mjcTkhocPg = str_replace("/", "-", $mjcTkhoc);
      $mjcTkhocPg = date("Y-m-d", strtotime($mjcTkhocPg));
    }

    $database = Database::openConnection();
    $query = "INSERT INTO data.t_hacmjc ";
    $query .= "(mjc_nsiri, mjc_akaun, mjc_digit, mjc_jlkod, mjc_thkod, mjc_htkod, mjc_jpkod, mjc_bgkod, mjc_stkod, mjc_nmbil, mjc_plgid, mjc_amtid, mjc_adpg1, mjc_tkhoc, ";
    $query .= "mjc_rjfil, mjc_tkhpl, mjc_tkhtk, mjc_nolot, mjc_bllot, mjc_pelan, mjc_nompt, mjc_nilth, mjc_hkmlk, mjc_bilpk, mjc_lsbgn, mjc_lstnh, mjc_lsans, mjc_statf, ";
    $query .= "mjc_hsiri, mjc_onama, mjc_rjmmk, mjc_nobil, mjc_sbkod, mjc_mesej, mjc_stcbk, mjc_adpg2, mjc_smpah, mjc_oldac, mjc_codex, mjc_codey, mjc_diskn, mjc_tkpos, ";
    $query .= "mjc_etdate) ";
    $query .= "VALUES (:mjc_nsiri, :mjc_akaun, :mjc_digit, :mjc_jlkod, :mjc_thkod, :mjc_htkod, :mjc_jpkod, :mjc_bgkod, :mjc_stkod, :mjc_nmbil, :mjc_plgid, :mjc_amtid, ";
    $query .= ":mjc_adpg1, :mjc_tkhoc, :mjc_rjfil, :mjc_tkhpl, :mjc_tkhtk, :mjc_nolot, :mjc_bllot, :mjc_pelan, :mjc_nompt, :mjc_nilth, :mjc_hkmlk, :mjc_bilpk, :mjc_lsbgn, ";
    $query .= ":mjc_lstnh, :mjc_lsans, :mjc_statf, :mjc_hsiri, :mjc_onama, :mjc_rjmmk, :mjc_nobil, :mjc_sbkod, :mjc_mesej, :mjc_stcbk, :mjc_adpg2, :mjc_smpah, :mjc_oldac, ";
    $query .= ":mjc_codex, :mjc_codey, :mjc_diskn, :mjc_tkpos, :mjc_etdate)";
    $database->prepare($query);
    $database->bindValue(":mjc_nsiri", $mjcNsiri);
    $database->bindValue(":mjc_akaun", $mjcAkaun);
    $database->bindValue(":mjc_digit", $mjcDigit);
    $database->bindValue(":mjc_jlkod", $mjcJlkod);
    $database->bindValue(":mjc_thkod", $mjcThkod);
    $database->bindValue(":mjc_htkod", $mjcHtkod);
    $database->bindValue(":mjc_jpkod", $mjcJpkod);
    $database->bindValue(":mjc_bgkod", $mjcBgkod);
    $database->bindValue(":mjc_stkod", $mjcStkod);
    $database->bindValue(":mjc_nmbil", $mjcNmbil);
    $database->bindValue(":mjc_plgid", $mjcPlgid);
    $database->bindValue(":mjc_amtid", $mjcAmtid);
    $database->bindValue(":mjc_adpg1", $mjcAdpg1);
    $database->bindValue(":mjc_tkhoc", $mjcTkhocPg);
    $database->bindValue(":mjc_rjfil", $mjcRjfil);
    $database->bindValue(":mjc_tkhpl", $mjcTkhplPg);
    $database->bindValue(":mjc_tkhtk", $mjcTkhtkPg);
    $database->bindValue(":mjc_nolot", $mjcNolot);
    $database->bindValue(":mjc_bllot", $mjcBllot);
    $database->bindValue(":mjc_pelan", $mjcPelan);
    $database->bindValue(":mjc_nompt", $mjcNompt);
    $database->bindValue(":mjc_nilth", $mjcNilth);
    $database->bindValue(":mjc_hkmlk", $mjcHkmlk);
    $database->bindValue(":mjc_bilpk", $mjcBilpk);
    $database->bindValue(":mjc_lsbgn", $mjcLsbgn);
    $database->bindValue(":mjc_lstnh", $mjcLstnh);
    $database->bindValue(":mjc_lsans", $mjcLsans);
    $database->bindValue(":mjc_statf", $mjcStatf);
    $database->bindValue(":mjc_hsiri", $mjcHsiri);
    $database->bindValue(":mjc_onama", $mjcOnama);
    $database->bindValue(":mjc_rjmmk", $mjcRjmmk);
    $database->bindValue(":mjc_nobil", $mjcNobil);
    $database->bindValue(":mjc_sbkod", $mjcSbkod);
    $database->bindValue(":mjc_mesej", $mjcMesej);
    $database->bindValue(":mjc_stcbk", $mjcStcbk);
    $database->bindValue(":mjc_adpg2", $mjcAdpg2);
    $database->bindValue(":mjc_smpah", $mjcSmpah);
    $database->bindValue(":mjc_oldac", $mjcOldac);
    $database->bindValue(":mjc_codex", $mjcCodex);
    $database->bindValue(":mjc_codey", $mjcCodey);
    $database->bindValue(":mjc_diskn", $mjcDiskn);
    $database->bindValue(":mjc_tkpos", $mjcTkpos);
    $database->bindValue(":mjc_etdate", $mjcEtdate);
    // $database->bindValue(":mjc_calcty", $calcType);

    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data jadual c.");
    }

    if ($result) {
      $activity = "Jadual C : No Siri - " . $mjcNsiri;
      $database->logActivity($userId, $activity);
    }

    return ["success" => true, "sirino" => Encryption::encryptId($mjcNsiri)];
  }

  public function createA($userId, $workerId, $mjaTkhpl, $mjaTkhtk, $mjaAkaun, $mjaDigit, $mjaStatf, $mjaStcbk, $mjaSbkod, $mjaMesej)
  {
    if ($mjaTkhpl != null) {
      $mjaTkhplPg = str_replace("/", "-", $mjaTkhpl);
      $mjaTkhplPg = date("Y-m-d", strtotime($mjaTkhplPg));
    }

    if ($mjaTkhtk != null) {
      $mjaTkhtkPg = str_replace("/", "-", $mjaTkhtk);
      $mjaTkhtkPg = date("Y-m-d", strtotime($mjaTkhtkPg));
    }
    $mjaAkaun = empty($mjaAkaun) ? null : $mjaAkaun;
    $mjaNsiri = $this->generateSiriNo();
    $mjaDigit = empty($mjaDigit) ? 0 : $mjaDigit;
    $mjaStatf = empty($mjaStatf) ? null : $mjaStatf;
    $mjaStcbk = empty($mjaStcbk) ? "T" : $mjaStcbk;
    $mjaSbkod = empty($mjaSbkod) ? null : $mjaSbkod;
    $mjaMesej = empty($mjaMesej) ? null : $mjaMesej;
    $mjaHsiri = "0";
    $mjaTkpos = null;
    $mjaEtdate = date("Y-m-d");

    $database = Database::openConnection();
    $query = "INSERT INTO data.t_hacmja(mja_nsiri, mja_akaun, mja_digit, mja_tkhtk, mja_tkhpl, mja_onama, mja_sbkod, mja_mesej, mja_statf, mja_hsiri, mja_stcbk, mja_tkpos, mja_etdate) ";
    $query .= "VALUES(:mja_nsiri, :mja_akaun, :mja_digit, :mja_tkhtk, :mja_tkhpl, :mja_onama, :mja_sbkod, :mja_mesej, :mja_statf, :mja_hsiri, :mja_stcbk, :mja_tkpos, :mja_etdate)";
    $database->prepare($query);
    $database->bindValue(":mja_nsiri", $mjaNsiri);
    $database->bindValue(":mja_akaun", $mjaAkaun);
    $database->bindValue(":mja_digit", $mjaDigit);
    $database->bindValue(":mja_tkhtk", $mjaTkhtkPg);
    $database->bindValue(":mja_tkhpl", $mjaTkhplPg);
    $database->bindValue(":mja_onama", $workerId);
    $database->bindValue(":mja_sbkod", $mjaSbkod);
    $database->bindValue(":mja_mesej", $mjaMesej);
    $database->bindValue(":mja_statf", $mjaStatf);
    $database->bindValue(":mja_hsiri", $mjaHsiri);
    $database->bindValue(":mja_stcbk", $mjaStcbk);
    $database->bindValue(":mja_tkpos", $mjaTkpos);
    $database->bindValue(":mja_etdate", $mjaEtdate);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data hapus.");
    }

    if ($result) {
      $activity = "Jadual A : No akaun - " . $mjaAkaun . " No Siri - " . $mjaNsiri;
      $database->logActivity($userId, $activity);
    }
    return ["success" => true];
  }

  public function createB($userId, $workerId, $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbCodex, $mjbCodey, $mjbSbkod, $mjbMesej)
  {
    if ($mjbTkhpl != null) {
      $mjbTkhplPg = str_replace("/", "-", $mjbTkhpl);
      $mjbTkhplPg = date("Y-m-d", strtotime($mjbTkhplPg));
    }

    if ($mjbTkhtk != null) {
      $mjbTkhtkPg = str_replace("/", "-", $mjbTkhtk);
      $mjbTkhtkPg = date("Y-m-d", strtotime($mjbTkhtkPg));
    }

    $mjbNsiri = $this->generateSiriNo();
    $mjbAkaun = empty($mjbAkaun) ? "0" : $mjbAkaun;
    $mjbDigit = empty($mjbDigit) ? "0" : $mjbDigit;
    $mjbTkhpl = empty($mjbTkhpl) ? null : $mjbTkhplPg;
    $mjaTkhtk = empty($mjbTkhtk) ? null : $mjbTkhtkPg;
    $mjbThkod = empty($mjbThkod) ? "0" : $mjbThkod;
    $mjbBgkod = empty($mjbBgkod) ? "0" : $mjbBgkod;
    $mjbHtkod = empty($mjbHtkod) ? "0" : $mjbHtkod;
    $mjbStkod = empty($mjbStkod) ? "0" : $mjbStkod;
    $mjbJpkod = empty($mjbJpkod) ? "0" : $mjbJpkod;
    $mjbCodex = empty($mjbCodex) ? "0" : substr($mjbCodex, 0, 15);
    $mjbCodey = empty($mjbCodey) ? "0" : substr($mjbCodey, 0, 15);
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

    $query = "INSERT INTO data.t_hacmjb(mjb_nsiri, mjb_akaun, mjb_digit, mjb_tkhtk, mjb_tkhpl, mjb_thkod, mjb_htkod, mjb_jpkod, mjb_bgkod, mjb_stkod, ";
    $query .= "mjb_sbkod, mjb_mesej, mjb_statf, mjb_hsiri, mjb_stcbk, mjb_tkpos, mjb_onama, mjb_etdate) ";
    $query .= "VALUES(:mjb_nsiri, :mjb_akaun, :mjb_digit, :mjb_tkhtk, :mjb_tkhpl, :mjb_thkod, :mjb_htkod, :mjb_jpkod, :mjb_bgkod, :mjb_stkod, :mjb_sbkod, ";
    $query .= ":mjb_mesej, :mjb_statf, :mjb_hsiri, :mjb_stcbk, :mjb_tkpos, :mjb_onama, :mjb_etdate)";

    $database->prepare($query);
    $database->bindValue(":mjb_nsiri", $mjbNsiri);
    $database->bindValue(":mjb_akaun", $mjbAkaun);
    $database->bindValue(":mjb_digit", $mjbDigit);
    $database->bindValue(":mjb_tkhtk", $mjaTkhtk);
    $database->bindValue(":mjb_tkhpl", $mjbTkhpl);
    $database->bindValue(":mjb_thkod", $mjbThkod);
    $database->bindValue(":mjb_htkod", $mjbHtkod);
    $database->bindValue(":mjb_jpkod", $mjbJpkod);
    $database->bindValue(":mjb_bgkod", $mjbBgkod);
    $database->bindValue(":mjb_stkod", $mjbStkod);
    $database->bindValue(":mjb_sbkod", $mjbSbkod);
    $database->bindValue(":mjb_mesej", $mjbMesej);
    $database->bindValue(":mjb_statf", $mjbStatf);
    $database->bindValue(":mjb_hsiri", $mjbHsiri);
    $database->bindValue(":mjb_stcbk", $mjbStcbk);
    $database->bindValue(":mjb_tkpos", $mjbTkpos);
    $database->bindValue(":mjb_onama", $workerId);
    $database->bindValue(":mjb_etdate", $mjbEtdate);
    // $database->bindValue(":mjb_calcty", $calcType);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data pindaan.");
    }

    if ($result) {
      $activity = "Pindaan : No akaun - " . $mjbAkaun . " No Siri - " . $mjbNsiri;
      $database->logActivity($userId, $activity);
    }
    return ["success" => true, "sirino" => Encryption::encryptId($mjbNsiri)];
  }

  public function updateB($userId, $mjbNsiri, $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbSbkod, $mjbMesej)
  {
    if ($mjbTkhpl != null) {
      $mjbTkhplPg = str_replace("/", "-", $mjbTkhpl);
      $mjbTkhplPg = date("Y-m-d", strtotime($mjbTkhplPg));
    }

    if ($mjbTkhtk != null) {
      $mjbTkhtkPg = str_replace("/", "-", $mjbTkhtk);
      $mjbTkhtkPg = date("Y-m-d", strtotime($mjbTkhtkPg));
    }

    if ($mjbHtkod == "11" || $mjbHtkod == "12" || $mjbHtkod == "13" || $mjbHtkod == "14" || $mjbHtkod == "15" || $mjbHtkod == "28" || $mjbHtkod == "29" || $mjbHtkod == "30" || $mjbHtkod == "31" || $mjbHtkod == "32" || $mjbHtkod == "33" || $mjbHtkod == "34" || $mjbHtkod == "35") {
      $calcType = "1";
    } else {
      $calcType = "2";
    }

    $mjbNsiri = empty($mjbNsiri) ? "0" : $mjbNsiri;
    $mjbAkaun = empty($mjbAkaun) ? "0" : $mjbAkaun;
    $mjbDigit = empty($mjbDigit) ? "0" : $mjbDigit;
    $mjbTkhpl = empty($mjbTkhpl) ? null : $mjbTkhplPg;
    $mjaTkhtk = empty($mjbTkhtk) ? null : $mjbTkhtkPg;
    $mjbThkod = empty($mjbThkod) ? "0" : $mjbThkod;
    $mjbBgkod = empty($mjbBgkod) ? "0" : $mjbBgkod;
    $mjbHtkod = empty($mjbHtkod) ? "0" : $mjbHtkod;
    $mjbStkod = empty($mjbStkod) ? "0" : $mjbStkod;
    $mjbJpkod = empty($mjbJpkod) ? "0" : $mjbJpkod;
    $mjbCodex = empty($mjbCodex) ? "0" : $mjbCodex;
    $mjbCodey = empty($mjbCodey) ? "0" : $mjbCodey;
    $mjbSbkod = empty($mjbSbkod) ? null : $mjbSbkod;
    $mjbMesej = empty($mjbMesej) ? null : $mjbMesej;
    $mjbStcbk = empty($mjbStcbk) ? "T" : $mjbStcbk;
    $mjbStatf = null;
    $mjbHsiri = "0";
    $mjbTkpos = null;
    $mjbEtdate = date("Y-m-d");

    $database = Database::openConnection();

    $query = "UPDATE data.t_hacmjb SET mjb_tkhtk=:mjb_tkhtk, mjb_tkhpl=:mjb_tkhpl, mjb_thkod=:mjb_thkod, ";
    $query .= "mjb_htkod=:mjb_htkod, mjb_jpkod=:mjb_jpkod, mjb_bgkod=:mjb_bgkod, mjb_stkod=:mjb_stkod, mjb_sbkod=:mjb_sbkod, mjb_mesej=:mjb_mesej, mjb_statf=:mjb_statf, ";
    $query .= "mjb_hsiri=:mjb_hsiri, mjb_stcbk=:mjb_stcbk, mjb_tkpos=:mjb_tkpos, mjb_etdate=:mjb_etdate, mjb_calcty=:mjb_calcty ";
    $query .= "WHERE mjb_nsiri=:mjb_nsiri";

    $database->prepare($query);
    $database->bindValue(":mjb_nsiri", $mjbNsiri);
    $database->bindValue(":mjb_tkhtk", $mjaTkhtk);
    $database->bindValue(":mjb_tkhpl", $mjbTkhpl);
    $database->bindValue(":mjb_thkod", $mjbThkod);
    $database->bindValue(":mjb_htkod", $mjbHtkod);
    $database->bindValue(":mjb_jpkod", $mjbJpkod);
    $database->bindValue(":mjb_bgkod", $mjbBgkod);
    $database->bindValue(":mjb_stkod", $mjbStkod);
    $database->bindValue(":mjb_sbkod", $mjbSbkod);
    $database->bindValue(":mjb_mesej", $mjbMesej);
    $database->bindValue(":mjb_statf", $mjbStatf);
    $database->bindValue(":mjb_hsiri", $mjbHsiri);
    $database->bindValue(":mjb_stcbk", $mjbStcbk);
    $database->bindValue(":mjb_tkpos", $mjbTkpos);
    $database->bindValue(":mjb_etdate", $mjbEtdate);
    $database->bindValue(":mjb_calcty", $calcType);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk kemaskini data pindaan.");
    }

    if ($result) {
      $activity = "Kemaskini Pindaan : No akaun - " . $mjbAkaun . " No Siri - " . $mjbNsiri;
      $database->logActivity($userId, $activity);
    }
    return ["success" => true];
  }

  public function createPS($userId, $workerId, $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbSbkod, $mjbMesej)
  {
    if ($mjbTkhpl != null) {
      $mjbTkhplPg = str_replace("/", "-", $mjbTkhpl);
      $mjbTkhplPg = date("Y-m-d", strtotime($mjbTkhplPg));
    }

    if ($mjbTkhtk != null) {
      $mjbTkhtkPg = str_replace("/", "-", $mjbTkhtk);
      $mjbTkhtkPg = date("Y-m-d", strtotime($mjbTkhtkPg));
    }

    if ($mjbHtkod == "11" || $mjbHtkod == "12" || $mjbHtkod == "13" || $mjbHtkod == "14" || $mjbHtkod == "15" || $mjbHtkod == "28" || $mjbHtkod == "29" || $mjbHtkod == "30" || $mjbHtkod == "31" || $mjbHtkod == "32" || $mjbHtkod == "33" || $mjbHtkod == "34" || $mjbHtkod == "35") {
      $calcUrl = "calcrent";
      $calcType = "1";
    } else {
      $calcUrl = "calccost";
      $calcType = "2";
    }

    $mjbNsiri = $this->generateSiriNo();
    $mjbAkaun = empty($mjbAkaun) ? "0" : $mjbAkaun;
    $mjbDigit = empty($mjbDigit) ? "0" : $mjbDigit;
    $mjbTkhpl = empty($mjbTkhpl) ? null : $mjbTkhplPg;
    $mjaTkhtk = empty($mjbTkhtk) ? null : $mjbTkhtkPg;
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
    $mjbVerify = "0";
    $mjbVnama = null;
    $mjbVfdate = null;

    $database = Database::openConnection();
    $query = "INSERT INTO data.ps_hacmjb(mjb_nsiri, mjb_akaun, mjb_digit, mjb_tkhtk, mjb_tkhpl, mjb_thkod, mjb_htkod, mjb_jpkod, mjb_bgkod, mjb_stkod, ";
    $query .= "mjb_sbkod, mjb_mesej, mjb_statf, mjb_hsiri, mjb_stcbk, mjb_tkpos, mjb_onama, mjb_etdate, mjb_calcty) ";
    $query .= "VALUES(:mjb_nsiri, :mjb_akaun, :mjb_digit, :mjb_tkhtk, :mjb_tkhpl, :mjb_thkod, :mjb_htkod, :mjb_jpkod, :mjb_bgkod, :mjb_stkod, :mjb_sbkod, ";
    $query .= ":mjb_mesej, :mjb_statf, :mjb_hsiri, :mjb_stcbk, :mjb_tkpos, :mjb_onama, :mjb_etdate, :mjb_calcty)";

    $database->prepare($query);
    $database->bindValue(":mjb_nsiri", $mjbNsiri);
    $database->bindValue(":mjb_akaun", $mjbAkaun);
    $database->bindValue(":mjb_digit", $mjbDigit);
    $database->bindValue(":mjb_tkhtk", $mjaTkhtk);
    $database->bindValue(":mjb_tkhpl", $mjbTkhpl);
    $database->bindValue(":mjb_thkod", $mjbThkod);
    $database->bindValue(":mjb_htkod", $mjbHtkod);
    $database->bindValue(":mjb_jpkod", $mjbJpkod);
    $database->bindValue(":mjb_bgkod", $mjbBgkod);
    $database->bindValue(":mjb_stkod", $mjbStkod);
    $database->bindValue(":mjb_sbkod", $mjbSbkod);
    $database->bindValue(":mjb_mesej", $mjbMesej);
    $database->bindValue(":mjb_statf", $mjbStatf);
    $database->bindValue(":mjb_hsiri", $mjbHsiri);
    $database->bindValue(":mjb_stcbk", $mjbStcbk);
    $database->bindValue(":mjb_tkpos", $mjbTkpos);
    $database->bindValue(":mjb_onama", $workerId);
    $database->bindValue(":mjb_etdate", $mjbEtdate);
    $database->bindValue(":mjb_calcty", $calcType);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data nilaian semula.");
    }

    if ($result) {
      $activity = "Nilaian Semula : No akaun - " . $mjbAkaun . " No Siri - " . $mjbNsiri;
      $database->logActivity($userId, $activity);
    }
    return ["success" => true, "sirino" => Encryption::encryptId($mjbNsiri), "calcUrl" => $calcUrl];
  }

  public function getAccountInfoByAcct($fileId)
  {
    $dbOracle = new Oracle();
    $query = "SELECT v.*, h2.TNH_TNAMA,h3.HRT_HNAMA,h4.BGN_BNAMA,h5.STB_SNAMA FROM SPMC.V_HVNDUK v ";
    $query .= "LEFT JOIN SPMC.V_HTANAH h2 ON v.PEG_THKOD = h2.TNH_THKOD ";
    $query .= "LEFT JOIN SPMC.V_HHARTA h3 ON v.PEG_HTKOD = h3.HRT_HTKOD ";
    $query .= "LEFT JOIN SPMC.V_HBANGN h4 ON v.PEG_BGKOD = h4.BGN_BGKOD ";
    $query .= "LEFT JOIN SPMC.V_HSTBGN h5 ON v.PEG_STKOD = h5.STB_STKOD ";
    $query .= "WHERE v.PEG_AKAUN = :PEG_AKAUN ";
    $dbOracle->prepare($query);
    $dbOracle->bindValue(":PEG_AKAUN", Encryption::decryptId($fileId));
    $dbOracle->execute();

    $info = $dbOracle->fetchAssociative();
    return $info;
  }

  public function getAmendmentAccountInfo($fileId)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $id = Encryption::decryptId($fileId);
    $database->getById("data.smktpk", $id);
    $akaun = $database->fetchAssociative()['smk_akaun'];

    $query = "SELECT v.*, h2.TNH_TNAMA,h3.HRT_HNAMA,h4.BGN_BNAMA,h5.STB_SNAMA FROM SPMC.V_HVNDUK v ";
    $query .= "LEFT JOIN SPMC.V_HTANAH h2 ON v.PEG_THKOD = h2.TNH_THKOD ";
    $query .= "LEFT JOIN SPMC.V_HHARTA h3 ON v.PEG_HTKOD = h3.HRT_HTKOD ";
    $query .= "LEFT JOIN SPMC.V_HBANGN h4 ON v.PEG_BGKOD = h4.BGN_BGKOD ";
    $query .= "LEFT JOIN SPMC.V_HSTBGN h5 ON v.PEG_STKOD = h5.STB_STKOD ";
    $query .= "WHERE v.PEG_AKAUN = :PEG_AKAUN ";
    $dbOracle->prepare($query);
    $dbOracle->bindValue(":PEG_AKAUN", $akaun);
    $dbOracle->execute();

    $info = $dbOracle->fetchAssociative();
    return $info;
  }

  public function viewamendAdetail($siriNo)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $query = "SELECT a.*, u.name FROM data.t_hacmja a ";
    $query .= "LEFT JOIN public.users u ON a.mja_onama = u.workerid ";
    $query .= "WHERE a.mja_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    $rowOutput = [];
    $dbOracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $info["mja_akaun"]);
    $val = $dbOracle->fetchAssociative();
    $rowOutput["mja_nsiri"] = $info["mja_nsiri"];
    $rowOutput["mja_akaun"] = $info["mja_akaun"];
    $rowOutput["mja_digit"] = $info["mja_digit"];
    $rowOutput["mja_tkhtk"] = $this->dateFormat($info["mja_tkhtk"]);
    $rowOutput["mja_tkhpl"] = $this->dateFormat($info["mja_tkhpl"]);
    $rowOutput["mja_sbkod"] = $info["mja_sbkod"];
    $rowOutput["mja_mesej"] = $info["mja_mesej"];
    $rowOutput["mja_statf"] = $info["mja_statf"];
    $rowOutput["mja_hsiri"] = $info["mja_hsiri"];
    $rowOutput["mja_stcbk"] = $info["mja_stcbk"];
    $rowOutput["mja_tkpos"] = $info["mja_tkpos"];
    $rowOutput["mja_onama"] = $info["mja_onama"];
    $rowOutput["name"] = $info["name"];
    $rowOutput["tnh_tnama"] = $dbOracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["peg_thkod"]);
    $rowOutput["hrt_hnama"] = $dbOracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $val["peg_htkod"]);
    $rowOutput["bgn_bnama"] = $dbOracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $val["peg_bgkod"]);
    $rowOutput["stb_snama"] = $dbOracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $val["peg_stkod"]);
    $rowOutput["jpk_jnama"] = $dbOracle->getElementById("SPMC.V_HJENPK", "jpk_jnama", "jpk_jpkod", $val["peg_jpkod"]);
    $rowOutput["acm_sbktr"] = $dbOracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $info["mja_sbkod"]);
    $rowOutput["peg_oldac"] = $val["peg_oldac"];
    $rowOutput["pmk_nmbil"] = $val["pmk_nmbil"];
    $rowOutput["peg_nolot"] = $val["peg_nolot"];
    $rowOutput["jln_jnama"] = $val["jln_jnama"];
    $rowOutput["adpg1"] = $val["adpg1"];
    $rowOutput["adpg2"] = $val["adpg2"];
    $rowOutput["adpg3"] = $val["adpg3"];
    $rowOutput["adpg4"] = $val["adpg4"];
    $rowOutput["jln_knama"] = $val["jln_knama"];
    $rowOutput["kaw_kwkod"] = $val["kaw_kwkod"];
    $rowOutput["peg_codex"] = $val["peg_codex"];
    $rowOutput["peg_codey"] = $val["peg_codey"];
    $rowOutput["peg_nompt"] = $val["peg_nompt"];
    $rowOutput["peg_rjfil"] = $val["peg_rjfil"];
    $rowOutput["peg_pelan"] = $val["peg_pelan"];
    $rowOutput["pmk_hkmlk"] = $val["pmk_hkmlk"];
    $rowOutput["peg_bilpk"] = $val["peg_bilpk"];
    $rowOutput["peg_rjmmk"] = $val["peg_rjmmk"];
    $rowOutput["peg_lsbgn"] = $val["peg_lsbgn"];
    $rowOutput["peg_lstnh"] = $val["peg_lstnh"];
    $rowOutput["peg_lsans"] = $val["peg_lsans"];
    $rowOutput["peg_nilth"] = $val["peg_nilth"];
    $rowOutput["kaw_kadar"] = $val["kaw_kadar"];

    return $rowOutput;
  }

  public function viewamendBdetail($siriNo)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $query = "SELECT b.*, u.name FROM data.t_hacmjb b ";
    $query .= "LEFT JOIN public.users u ON b.mjb_onama = u.workerid ";
    $query .= "WHERE b.mjb_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    $rowOutput = [];
    $dbOracle->getByNoAcct("V_HVNDUK", "PEG_AKAUN", $info["mjb_akaun"]);
    $val = $dbOracle->fetchAssociative();
    $rowOutput["mjb_nsiri"] = $info["mjb_nsiri"];
    $rowOutput["mjb_akaun"] = $info["mjb_akaun"];
    $rowOutput["mjb_digit"] = $info["mjb_digit"];
    $rowOutput["mjb_tkhtk"] = $this->dateFormat($info["mjb_tkhtk"]);
    $rowOutput["mjb_tkhpl"] = $this->dateFormat($info["mjb_tkhpl"]);
    $rowOutput["mjb_thkod"] = $info["mjb_thkod"];
    $rowOutput["mjb_htkod"] = $info["mjb_htkod"];
    $rowOutput["mjb_jpkod"] = $info["mjb_jpkod"];
    $rowOutput["mjb_bgkod"] = $info["mjb_bgkod"];
    $rowOutput["mjb_stkod"] = $info["mjb_stkod"];
    $rowOutput["mjb_nilth"] = $info["mjb_nilth"];
    $rowOutput["mjb_bnilt"] = $info["mjb_bnilt"];
    $rowOutput["mjb_sbkod"] = $info["mjb_sbkod"];
    $rowOutput["mjb_mesej"] = $info["mjb_mesej"];
    $rowOutput["mjb_statf"] = $info["mjb_statf"];
    $rowOutput["mjb_hsiri"] = $info["mjb_hsiri"];
    $rowOutput["mjb_stcbk"] = $info["mjb_stcbk"];
    $rowOutput["mjb_nota"] = $info["mjb_nota"];
    $rowOutput["mjb_rujuk"] = $info["mjb_rujuk"];
    $rowOutput["mjb_disk"] = $info["mjb_disk"];
    $rowOutput["mjb_tkpos"] = $info["mjb_tkpos"];
    $rowOutput["mjb_onama"] = $info["mjb_onama"];
    $rowOutput["name"] = $info["name"];
    $rowOutput["acm_sbktr"] = $dbOracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $info["mjb_sbkod"]);
    $rowOutput["jpk_jnama"] = $dbOracle->getElementById("SPMC.V_HJENPK", "jpk_jnama", "jpk_jpkod", $info["mjb_jpkod"]);
    $rowOutput["peg_oldac"] = $val["peg_oldac"];
    $rowOutput["pmk_nmbil"] = $val["pmk_nmbil"];
    $rowOutput["peg_nolot"] = $val["peg_nolot"];
    $rowOutput["jln_jnama"] = $val["jln_jnama"];
    $rowOutput["adpg1"] = $val["adpg1"];
    $rowOutput["adpg2"] = $val["adpg2"];
    $rowOutput["adpg3"] = $val["adpg3"];
    $rowOutput["adpg4"] = $val["adpg4"];
    $rowOutput["jln_knama"] = $val["jln_knama"];
    $rowOutput["kaw_kwkod"] = $val["kaw_kwkod"];
    $rowOutput["peg_codex"] = $val["peg_codex"];
    $rowOutput["peg_codey"] = $val["peg_codey"];
    $rowOutput["peg_nompt"] = $val["peg_nompt"];
    $rowOutput["peg_rjfil"] = $val["peg_rjfil"];
    $rowOutput["peg_pelan"] = $val["peg_pelan"];
    $rowOutput["pmk_hkmlk"] = $val["pmk_hkmlk"];
    $rowOutput["peg_bilpk"] = $val["peg_bilpk"];
    $rowOutput["peg_rjmmk"] = $val["peg_rjmmk"];
    $rowOutput["peg_lsbgn"] = $val["peg_lsbgn"];
    $rowOutput["peg_lstnh"] = $val["peg_lstnh"];
    $rowOutput["peg_lsans"] = $val["peg_lsans"];
    $rowOutput["tnama"] = $dbOracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["peg_thkod"]);
    $rowOutput["hnama"] = $dbOracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $val["peg_htkod"]);
    $rowOutput["bnama"] = $dbOracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $val["peg_bgkod"]);
    $rowOutput["snama"] = $dbOracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $val["peg_stkod"]);

    return $rowOutput;
  }

  public function viewamendCdetail($siriNo)
  {
    $database = Database::openConnection();
    $dbOracle = new Oracle();

    $rowOutput = [];

    $query = "SELECT c.* FROM data.t_hacmjc c ";
    $query .= "WHERE c.mjc_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $val = $database->fetchAssociative();

    $dbOracle->getInfoByTwoColumn("V_PLNGAN", "pid_plgid", "val_amtid", $val["mjc_plgid"], $val["mjc_amtid"]);
    $almt = $dbOracle->fetchAssociative();

    $rowOutput["mjc_nsiri"] = $val["mjc_nsiri"];
    $rowOutput["mjc_akaun"] = $val["mjc_akaun"];
    $rowOutput["mjc_tkhpl"] = $val["mjc_tkhpl"];
    $rowOutput["mjc_tkhtk"] = $val["mjc_tkhtk"];
    $rowOutput["mjc_htkod"] = $val["mjc_htkod"];
    $rowOutput["mjc_nolot"] = $val["mjc_nolot"];
    $rowOutput["mjc_nompt"] = $val["mjc_nompt"];
    $rowOutput["mjc_nmbil"] = $val["mjc_nmbil"];
    $rowOutput["mjc_plgid"] = $val["mjc_plgid"];
    $rowOutput["mjc_adpg1"] = $val["mjc_adpg1"];
    $rowOutput["mjc_adpg2"] = $val["mjc_adpg2"];
    $rowOutput["adpg3"] = "";
    $rowOutput["adpg4"] = "";
    $rowOutput["almt1"] = $almt["val_almt1"];
    $rowOutput["almt2"] = $almt["val_almt2"];
    $rowOutput["almt3"] = $almt["val_almt3"];
    $rowOutput["almt4"] = $almt["val_almt4"];
    $rowOutput["almt5"] = $almt["val_almt5"];
    $rowOutput["mjc_jlkod"] = $val["mjc_jlkod"];
    $rowOutput["mjc_thkod"] = $val["mjc_thkod"];
    $rowOutput["mjc_htkod"] = $val["mjc_htkod"];
    $rowOutput["mjc_bgkod"] = $val["mjc_bgkod"];
    $rowOutput["mjc_stkod"] = $val["mjc_stkod"];
    $rowOutput["mjc_jpkod"] = $val["mjc_jpkod"];
    $rowOutput["mjc_lsbgn"] = $val["mjc_lsbgn"];
    $rowOutput["mjc_lstnh"] = $val["mjc_lstnh"];
    $rowOutput["mjc_lsans"] = $val["mjc_lsans"];
    $rowOutput["mjc_codex"] = $val["mjc_codex"];
    $rowOutput["mjc_codey"] = $val["mjc_codey"];
    $rowOutput["mjc_diskn"] = $val["mjc_diskn"];
    $rowOutput["mjc_smpah"] = $val["mjc_smpah"];
    $rowOutput["mjc_rjfil"] = $val["mjc_rjfil"];
    $rowOutput["mjc_pelan"] = $val["mjc_pelan"];
    $rowOutput["mjc_bilpk"] = $val["mjc_bilpk"];
    $rowOutput["mjc_rjmmk"] = $val["mjc_rjmmk"];
    $rowOutput["mjc_stcbk"] = $val["mjc_stcbk"];
    $rowOutput["mjc_sbkod"] = $val["mjc_sbkod"];
    $rowOutput["mjc_mesej"] = $val["mjc_mesej"];
    $rowOutput["mjc_nota"] = $val["mjc_nota"];
    $rowOutput["acm_sbktr"] = $dbOracle->getElementById("SPMC.V_ACMRSN", "acm_sbktr", "acm_sbkod", $val["mjc_sbkod"]);
    $rowOutput["jln_nama"] = $dbOracle->getElementById("SPMC.V_MKWJLN", "jln_jnama", "jln_jlkod", $val["mjc_jlkod"]);
    $rowOutput["kws_kwkod"] = $dbOracle->getElementById("SPMC.V_MKWJLN", "kws_kwkod", "jln_jlkod", $val["mjc_jlkod"]);
    $rowOutput["kws_nama"] = $dbOracle->getElementById("SPMC.V_MKWJLN", "kws_knama", "jln_jlkod", $val["mjc_jlkod"]);
    $rowOutput["tnama"] = $dbOracle->getElementById("SPMC.V_HTANAH", "tnh_tnama", "tnh_thkod", $val["mjc_thkod"]);
    $rowOutput["hnama"] = $dbOracle->getElementById("SPMC.V_HHARTA", "hrt_hnama", "hrt_htkod", $val["mjc_htkod"]);
    $rowOutput["bnama"] = $dbOracle->getElementById("SPMC.V_HBANGN", "bgn_bnama", "bgn_bgkod", $val["mjc_bgkod"]);
    $rowOutput["snama"] = $dbOracle->getElementById("SPMC.V_HSTBGN", "stb_snama", "stb_stkod", $val["mjc_stkod"]);
    $rowOutput["jnama"] = $dbOracle->getElementById("SPMC.V_HJENPK", "jpk_jnama", "jpk_jpkod", $val["mjc_jpkod"]);
    $rowOutput["mjc_nilth"] = $val["mjc_nilth"];

    return $rowOutput;
  }

  public function viewamendPSdetail($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT ps.*, s.*, v.smk_lsbgn_tmbh, v.smk_lsans_tmbh, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM data.v_hacmjb ps ";
    $query .= "LEFT JOIN data.v_semak v ON ps.mjb_akaun = v.smk_akaun ";
    $query .= "WHERE ps.mjb_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function getSumbangan($jpkod)
  {

    $dbOracle = new Oracle();
    $query = "SELECT * FROM V_HJENPK ";
    $query .= "WHERE jpk_jpkod = :jpk_jpkod";
    $dbOracle->prepare($query);
    $dbOracle->bindValue(":jpk_jpkod", $jpkod);
    $dbOracle->execute();
    $info = $dbOracle->fetchAllAssociative();

    return $info;
  }

  public function checkEmptyLand($id)
  {
    $dbOracle = new Oracle();

    $query = "SELECT hrt_hnama FROM SPMC.V_HHARTA WHERE hrt_htkod = :id";

    $dbOracle->prepare($query);
    $dbOracle->bindValue(":id", $id);
    $dbOracle->execute();
    $info = $dbOracle->fetchAssociative();
    if (strpos($info['hrt_hnama'], 'KOSONG')) {
      return true;
    } else {
      return false;
    }
  }

  public function getCalculationInfo($siriNo)
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $query = "SELECT distinct c.*, v.entry, v.entry_pos, v.verifier, v.verifier_pos, to_char(v.etdate, 'DD/MM/YYYY') as etdate, to_char(v.vfdate, 'DD/MM/YYYY') as vfdate ";
    $query .= "FROM data.calculator c ";
    $query .= "INNER JOIN data.v_submitioninfo v ON c.siri_no = v.no_siri ";
    $query .= "WHERE c.siri_no = :siri_no";
    $database->prepare($query);
    $database->bindValue(":siri_no", Encryption::decryptId($siriNo));
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $rowOutput = [];
    foreach ($rows as $val) {
      if (!empty($val["compare"]) && $val["compare"] != null && $val["compare"] != "{}") {
        $rowOutput["compare"] = $this->getCompare($val["compare"]);
      } else {
        $rowOutput["compare"] = "";
      }

      $rowOutput["calc_type"] = $val["calc_type"];
      $rowOutput["siri_no"] = $val["siri_no"];
      $rowOutput["acct_no"] = $val["acct_no"];
      $rowOutput["land"] = $this->getLand($val["land"]);
      if ($val["calc_type"] == 2) {
        $rowOutput["main"] = $this->getMain(Encryption::decryptId($siriNo), $val["section"], $val["main"]);
      } else {
        $rowOutput["main"] = $this->getItemsMain($val["main"]);
        $rowOutput["out"] = $this->getItemsOut($val["out"]);
      }
      $rowOutput["moverall"] = $val["moverall"];
      $rowOutput["capital_rental"] = $val["capital_rental"];
      $rowOutput["corner"] = $val["corner"];
      $rowOutput["yearly"] = $val["yearly"];
      $rowOutput["round"] = $val["round"];
      $rowOutput["rate"] = $val["rate"];
      $rowOutput["tax"] = $val["tax"];

      $rowOutput["clerk"] = $val["entry"];
      $rowOutput["clerk_pos"] = $val["entry_pos"];
      $rowOutput["verifier"] = $this->checkNull($val["verifier"]);
      $rowOutput["verifier_pos"] = $this->checkNull($val["verifier_pos"]);
      $rowOutput["etdate"] = $val["etdate"];
      $rowOutput["vfdate"] = $this->checkNull($val["vfdate"]);
    }

    return $rowOutput;
  }

  public function getCompare($comparison)
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $output = [];
    $rowOutput = [];

    $dataList = substr($comparison, 1, -1);
    $result = $dataList ? explode(',', $dataList) : array();
    $integers = array_map('intval', $result);
    foreach ($integers as $value) {
      $query = "SELECT r.id, r.akaun, r.mfa, r.afa, DATE_PART('Year', r.date) as year FROM data.v_rating r ";
      $query .= "WHERE r.id = :id";
      $database->prepare($query);
      $database->bindValue(":id", $value);
      $database->execute();
      $row = $database->fetchAssociative();

      $rowOutput["id"] = $row["id"];
      $rowOutput["mfa"] = $this->checkNull($row["mfa"]);
      $rowOutput["afa"] = $this->checkNull($row["afa"]);
      // $rowOutput["bgn_bnama"] = $row["bgn_bnama"];
      $rowOutput["year"] = $row["year"];

      if ($row) {
        $qry  = "SELECT jln_jnama, peg_lsbgn, peg_lstnh, peg_nilth FROM SPMC.V_HVNDUK WHERE peg_akaun = " . $row['akaun'];
        $dboracle->prepare($qry);
        $dboracle->execute();
        $res = $dboracle->fetchAssociative();

        $rowOutput["jln_jnama"] = $res["jln_jnama"];
        $rowOutput["peg_lsbgn"] = $res["peg_lsbgn"];
        $rowOutput["peg_lstnh"] = $res["peg_lstnh"];
        $rowOutput["peg_nilth"] = $res["peg_nilth"];
      }
      array_push($output, $rowOutput);
    }
    return $output;
  }

  public function getLand($landId)
  {
    $database = Database::openConnection();
    $query = "SELECT * FROM data.items_land ";
    $query .= "WHERE id = :id ";
    $database->prepare($query);
    $database->bindValue(":id", $landId);
    $database->execute();
    $rows = $database->fetchAssociative();

    return $rows;
  }

  public function getMain($siriNo, $mainId)
  {
    $database = Database::openConnection();

    $output = [];
    $rowOutput = [];

    $query = "SELECT * FROM data.section ";
    $query .= "WHERE siri_no = '" . $siriNo . "'";
    $database->prepare($query);
    $database->execute();

    if ($database->countRows() >= 1) {
      foreach ($database->fetchAllAssociative() as $row) {
        $rowOutput["id"] = $row["id"];
        $rowOutput["title"] = $row["title"];
        $rowOutput["total"] = $row["total"];
        $rowOutput["adjust"] = $row["adjust"];
        $rowOutput["items"] = $this->itemsMain($row['id'], "");
        array_push($output, $rowOutput);
      }
    } else {
      $rowOutput["id"] = 0;
      $rowOutput["title"] = "";
      $rowOutput["total"] = 0;
      $rowOutput["adjust"] = 0;
      $rowOutput["items"] = $this->itemsMain("", $mainId);
      array_push($output, $rowOutput);
    }
    return $output;
  }

  public function itemsMain($sectionId = "", $mainId = "")
  {
    $database = Database::openConnection();

    $output = [];
    $rowOutput = [];

    if (empty($sectionId) && !empty($mainId)) {
      $dataList = substr($mainId, 1, -1);
      $result = $dataList ? explode(',', $dataList) : array();
      $integers = array_map('intval', $result);

      foreach ($integers as $value) {
        $query = "SELECT id, title, breadth, breadthtype, price, pricetype, total FROM data.items_main ";
        $query .= "WHERE id = :id ";
        $database->prepare($query);
        $database->bindValue(":id", $value);
        $database->execute();
        $row = $database->fetchAssociative();

        $rowOutput["id"] = $row["id"];
        $rowOutput["title"] = $row["title"];
        $rowOutput["breadth"] = $row["breadth"];
        $rowOutput["breadthtype"] = $row["breadthtype"];
        $rowOutput["price"] = $row["price"];
        $rowOutput["pricetype"] = $row["pricetype"];
        $rowOutput["total"] = $row["total"];
        array_push($output, $rowOutput);
      }
    }

    if (!empty($sectionId) && empty($mainId)) {
      $query = "SELECT id, title, breadth, breadthtype, price, pricetype, total FROM data.items_main ";
      $query .= "WHERE section_id = :section_id";
      $database->prepare($query);
      $database->bindValue(":section_id", $sectionId);
      $database->execute();
      $rows = $database->fetchAllAssociative();

      foreach ($rows as $row) {
        $rowOutput["id"] = $row["id"];
        $rowOutput["title"] = $row["title"];
        $rowOutput["breadth"] = $row["breadth"];
        $rowOutput["breadthtype"] = $row["breadthtype"];
        $rowOutput["price"] = $row["price"];
        $rowOutput["pricetype"] = $row["pricetype"];
        $rowOutput["total"] = $row["total"];
        array_push($output, $rowOutput);
      }
    }

    return $output;
  }

  public function getItemsMain($itemId)
  {
    $database = Database::openConnection();

    $output = [];
    $rowOutput = [];

    $dataList = substr($itemId, 1, -1);
    $integers = array_map('intval', explode(',', $dataList));
    foreach ($integers as $value) {
      $query = "SELECT id, title, breadth, breadthtype, price, pricetype, total FROM data.items_main ";
      $query .= "WHERE id = :id ";
      $database->prepare($query);
      $database->bindValue(":id", $value);
      $database->execute();
      $row = $database->fetchAssociative();

      $rowOutput["id"] = $row["id"];
      $rowOutput["title"] = $row["title"];
      $rowOutput["breadth"] = $row["breadth"];
      $rowOutput["breadthtype"] = $row["breadthtype"];
      $rowOutput["price"] = $row["price"];
      $rowOutput["pricetype"] = $row["pricetype"];
      $rowOutput["total"] = $row["total"];
      array_push($output, $rowOutput);
    }

    return $output;
  }

  public function getItemsOut($itemId)
  {
    $database = Database::openConnection();

    $output = [];
    $rowOutput = [];

    $dataList = substr($itemId, 1, -1);
    $integers = array_map('intval', explode(',', $dataList));
    foreach ($integers as $value) {
      $query = "SELECT id, title, breadth, breadthtype, price, pricetype, total FROM data.items_out ";
      $query .= "WHERE id = :id ";
      $database->prepare($query);
      $database->bindValue(":id", $value);
      $database->execute();
      $row = $database->fetchAssociative();

      $rowOutput["id"] = $row["id"];
      $rowOutput["title"] = $row["title"];
      $rowOutput["breadth"] = $row["breadth"];
      $rowOutput["breadthtype"] = $row["breadthtype"];
      $rowOutput["price"] = $row["price"];
      $rowOutput["pricetype"] = $row["pricetype"];
      $rowOutput["total"] = $row["total"];
      array_push($output, $rowOutput);
    }

    return $output;
  }
}
