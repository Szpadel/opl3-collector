<?php
/*
 *  OPEN POWER LIBS <http://www.invenzzia.org>
 *
 * This file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE. It is also available through
 * WWW at this URL: <http://www.invenzzia.org/license/new-bsd>
 *
 * Copyright (c) Invenzzia Group <http://www.invenzzia.org>
 * and other contributors. See website for details.
 */
namespace Opl\Collector\Visit;
use Opl\Collector\LoaderInterface;

/**
 * This collector collects the basic information about the user host
 * and IP address.
 *
 * @author Tomasz Jędrzejewski
 * @copyright Invenzzia Group <http://www.invenzzia.org/> and contributors.
 * @license http://www.invenzzia.org/license/new-bsd New BSD License
 */
class HostLoader implements LoaderInterface
{
	/**
	 * @see LoaderInterface
	 */
	public function import()
	{
		// Find out, whether we are using IPv4 or IPv6
		$protocol = 4;
		if(substr_count($_SERVER['REMOTE_ADDR'], ':') > 0 && substr_count($_SERVER['REMOTE_ADDR'], '.') == 0)
		{
			$protocol = 6;
		}

		return array(
			'ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'not-set',
			'binaryIp' => isset($_SERVER['REMOTE_ADDR']) ? inet_pton($_SERVER['REMOTE_ADDR']) : inet_pton("0.0.0.0"),
			'ipVersion' => $protocol,
			'userAgent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'not-set'
		);
	} // end import();
} // end HostCollector;