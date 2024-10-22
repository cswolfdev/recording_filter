<?php

// File: src/Controller/RecordingFilterController.php

namespace Drupal\recording_filter\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the autocomplete functionality.
 */
class RecordingFilterController extends ControllerBase {

  /**
   * Autocomplete callback for songs.
   */
  public function autocompleteSongs(Request $request, $artist_id) {
    \Drupal::logger('recording_filter')->notice('Autocomplete callback triggered for artist ID: @artist_id', ['@artist_id' => $artist_id]);

    $matches = [];
    $query = $request->query->get('q');
    \Drupal::logger('recording_filter')->notice('Query: @query', ['@query' => $query]);

    $songs = recording_filter_get_songs_by_artist($artist_id);

    foreach ($songs as $nid => $title) {
      if (stripos($title, $query) !== FALSE) {
        $matches[] = ['value' => $title, 'label' => $title];
      }
    }

    \Drupal::logger('recording_filter')->notice('Filtered Songs: @songs', ['@songs' => print_r($matches, TRUE)]);

    return new JsonResponse($matches);
  }

}
