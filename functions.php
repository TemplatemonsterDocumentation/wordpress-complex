<?php

if ( false === function_exists( 'get_projects_list' ) ) {
	/**
	 * Get projects json configuration
	 * @return array
	 */
	function get_projects_list() {
		$projectsJSON = get_path( 'projects.json', true );
		if ( ! file_exists( $projectsJSON ) ) {
			//return array();
		}
		return json_decode( file_get_contents( $projectsJSON ), true );
	}
}

if ( false === function_exists( 'get_docroot' ) ) {
	/**
	 * Get relative directory
	 * @return string
	 */
	function get_relative_path() {
		return RELATIVE_DIR;
	}
}

if ( false === function_exists( '_fix_path_chunks' ) ) {
	function _fix_path_chunks( $chunk ) {
		return str_replace( array( '\\', '//', '\/' ), '/', $chunk );
	}
}

if ( false === function_exists( 'join_path' ) ) {
	function join_path( $arg1, $arg2 = '', $argN = '' ) {
		$chunks = array_map( '_fix_path_chunks', func_get_args() );
		return join( '/', $chunks );
	}
}

if ( false === function_exists( 'get_path' ) ) {
	/**
	 * Get relative path to a directory/file
	 * @param  string  $path         Path to a directory/file
	 * @param  boolean $use_doc_root Use document root or relative path?
	 * @return string
	 */
	function get_path( $path, $use_doc_root = false ) {
		$doc_root = DOCUMENT_ROOT;
		if ( ! $use_doc_root ) {
			$doc_root = get_relative_path();
		}
		return join_path( preg_replace( '/(\/)+$/', '', $doc_root ), preg_replace( '/^(\/+)/', '', $path ) );
	}
}

/**
 * Get sections array from section.json file
 * @param  string $project Project name
 * @return array
 */
function getSections($project, $defaultProject)
{
	$sections_json_file = get_path( 'sections.json', true );
	if (file_exists($sections_json_file)) {
		$sections_string = file_get_contents($sections_json_file);
		$sections_array = json_decode($sections_string, true);

		$active_sections = $defaultProject;
		if (array_key_exists($project, $sections_array)) {
			$active_sections = $project;
		}
		return $sections_array[$active_sections];
	} else {
		die('sections.json file not found');
	}
}


/**
 * Generates navigation markup
 * @param  array  $sections Sections data array
 * @param  string $lang     Current language key
 * @return string           Navigation markup string
 */
function generateNavigation($sections, $lang, $section_param, $project, $defaultProject)
{
	$html = '';

	foreach ($sections as $section_key => $section_dirname) {
		$section_json_file = get_path( "/sections/{$section_dirname}/section.json", true );
		// Check if section json file exists
		if (file_exists($section_json_file)):
			$section_string 	= file_get_contents($section_json_file);
			$current_section 	= json_decode($section_string, true);

			$proj = $defaultProject;
			if (array_key_exists($project, $current_section['articles'])) {
				$proj = $project;
			}

			if (empty($current_section)) {
				echo "<i>Section $section_dirname JSON empty or formatted wrong</i>";
			}

			$section_id 		= $current_section['id'];
			$section_title 		= $current_section['translations'][$lang];
			$section_path 		= 'index.php?project='. $proj . '&lang=' . $lang . '&section=' . $section_id;

			$target = '';
			$icon   = '';

			// Active class
			$active_class = '';
			if (isset($_GET['section']) && $section_id == $_GET['section']) {
				$active_class = ' opened';
			}

			if ( ! empty( $current_section['custom_link'] ) ) {
				$section_path = $current_section['custom_link'];
				$target       = ' target="_blank"';
			}

			if ( ! empty( $current_section['icon'] ) ) {
				$icon = sprintf( '<i class="%s"></i>', $current_section['icon'] );
			}

			// Get Articles List
			$section_articles 	= $current_section['articles'][$proj];

			$html .= '<li class="section section__' . $section_id . '"><a class="section_link' . $active_class .'" href="' . $section_path .'" data-key="' . $section_key . '"  data-id="' . $section_id . '"' . $target . '>' . $section_title . ' ' . $icon . '</a>';

				// Generate articles navigation
				if (!empty($section_articles)) {
					$html .= '<ul>';
					foreach ($section_articles as $key => $article) {
						$article_id 	= $article['id'];
						$article_name 	= $article['translations'][$lang];

						$article_path	= '#' . $article_id;
                        // Update article path if first in article section
                        if ($key == 0) {
                            $article_path = 'index.php?project=' . $proj. '&lang=' . $lang . '&section=' . $section_id .'#';
                        }
                        // Update article path if not in article section
                        else if ($section_param != $section_id) {
							$article_path = 'index.php?project=' . $proj. '&lang=' . $lang . '&section=' . $section_id . '#' . $article_id;
						}
						$html .= '<li class="article article__' . $article_id . '"><a class="article_link" href="' . $article_path . '" data-sectionId="' . $section_key . '" data-id="' . $article_id . '" data-section="' . $section_id . '">' . $article_name . '</a></li>';
					}
					$html .= '</ul>';
				}
			$html .= '</li>';
		else:
			die("Section $section_dirname JSON file not found");
		endif;

	}
	return $html;
}

