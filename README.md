# Image Import

A Drupal 8/9 module for importing images to media from external sources. 
The module provides a plugin that may be applied by other modules. A basic plugin, for simply image URLs, 
is included.

## Plugin Usage

```php
namespace Drupal\mymodule\Plugin\ImageImportSource;

use Drupal\Core\File\FileSystemInterface;
use Drupal\image_import\ImageImportSourceBase;
use Drupal\media\MediaInterface;

/**
 * My Plugin Name
 * 
 * @ImageImportSource(
 *  id = "myplugin",
 *  label = @Translation("My Plugin")
 * )
 */
class MyPlugin extends ImageImportSourceBase {
  
  /**
   * {@inheritdoc}
   */
  public function isApplicable(): bool
  {
    if ($this->_checkThisUrl($this->configuration['url']) {
      return TRUE;
    }
    else {
    return FALSE;
  }
  
  /**
   * {@inheritdoc}
   */
  public function createMedia(): MediaInterface
  {
    if ($fileDir = $this->_getFileDir()) {
      $file = $this->_doSomething($this->configuration['url']);
      $values = [
        'name' => 'My Name',
        'bundle' => 'image',
        'field_media_image' => [
          'entity' => $file,
        ],
        'thumbnail' => [
          'entity' => $file,
        ],
        'source' => [
          'uri' => $imageSourceUrl,
          'title' => $imageSourceName
        ],
      ];
      $media = \Drupal::entityTypeManager()->getStorage('media')->create($values);
      $media->save();
      return $media;
    }
  }
  
}
```
