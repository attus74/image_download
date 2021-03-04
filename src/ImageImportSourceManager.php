<?php

namespace Drupal\image_import;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Image Import Source Plugin Manager 
 *
 * @author Attila Németh
 * @date 04.03.2021
 */
class ImageImportSourceManager extends DefaultPluginManager {

  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/ImageImportSource',
      $namespaces,
      $module_handler,
      'Drupal\image_import\ImageImportSourceInterface',
      'Drupal\image_import\Annotation\ImageImportSource'
    );
    $this->alterInfo('image_import_source_info');
    $this->setCacheBackend($cache_backend, 'image_import_source_plugins');
  }

}