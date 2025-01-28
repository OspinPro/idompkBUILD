<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "Baza_znanij_articles".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $link_title
 * @property string $crumbs_title
 * @property string $link_url
 * @property string $content
 * @property string $title
 * @property string $description
 * @property string $img_preview
 * @property string $date_create
 * @property string $date_update
 */
class BazaZnanijArticles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Baza_znanij_articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'link_title', 'link_url', 'content'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'description', 'date_create', 'date_update'], 'string'],
            [['link_title', 'crumbs_title', 'link_url', 'title', 'img_preview'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'link_title' => 'Link Title',
            'crumbs_title' => 'Crumbs Title',
            'link_url' => 'Link Url',
            'content' => 'Content',
            'title' => 'Title',
            'description' => 'Description',
            'img_preview' => 'Img Preview',
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

    $mimeType = FileHelper::getMimeType($src);

    $format = substr($mimeType,strrpos($mimeType,"/")+1);
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

    $mimeType = FileHelper::getMimeType($imag2);

    $format = substr($mimeType,strrpos($mimeType,"/")+1);

    $im_cr_func = "imagecreatefrom" . $format;
    $im_cr_func0 = "image" . $format;

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
