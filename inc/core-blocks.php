<?php
// Gutenberg Core Block Modifications
// These modifications change the core blocks to match the theme

/**
 * Add Class To Elements
 * Uses DOMDocument to add a class to an element with another class
 *
 * @param DOMXPath $xpath The DOMXpath Object
 * @param string $classReference The className for the element you are trying to target
 * @param string $classToAdd The className you are trying to add to the target element
 *
 * @return void
 */
function addClass(DOMXPath $xpath, string $classReference, string $classToAdd): void {
	// If $classReference is referring to an element
	if (is_html_tag($classReference)) {
		$elements = $xpath->query("//$classReference");
	} else {
		$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), '$classReference')]");
	}
	foreach ($elements as $element) {
		$currentClass = $element->getAttribute('class');
		$element->setAttribute('class', $currentClass . ' ' . $classToAdd);
	}
}

/**
 * Limit Text Length
 * Uses DOMDocument to Limit the text length of text
 *
 * @param DOMXPath $xpath
 * @param string $classReference
 * @param int $maxLength
 *
 * @return void
 */
function limitTextLength(DOMXPath $xpath, string $classReference, int $maxLength): void {
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), '$classReference')]");
	foreach ($elements as $element) {
		$text = $element->nodeValue;
		if (strlen($text) > $maxLength) {
			$element->nodeValue = substr($text, 0, $maxLength) . '...';
		}
	}
}

/**
 * Add Parent Elements
 * Add a parent element around all elements with a specific class
 *
 * @param DOMDocument $dom The DOMDocument Object
 * @param DOMXPath $xpath The DOMXpath Object
 * @param string $childClassReference The className for the child element you are trying to nest
 * @param string $parentTag The tag for the parent element
 * @param array|null $attributes The attributes for the parent element
 *
 * @return void
 * @throws DOMException
 */
function addParent(DOMDocument $dom, DOMXPath $xpath, string $childClassReference, string $parentTag, array $attributes = null): void {

	// If $classReference is referring to an element
	if (is_html_tag($childClassReference)) {
		$childElements = $xpath->query("//$childClassReference");
	} else {
		$childElements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), '$childClassReference')]");
	}

	foreach ($childElements as $targetElement) {

		// Create a parent element to insert the clone into
		$parentElement = $dom->createElement($parentTag);

		// Add attributes to the parent element
		if ($attributes) {
			foreach ( $attributes as $attribute ) {
				foreach ( $attribute as $key => $value ) {
					$parentElement->setAttribute( $key, $value );
				}
			}
		}

		// Clone the target element
		$clonedTargetElement = $targetElement->cloneNode(true);

		// Append the cloned element to the new parent element
		$parentElement->appendChild($clonedTargetElement);

		// Replace the original target element with the new parent element
		$targetElement->parentNode->replaceChild($parentElement, $targetElement);
	}
}

/**
 * Move Elements into Parent Elements
 * Move all elements of a specific class into elements of a different class on the same level
 *
 * @param DOMDocument $dom The DOMDocument Object
 * @param DOMXPath $xpath The DOMXpath Object
 * @param string $childClassReference The class of the elements you're trying to target
 * @param string $parentClassReference The class of the parent element you are trying to move into
 *
 * @return void
 */
function moveIntoParent(DOMDocument $dom, DOMXPath $xpath, string $childClassReference, string $parentClassReference) : void {

	// Find all child elements
	$childElements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), '$childClassReference')]");

	foreach ($childElements as $childElement) {

		// Find sibling elements to become parents
		$siblingElements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), '$parentClassReference')]");
		$siblingFound = false;

		foreach ($siblingElements as $siblingElement) {

			// Check if the sibling element has the same parent as the target element
			if ( $siblingElement->parentNode === $childElement->parentNode ) {
				$parentElement = $siblingElement;
				$siblingFound = true;
				break;
			}
		}

		if ($siblingFound && isset($parentElement)) {

			// Clone the target element
			$clonedElement = $childElement->cloneNode(true);

			// Append the cloned element to the target element
			$parentElement->appendChild($clonedElement);

			//Remove the source element
			$childElement->parentNode->removeChild($childElement);
		}
	}
}

