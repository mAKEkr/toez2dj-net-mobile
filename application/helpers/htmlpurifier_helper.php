<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Codeigniter HTMLPurifier Helper
 *
 * Purify input using the HTMLPurifier standalone class.
 * Easily use multiple purifier configurations.
 *
 * @author     Tyler Brownell <tyler@bluefoxstudio.ca>
 * @copyright  Public Domain
 * @license    http://bluefoxstudio.ca/release.html
 *
 * @access  public
 * @param   string or array
 * @param   string
 * @return  string or array
 */
if (! function_exists('html_purify'))
{
	function html_purify($dirty_html, $config = FALSE)
	{
		require_once APPPATH . 'third_party/HTMLPurifier/HTMLPurifier.standalone.php';

		if (is_array($dirty_html))
		{
			foreach ($dirty_html as $key => $val)
			{
				$clean_html[$key] = html_purify($val, $config);
			}
		}

		else
		{
			switch ($config)
			{
				case 'document':
					$config = HTMLPurifier_Config::createDefault();
					$config->set('Core.Encoding', 'UTF-8');
					$config->set('HTML.Doctype', 'HTML 4.0');
					$config->set('HTML.SafeEmbed', true);
					$config->set('HTML.SafeIframe', true);
					$config->set('URI.SafeIframeRegexp','%^http://(www.youtube.com/embed/|player.vimeo.com/video/|w.soundcloud.com/player/|serviceapi.nmv.naver.com/flash/convertIframeTag.nhn|videofarm.daum.net/controller/video/viewer/Video.html)%');
					$config->set('HTML.Allowed', 'p, br, strong, a[href|title], em, img[src|alt|title], embed[src|type|allowscriptaccess|allowfullscreen|width|height], iframe[src|width|height|frameborder|allowfullscreen|scrolling], b, font, table, s, strike, center');
					$config->set('AutoFormat.AutoParagraph', TRUE);
					$config->set('AutoFormat.Linkify', TRUE);
					$config->set('AutoFormat.RemoveEmpty', TRUE);
				break;

				case FALSE:
					$config = HTMLPurifier_Config::createDefault();
					$config->set('Core.Encoding', 'utf-8');
					$config->set('HTML.Doctype', 'XHTML 1.1');
				break;

				default:
					show_error('The HTMLPurifier configuration labeled "' . htmlentities($config, ENT_QUOTES, 'UTF-8') . '" could not be found.');
			}

			$purifier = new HTMLPurifier($config);
			$clean_html = $purifier->purify($dirty_html);
		}

		return $clean_html;
	}
}

/* End of htmlpurifier_helper.php */
/* Location: ./application/helpers/htmlpurifier_helper.php */