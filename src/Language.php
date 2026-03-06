<?php

/**
 * This file is part of OPUS. The software OPUS has been originally developed
 * at the University of Stuttgart with funding from the German Research Net,
 * the Federal Department of Higher Education and Research and the Ministry
 * of Science, Research and the Arts of the State of Baden-Wuerttemberg.
 *
 * OPUS 4 is a complete rewrite of the original OPUS software and was developed
 * by the Stuttgart University Library, the Library Service Center
 * Baden-Wuerttemberg, the Cooperative Library Network Berlin-Brandenburg,
 * the Saarland University and State Library, the Saxon State Library -
 * Dresden State and University Library, the Bielefeld University Library and
 * the University Library of Hamburg University of Technology with funding from
 * the German Research Foundation and the European Regional Development Fund.
 *
 * LICENCE
 * OPUS is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the Licence, or any later version.
 * OPUS is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details. You should have received a copy of the GNU General Public License
 * along with OPUS; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * @copyright   Copyright (c) 2026, OPUS 4 development team
 * @license     http://www.gnu.org/licenses/gpl.html General Public License
 */

namespace Opus\I18n;

use Locale;

/**
 * ISO-639 language.
 */
class Language
{
    /** @var string */
    private $part1b;

    /** @var string */
    private $part2t;

    /** @var string */
    private $part1;

    /** @var string */
    private $refName;

    public function __construct(array $language)
    {
        $this->part1b  = $language[0];
        $this->part2t  = $language[1];
        $this->part1   = $language[2];
        $this->refName = $language[3];
    }

    public function getPart2b(): string
    {
        return $this->part1b;
    }

    public function getPart2t(): string
    {
        return $this->part2t;
    }

    public function getPart1(): string
    {
        return $this->part1;
    }

    public function getRefName(): string
    {
        return $this->refName;
    }

    public function getDisplayName(?string $locale = null): string
    {
        return Locale::getDisplayName($this->part1b, $locale);
    }
}
