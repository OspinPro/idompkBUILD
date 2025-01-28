<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Map_item".
 *
 * @property integer $id
 * @property string $name
 * @property string $coordinates
 * @property string $region
 * @property string $images
 * @property string $video
 */
class MapItem extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'Map_item';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name','coordinates','region','images','video'], 'safe']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID'
    ];
  }


  public static function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 51) {
    if (!file_exists($src)) {
      return false;
    }
    $size = getimagesize($src);

    if ($size === false) {
      return false;
    }

    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = 'imagecreatefrom'.$format;
    if (!function_exists($icfunc)) {
      return false;
    }

    $x_ratio = $width  / $size[0];
    $y_ratio = $height / $size[1];

    if ($height == 0) {

      $y_ratio = $x_ratio;
      $height  = $y_ratio * $size[1];

    } elseif ($width == 0) {

      $x_ratio = $y_ratio;
      $width   = $x_ratio * $size[0];

    }

    $ratio       = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

    $isrc  = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);

    imagefill($idest, 0, 0, $rgb);

    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

    imagejpeg($idest, $dest, $quality);

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
  }

  public static function CreateStamp($img1,$imag2)
  {


    $stamp = imagecreatefrompng($img1);
    $image_info = getimagesize($imag2);


    $format = strtolower(substr($image_info['mime'],strpos($image_info['mime'], '/') + 1));

    $im_cr_func = "imagecreatefrom" . $format;
    $im_cr_func0 = "image" . $format;

    //$im0 = imagecreatetruecolor($image_info[0], $image_info[1]);
    //imagefill($im0, 0, 0, 0xFFFFFF);

    $im = $im_cr_func($imag2);

    if ($format == 'png') {
      $bg = imagecreatetruecolor(imagesx($im), imagesy($im));
      imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
      imagealphablending($bg, TRUE);
      imagecopy($bg, $im, 0, 0, 0, 0, imagesx($im), imagesy($im));
      imagejpeg($bg, $imag2);

      imagecopy($bg, $stamp, imagesx($bg)/2-(imagesx($stamp)/2), imagesy($bg)/2-(imagesy($stamp)/2), 0, 0, imagesx($stamp), imagesy($stamp));

      imagejpeg($bg, $imag2);
      imagedestroy($bg);
    } else {

      imagecopy($im, $stamp, imagesx($im)/2-(imagesx($stamp)/2), imagesy($im)/2-(imagesy($stamp)/2), 0, 0, imagesx($stamp), imagesy($stamp));

      imagejpeg($im, $imag2);
      imagedestroy($im);
    }


  }
}
