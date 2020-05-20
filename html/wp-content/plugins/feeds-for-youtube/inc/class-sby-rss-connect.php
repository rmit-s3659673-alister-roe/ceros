<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SBY_RSS_Connect
{
	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var object
	 */
	private $response;

	public function __construct( $endpoint = '', $params = array() ) {
		$this->set_url( $endpoint, $params );
	}

	public function get_data() {
		return $this->response;
	}

	public function set_url_from_args( $url ) {
		$this->url = $url;
	}

	public function get_url() {
		return $this->url;
	}

	public function connect() {
		$args = array(
			'timeout' => 60,
			'sslverify' => false
		);
		$response = wp_remote_get( esc_url_raw( $this->url ), $args );

		if ( ! is_wp_error( $response ) ) {
			// certain ways of representing the html for double quotes causes errors so replaced here.
			$response = $response['body'];

			$parsed_obj = simplexml_load_string( $response );

			$items_array = array();
			if ( isset( $parsed_obj->entry ) ) {
				foreach ( $parsed_obj->entry as $video_xml ) {

					$this_item_array = array();

					$high_thumbnail_url = (string) $video_xml->children( 'http://search.yahoo.com/mrss/' )->group->thumbnail->attributes()->url;

					$this_item_array['snippet']    = array(
						'publishedAt'  => (string) $video_xml->published,
						'channelId'    => (string) $video_xml->children( 'http://www.youtube.com/xml/schemas/2015' )->channelId,
						'title'        => (string) $video_xml->title,
						'description'  => (string) $video_xml->children( 'http://search.yahoo.com/mrss/' )->group->description,
						'thumbnails'   => array(
							'default'  => array(
								'url' => (string) str_replace( 'hqdefault.jpg', 'default.jpg', $high_thumbnail_url ),
							),
							'medium'   => array(
								'url' => str_replace( 'hqdefault.jpg', 'mqdefault.jpg', $high_thumbnail_url ),
							),
							'high'     => array(
								'url'    => $high_thumbnail_url,
								'width'  => (string) $video_xml->children( 'http://search.yahoo.com/mrss/' )->group->thumbnail->attributes()->width,
								'height' => (string) $video_xml->children( 'http://search.yahoo.com/mrss/' )->group->thumbnail->attributes()->height,
							),
							'standard' => array(
								'url' => str_replace( 'hqdefault.jpg', 'sddefault.jpg', $high_thumbnail_url ),
							),
							'maxres'   => array(
								'url' => str_replace( 'hqdefault.jpg', 'maxresdefault.jpg', $high_thumbnail_url ),
							),
						),
						'channelTitle' => (string) $video_xml->author->name,
						'resourceId'   => array(
							'videoId' => (string) $video_xml->children( 'http://www.youtube.com/xml/schemas/2015' )->videoId
						),
					);
					$this_item_array['statistics'] = array(
						'viewCount'  => (int) $video_xml->children( 'http://search.yahoo.com/mrss/' )->group->community->statistics->attributes()->views,
						'starRating' => (float) $video_xml->children( 'http://search.yahoo.com/mrss/' )->group->community->starRating->attributes()->average,
					);
					$items_array[]                 = $this_item_array;

				}
			}

			$this->response = $items_array;

		} else {
			$this->response = $response;
		}

	}

	protected function set_url( $endpoint_slug, $params ) {
		if ( $endpoint_slug === 'playlistItems' ) {
			$url = 'https://www.youtube.com/feeds/videos.xml?channel_id=' . $params['channel_id'];
		} else {
			$url = 'https://www.youtube.com/feeds/videos.xml';
		}

		$this->set_url_from_args( $url );
	}


}