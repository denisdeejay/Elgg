<?php
/**
 * Main content area layout
 *
 * @uses $vars['content']        HTML of main content area
 * @uses $vars['sidebar']        HTML of the sidebar
 * @uses $vars['header']         HTML of the content area header (override)
 * @uses $vars['nav']            HTML of the content area nav (override)
 * @uses $vars['footer']         HTML of the content area footer
 * @uses $vars['filter']         HTML of the content area filter (override)
 * @uses $vars['title']          Title text (override)
 * @uses $vars['context']        Page context (override)
 * @uses $vars['buttons']        Content header buttons (override)
 * @uses $vars['filter_context'] Filter context: everyone, friends, mine
 */

// give plugins an opportunity to add to content sidebars
$sidebar_content = elgg_get_array_value('sidebar', $vars, '');
$params = $vars;
$params['content'] = $sidebar_content;
$sidebar = elgg_view('content/sidebar', $params);

// navigation defaults to breadcrumbs
$nav = elgg_get_array_value('nav', $vars, elgg_view('navigation/breadcrumbs'));

// allow page handlers to override the default header
if (isset($vars['header'])) {
	$vars['header_override'] = $vars['header'];
}
$header = elgg_view('content/header', $vars);

// allow page handlers to override the default filter
if (isset($vars['filter'])) {
	$vars['filter_override'] = $vars['filter'];
}
$filter = elgg_view('content/filter', $vars);

// the all important content
$content = elgg_get_array_value('content', $vars, '');

// optional footer for main content area
$footer_content = elgg_get_array_value('footer', $vars, '');
$params = $vars;
$params['content'] = $footer_content;
$footer = elgg_view('content/footer', $params);

$body = $nav . $header . $filter . $content . $footer;

$params = array(
	'body' => $body,
	'sidebar' => $sidebar,
);
echo elgg_view_layout('one_sidebar', $params);