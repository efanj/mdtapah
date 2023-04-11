<?php

class Verified extends Model
{
  public function escapeJsonString($value)
  {
    # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = ["\""];
    $replacements = [""];
    $result = str_replace($escapers, $replacements, $value);
    return $result;
  }

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

  public function checkNullNumber($data)
  {
    if ($data == null || $data == "") {
      return 0;
    } else {
      return $data;
    }
  }
}