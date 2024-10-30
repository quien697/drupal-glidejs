<?php

namespace Drupal\glide\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\media\Entity\Media;

/**
 * Plugin implementation of the 'custom_image_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "glide_video",
 *   label = @Translation("Glide Video"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class GlideVideoFormatter extends FormatterBase {

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        $summary[] = $this->t('Displays the Video slider.');
        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode): array {
        $elements = [
            '#theme' => 'glide_video',                      // Specifies the template to use
            '#items' => [],                                 // Data to pass to the template
            '#render element' => 'items',
            '#attached' => [
                'library' => [ 'glide/glidejs--glide', ],   // Attaches the custom JS/CSS library.
            ],
        ];

        foreach ($items as $item) {
            $media = Media::load($item->target_id);

            if ($media) {
                $media_type = $media->bundle();
                $video_url = '';

                // Check if the media type is "video" or "remote_video".
                if ($media_type === 'video') {
                    $file = $media->get('field_media_video_file')->entity;
                    $video_url = $file ? $file->getFileUri() : '';
                } elseif ($media_type === 'remote_video') {
                    $video_url = $media->get('field_media_oembed_video')->value;
                }

                $elements['#items'][] = [
                    'url' => $this->generateYouTubeEmbedUrl($video_url),
                    'loading' => "lazy",
                ];
            }
        }

        return $elements;
    }

    /**
     * Helper function to convert YouTube URL to embed URL.
     */
    protected function generateYouTubeEmbedUrl($video_url): string {
        $parsed_url = parse_url($video_url);
        parse_str($parsed_url['query'], $query_params);

        if (isset($query_params['v'])) {
            $video_id = $query_params['v'];
            return 'https://www.youtube.com/embed/' . $video_id;
        }

        return $video_url;
    }

}