<?php

class Backing_track_model {

	/**
	 * Returns all backing tracks from the bands that match the band search criteria
	 * @param string $band
	 * @return array
	 */
	public function getBandTracks($band) {
		$tracks = array();

		$params = 'query=' . $band . '&searchtype=Artist';
		$html = Utils::getPageHtml('http://www.guitarbackingtrack.com/search.php', $params);

		#if there are results
		if (!preg_match('/No\s*matches,\s*please\s*check/is', $html) && !preg_match('/Please\s*enter\s*a\s*search\s*term/is', $html)) {

			#get the results table
			if (preg_match('/(<table\s+class="list".+?<\/table>)/is', $html, $matches)) {
				$table = $matches[0];

				#get each band result
				if (preg_match_all('/<td\s+class="list"><a\s+href="(.+?)">(.+?)<\//is', $table, $matches)) {
					#for each band - get all songs
					for ($i = 0; $i < count($matches[1]); $i++) {
						$link = 'http://www.guitarbackingtrack.com' . $matches[1][$i];
						$band = $matches[2][$i];

						$songs = $this->getSongsPerBand($link);
						foreach ($songs as $item) {
							$tracks[] = array(
								'band' => $band,
								'song' => $item['song'],
								'vocals' => $item['vocals'],
								'link' => $item['link']
							);
						}
					}
				}
			}
		}

		return $tracks;
	}

	/**
	 * Returns all backing tracks that match the song search criteria
	 * @param string $song
	 * @return array
	 */
	public function getSongTracks($song) {
		$tracks = array();

		$params = 'query=' . $song . '&searchtype=Song';
		$html = Utils::getPageHtml('http://www.guitarbackingtrack.com/search.php', $params);

		#get the results table
		if (preg_match('/(<table\s+class="list".+?<\/table>)/is', $html, $matches)) {
			$table = $matches[0];

			#get all songs
			if (preg_match_all('/(href=.+?)<\/td>/is', $table, $matches)) {
				foreach ($matches[0] as $cell) {
					$vocals = false;

					#get the song's data
					if (preg_match('/href="(.+?)">(.+?)<\/a>\s+-\s+<a\s+href="(.+?)">(.+?)<\/a>/is', $cell, $matches)) {
						$band = $matches[2];
						$link = 'http://www.guitarbackingtrack.com' . $matches[3];
						$song = $matches[4];

						if (preg_match('/<img\s+/is', $cell)) {
							$vocals = true;
						}

						$tracks[] = array(
							'band' => $band,
							'song' => $song,
							'vocals' => $vocals,
							'link' => $link
						);
					}
				}
			}
		}


		return $tracks;
	}

	/**
	 * Gets all songs from the specified band link
	 * @param string $band_link
	 * @return array
	 */
	private function getSongsPerBand($band_link) {
		$songs = array();
		$band_html = Utils::getPageHtml($band_link);

		#get the results table
		if (preg_match('/(<table\s+class="list".+?<\/table>)/is', $band_html, $matches)) {
			$table = $matches[0];

			#get all songs
			if (preg_match_all('/(href=.+?)<\/td>/is', $table, $matches)) {
				foreach ($matches[0] as $cell) {
					$vocals = false;

					#get the song link and name
					if (preg_match('/href="(.+?)">(.+?)<\//is', $cell, $matches)) {
						$link = 'http://www.guitarbackingtrack.com' . $matches[1];
						$song = $matches[2];

						#check for the vocals indicator
						if (preg_match('/<img\s+/is', $cell, $matches)) {
							$vocals = true;
						}

						$songs[] = array(
							'song' => $song,
							'link' => $link,
							'vocals' => $vocals
						);
					}
				}
			}
		}

		return $songs;
	}

}
