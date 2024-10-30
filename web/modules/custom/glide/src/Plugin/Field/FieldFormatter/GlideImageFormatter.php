<?php

namespace Drupal\glide\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'custom_image_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "glide_image",
 *   label = @Translation("Glide Image"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class GlideImageFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t('Displays the image slider.');
        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode): array {
        $elements = [
            '#theme' => 'glide_image',                      // Specifies the template to use
            '#items' => [],                                 // Data to pass to the template
            '#render element' => 'items',
            '#attached' => [
                'library' => [ 'glide/glidejs--glide', ],   // Attaches the custom JS/CSS library.
            ],
        ];

        foreach ($items as $item) {
            $elements['#items'][] = [
                'url' => $item->entity->getFileUri(),
                'alt' => $item->alt,
                'loading' => "lazy",
                'width' => $item->width,
                'height' => $item->height,
                '#attributes' => [
                    'class' => ['img-fluid'],
                ],
            ];
        }

        return $elements;
    }

}