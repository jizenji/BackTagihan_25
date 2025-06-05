<?php
// include_once '../koneksi.php';

function xssafe($data,$encoding='UTF-8')
{
   return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
}


function time_since($original)
{
  date_default_timezone_set('Asia/Jakarta');
  $chunks = array(
      array(60 * 60 * 24 * 365, 'tahun'),
      array(60 * 60 * 24 * 30, 'bulan'),
      array(60 * 60 * 24 * 7, 'minggu'),
      array(60 * 60 * 24, 'hari'),
      array(60 * 60, 'jam'),
      array(60, 'menit'),
  );
 
  $today = time();
  $since = $today - $original;
 
  if ($since > 604800)
  {
    $print = date("M jS", $original);
    if ($since > 31536000)
    {
      $print .= ", " . date("Y", $original);
    }
    return $print;
  }
 
  for ($i = 0, $j = count($chunks); $i < $j; $i++)
  {
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
 
    if (($count = floor($since / $seconds)) != 0)
      break;
  }
 
  $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
  return $print . ' yang lalu';
}

function status($status){
  switch ($status){
    case "Y":
      return "<button class='btn btn-success btn-sm' title='Verified' style='border-radius:30%;width:30px;'><i class='fas fa-check'></i></button>";
      break;
    case "N":
      return "<button class='btn btn-warning btn-sm'>UnVerified</button>";
      break;
    default:
      return "aktif";
      break;
    }
  }


function statusSekarang($status){

    switch ($status){
      case "N":
        return "UnVerified";
        break;
      case "Y":
        return "Verified";
      default:
        return "aktif";
        break;
    }
  }

function getKelasX($status){
  switch ($status) {
    case '1':
      return "X-RPL";
      break;
    case '2':
      return "X-TKJ";
      break;
    case '3':
      return "X-MM-I";
      break;
    case '4':
      return "X-MM-II";
      break;
    case '5':
        return 'XI-MM-I';
        break;
    case '6':
        return 'XI-MM-II';
        break;
    case '7':
        return 'XI-RPL';
        break;
    case '8';
        return 'XI-TKJ';
    case '9':
        return 'XII-RPL';
        break;
    case '10':
        return 'XII-TKJ';
        break;
    case '11':
        return 'XII-MM-I';
        break;
    case '12':
        return 'XII-MM-II';
        break;
    default:
      return "TIDAK DITEMUKAN KELAS";
      break;
  }
}

?>
