<?php

namespace Drupal\image_import;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\File\FileSystemInterface;
use Drupal\image_import\ImageImportSourceInterface;

/**
 * Image Import Source Base Class
 *
 * @author Attila Németh
 * @date 04.03.2021
 */
abstract class ImageImportSourceBase extends PluginBase implements ImageImportSourceInterface {
  
  // Response from the URL
  private       $_response;
  
  // File Scheme. At the moment it's always public.
  private       $_scheme                      = 'public://';

  /**
   * Fetch the URL
   */
  protected function _fetch()
  {
    $this->_response = \Drupal::httpClient()->get($this->configuration['url']);
  }

  /**
   * One header element of the URL
   * @param string $name
   *  Header name, e.g. Content-Type
   * @return array
   */
  protected function _getHeader(string $name): array
  {
    $header = $this->_response->getHeader($name);
    if (is_array($header)) {
      return $header;
    }
    else {
      var_dump($header);
      die();
    }
  }
  
  /**
   * Body of the URL response
   * @return string
   */
  protected function _getBody(): string
  {
    return (string)$this->_response->getBody();
  }
  
  /**
   * Directory for saving the file
   * @return string
   */
  protected function _getFileDir(): string
  {
    $dir = $this->_scheme . 'image_import/' . $this->getPluginId() . '/' . date('Y') . '/' . date('m-d');
    $result = \Drupal::service('file_system')
        ->prepareDirectory($dir, FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS);
    if ($result) {
      return $dir;
    }
    else {
      var_dump($result);
      die();
    }
  }
  
}