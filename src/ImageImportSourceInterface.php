<?php

namespace Drupal\image_import;

use Drupal\media\MediaInterface;

/**
 * Image Import Source Plugin Interface
 *
 * @author Attila Németh
 * @date 04.03.2021
 */
interface ImageImportSourceInterface {
  
  /**
   * Whether this plugin is applicable for the URL
   * @return bool
   */
  public function isApplicable(): bool;
  
  /**
   * Create the media
   * @return MediaInterface
   */
  public function createMedia(): MediaInterface;

}