/**
 * Includes articles files
 * @param  array  $sections      	Array with sections data
 * @param  string $lang          	Current language
 * @param  string $section_param 	Current section
 */
function includeSection($sections, $lang, $section_param, $project, $defaultProject)
{
	$section_json_file = get_path( "/sections/{$section_param}/section.json", true );

	if (file_exists($section_json_file)):
		$section_string 	= file_get_contents($section_json_file);
		$current_section 	= json_decode($section_string, true);

		$section_id 		= $current_section['id'];

		$proj = $defaultProject;
		if (array_key_exists($project, $current_section['articles'])) {
			$proj = $project;
		}
		$section_articles 	= $current_section['articles'][$proj];

		echo "<section id='" . $section_id . "'>";

			//Define description filename depending on project title
			$section_desc = get_path( "/sections/{$section_param}/{$lang}/__description_{$project}.php", true );

			if (file_exists($section_desc)) {
				echo "<article class='description'>";
					include_once $section_desc;
				echo "</article>";
			} else {
				// Load default description file if no project description file defined
				$section_desc = get_path( "/sections/{$section_param}/{$lang}/__description.php", true );
				if (file_exists($section_desc)) {
					echo "<article class='description'>";
						include_once $section_desc;
					echo "</article>";
				} else {
					echo "<i>Section description.php file is missing.</i>";
				}
			}

			foreach ($section_articles as $key => $article) {
				$article_id = $article['id'];
				echo "<article id='" . $article_id . "'>";
					$article_path = get_path( "/sections/{$section_param}/{$lang}/{$article_id}.php", true );
					if (file_exists($article_path)) {
						include_once $article_path;
					} else {
						echo "<i>Article $article_id not found.</i>";
					}
				echo "</article>";
			}
		echo "</section>";
	else:
		die("Section.json file in \"$section_param\" directory not found");
	endif;
}

/**
 * Documentation Search
 * @param  string $dir 	Documentation sections directory
 * @return array 		Array with files, that contain search request value
 */
function search_dir($dir)
{
	global $request, $seen;

	$dirs = array();
	$pages = array();

	$regex = "/" . preg_quote($request,'/') . "/";
	$seen[] = realpath($dir);

	if (is_readable($dir) && ($d = dir($dir))) {

		while (false != ($f = $d->read())) {
			$path = $d->path . '/' . $f;

			if (is_file($path) && is_readable($path)) {
				$realpath = realpath($path);

				if (in_array($realpath, $seen)) {
					continue;
				} else {
					$seen[] = $realpath;
				}

				$file = join(' ', file($path));

				if (preg_match($regex, $file)) {
					if ('json' != substr($path, strrpos($path, '.') + 1 )) {
						$path_array = explode('/', $path);
						$sect_name = substr($path_array[3], 0, strpos($path_array[3], '.'));

						if ($sect_name == '__description') {
							$sect_hash = '';
						} else {
							$sect_hash = '#' . $sect_name;
						}

						array_push($pages, array(
							'lang' => $path_array[2],
							'section' => $path_array[1],
							'hash' => $sect_hash,
							)
						);
					}
				}

			} else {
				if (is_dir($path) && ('.' != $f) && ('..' != $f)) {
					array_push($dirs, $path);
				}
			}
		}
		$d->close();
	}

	foreach ($dirs as $subdir) {
		$realdir = realpath($subdir);

		if (!in_array($realdir, $seen)) {
			$seen[] = $realdir;
			$pages = array_merge($pages, search_dir($subdir));
		}
	}

	return $pages;
}

/**
 * Check if parameter value is allowed
 * @param  $_REQUEST Request parameter
 * @param  array $allowed_params Allowed parameter values
 * @return string Parameter value
 */
function allowedParameterValue($param, $allowed_params)
{
    if ($param) {
        if (in_array($param, $allowed_params)) {
            return $param;
        } else {
            return $allowed_params[0];
        }
    }
}