/**
 * Replace tags
 * Change the tag of elements that match a class into a different tag
 *
 * @param DOMDocument $dom The DOMDocument Object
 * @param DOMXPath $xpath The DOMXpath Object
 * @param string $classReference The class of the elements you're trying to target
 * @param string $newElementTag The tag to replace the target element with
 *
 * @return void
 */
function replaceTag(DOMDocument $dom, DOMXPath $xpath, string $classReference, string $newElementTag) : void {

	// Find all elements with the specified class
	$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), '$classReference')]");

	foreach ($elements as $element) {

		// Create a new element of the desired type
		try {
			$newElement = $dom->createElement( $newElementTag );

			// Clone the original element's attributes and content into the new element
			foreach ($element->attributes as $attribute) {
				$newElement->setAttribute($attribute->name, $attribute->value);
			}
			$newElement->nodeValue = $element->nodeValue;

			// Replace the original element with the new one
			$element->parentNode->replaceChild($newElement, $element);

		} catch ( DOMException $e ) {
			echo '<div class="alert alert-error" role="alert">createElement Failed!<br>' . $e . '</div>';
		}
	}
}

/**
 * Render_Block Filter
 * Modify existing Gutenberg Blocks to support the theme
 *
 * @param string $hook_name WordPress Filter Hook type
 */
add_filter('render_block', function ($block_content, $block) {

	try {
		$dom = new DOMDocument();
		@$dom->loadHTML('<?xml encoding="utf-8"?>' . $block_content);
		$xpath = new DOMXPath($dom);

		// Files
		if ($block['blockName'] === 'core/file') {
			addClass($xpath, 'a', 'btn btn-orange');
		}

		// Latest Posts
		if ($block['blockName'] === 'core/latest-posts') {

			// Restrict title to 80 characters
			limitTextLength($xpath, 'wp-block-latest-posts__post-title', 80);

			// Restructure the post meta
			addParent($dom, $xpath, 'wp-block-latest-posts__post-author', 'ul', [[ 'class' => 'latest-post-meta text-muted list-inline']]);
			moveIntoParent($dom, $xpath, 'wp-block-latest-posts__post-date', 'latest-post-meta');
			replaceTag($dom, $xpath, 'wp-block-latest-posts__post-author', 'li');
			addClass($xpath, 'wp-block-latest-posts__post-author', 'list-inline-item');
			addParent($dom, $xpath, 'wp-block-latest-posts__post-date', 'li', [[ 'class' => 'list-inline-item']]);
		}

		// Quote Block
		if ($block['blockName'] === 'core/quote') {
			addParent($dom, $xpath, 'wp-block-quote', 'figure');
			addClass($xpath, 'wp-block-quote', 'blockquote');
			addParent($dom, $xpath, 'cite', 'figcaption', [['class' => 'blockquote-footer']]);
		}

		// Tables
		if ($block['blockName'] === 'core/table') {
			addClass($xpath, 'table', 'table');
			addClass($xpath, 'wp-element-caption', 'text-muted');
		}

		// Search
		if ($block['blockName'] === 'core/search') {
			addClass($xpath, 'wp-block-search__label', 'form-label');
			addClass($xpath, 'wp-block-search__input', 'form-control form-control-orange');
			addClass($xpath, 'wp-element-button', 'btn btn-orange');
		}

		// Output the updated content
		return preg_replace('/<\?xml.*\?>/','', $dom->saveHTML());

	} catch (Exception $e) {
		echo '<div class="alert alert-error" role="alert">PHP extension DOM is missing!<br>' . $e . '</div>';
	}

	return $block_content;

}, 10, 2);