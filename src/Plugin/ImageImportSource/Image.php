<?php

namespace Drupal\image_import\Plugin\ImageImportSource;

use Drupal\Core\File\FileSystemInterface;
use Drupal\image_import\ImageImportSourceBase;
use Drupal\media\MediaInterface;

/**
 * Image
 *
 * @author Attila Németh
 * 04.03.2021
 * 
 * @ImageImportSource(
 *  id = "image",
 *  label = @Translation("Image")
 * )
 */
class Image extends ImageImportSourceBase {
  
  /**
   * Whether this plugin is applicable for the URL
   * @return bool
   */
  public function isApplicable(): bool
  {
    $this->_fetch();
    $contentType = $this->_getHeader('Content-Type');
    if (preg_match('/^image/', $contentType[0])) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
  
  /**
   * Create the media
   * @return MediaInterface
   */
  public function createMedia(): MediaInterface
  {
    if ($fileDir = $this->_getFileDir()) {
      $file = system_retrieve_file($this->configuration['url'], $fileDir, TRUE, FileSystemInterface::EXISTS_RENAME);
      $values = [
        'name' => $this->configuration['url'],
        'bundle' => 'image',
        'field_media_image' => [
          'entity' => $file,
        ],
        'thumbnail' => [
          'entity' => $file,
        ],
        'source' => [
          'uri' => $this->configuration['url'],
          'title' => $this->configuration['url'],
        ],
      ];
      $media = \Drupal::entityTypeManager()->getStorage('media')->create($values);
      $media->save();
      return $media;
    }
  }
  
}
