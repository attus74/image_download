<?php

namespace Drupal\image_import\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Image Import Source Annotation
 *
 * @author Attila Németh
 * @date 04.03.2021
 *
 * @Annotation
 */
class ImageImportSource extends Plugin {

  // Plugin ID
  public $id;

  // Plugin Label
  public $label;

}