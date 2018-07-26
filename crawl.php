<?php
	include('classes/DomDocumentParser.php');

	$alreadyCrawled = array();
	$crawling = array();

	function createLink($src, $url) {
		$scheme = parse_url($url)['scheme'];
		$host = parse_url($url)['host'];

		if (substr($src, 0, 2) == '//') {
			$src = $scheme . ':' . $src;
		} else if (substr($src, 0, 1) == '/') {
			$src = $scheme . '://' . $host . $src;
		} else if (substr($src, 0, 2) == './') {
			$src = $scheme . '://' . $host . dirname(parse_url($url)['path']) . substr($src, 1);
		} else if (substr($src, 0, 3) == '../') {
			$src = $scheme . '://' . $host . '/' . $src;
		} else if (substr($src, 0 , 5) != 'https' && substr($src, 0, 4) != 'http') {
			$src = $scheme . '://' . $host . '/' . $src;
		}

		return $src;
	}

	function getDetails($url) {
		$parser = new DomDocumentParser($url);

		$titleArray = $parser->getTitleTags();

		if (sizeof($titleArray) == 0 || $titleArray->item(0) == NULL) {
			return;
		}

		$title = $titleArray->item(0)->nodeValue;
		$title = str_replace("\n", '', $title);

		if ($title == '') {
			return;
		}

		$description = '';
		$keywords = '';

		$metaTagArray = $parser->getMetaTags();

		foreach ($metaTagArray as $metaTag) {
			if ($metaTag->getAttribute("name") == "description") {
				$description = $metaTag->getAttribute("content");
			}

			if ($metaTag->getAttribute("name") == "keywords") {
				$keywords = $metaTag->getAttribute("content");
			}
		}

		$description = str_replace("\n", '', $description);
		$keywords = str_replace("\n", '', $keywords);
	}

	function followLinks($url) {
		global $alreadyCrawled, $crawling;

		$parser = new DomDocumentParser($url);

		$linkList = $parser->getLinks();

		foreach ($linkList as $link) {
			$href = $link->getAttribute("href");

			if (strpos($href, '#') !== false) {
				continue;
			} else if (substr($href, 0, 11) == 'javascript:') {
				continue;
			}

			$href = createLink($href, $url);

			if (!in_array($href, $alreadyCrawled)) {
				$alreadyCrawled[] = $href;
				$crawling[] = $href;

				getDetails($href);
			} else {
				return;
			}
		}

		array_shift($crawling);

		foreach ($crawling as $site) {
			followLinks($site);
		}
	}

	$startUrl = 'http://www.bbc.com';

	followLinks($startUrl);
?>
