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

namespace OpusTest\I18n;

use Opus\I18n\Language;
use Opus\I18n\Languages;
use PHPUnit\Framework\TestCase;

class LanguagesTest extends TestCase
{
    public function testGetLanguages()
    {
        $languages = new Languages();

        $this->assertCount(485, $languages->getAllAsArray());
    }

    public function testGetLanguage()
    {
        $expected = new Language(['ger', 'deu', 'de', 'German']);

        // Using part2_b
        $this->assertEquals($expected, Languages::getLanguage('ger'));

        // Using part2_t
        $this->assertEquals($expected, Languages::getLanguage('deu'));

        // Using part1
        $this->assertEquals($expected, Languages::getLanguage('de'));

        // Unknown language code
        $this->assertNull(Languages::getLanguage('zzz'));
    }

    public function testGetLanguageByPart2b()
    {
        $language = Languages::getLanguageByPart2b('ger');
        $this->assertEquals(new Language(['ger', 'deu', 'de', 'German']), $language);
        $this->assertNull(Languages::getLanguageByPart2b('zzz'));
    }

    public function testGetLanguageByPart2t()
    {
        $language = Languages::getLanguageByPart2t('fra');
        $this->assertEquals(new Language(['fre', 'fra', 'fr', 'French']), $language);
        $this->assertNull(Languages::getLanguageByPart2t('zzz'));
    }

    public function testGetLanguageByPart1()
    {
        $language = Languages::getLanguageByPart1('en');
        $this->assertEquals(new Language(['eng', 'eng', 'en', 'English']), $language);
        $this->assertNull(Languages::getLanguageByPart1('zzz'));
    }

    public function testLanguageCodeConflictsForGetLanguage()
    {
        $languages = new Languages();
        $langCodes = $languages->getAllAsArray();

        foreach ($langCodes as $language) {
            if ($language[0] !== $language[1]) {
                $this->assertNull(Languages::getLanguageByPart2b($language[1]));
            }
        }
    }

    public function testGetPart1()
    {
        $this->assertEquals('de', Languages::getPart1('ger'));
        $this->assertEquals('de', Languages::getPart1('deu'));
        $this->assertEquals('de', Languages::getPart1('de'));

        $this->assertNull(Languages::getPart1('zzz'));
        $this->assertNull(Languages::getPart1(null));
    }

    public function testGetPart1WithDefault()
    {
        $this->assertEquals('fr', Languages::getPart1('zzz', 'fr'));
        $this->assertEquals('fr', Languages::getPart1(null, 'fr'));
    }

    public function testGetPart2t()
    {
        $this->assertEquals('fra', Languages::getPart2t('fre'));
        $this->assertEquals('fra', Languages::getPart2t('fra'));
        $this->assertEquals('fra', Languages::getPart2t('fr'));

        $this->assertNull(Languages::getPart2t('zzz'));
        $this->assertNull(Languages::getPart2t(null));
    }

    public function testGetPart2tWithDefault()
    {
        $this->assertEquals('fra', Languages::getPart2t('zzz', 'fra'));
        $this->assertEquals('fra', Languages::getPart2t(null, 'fra'));
    }

    public function testGetPart2b()
    {
        $this->assertEquals('fre', Languages::getPart2b('fre'));
        $this->assertEquals('fre', Languages::getPart2b('fra'));
        $this->assertEquals('fre', Languages::getPart2b('fr'));

        $this->assertNull(Languages::getPart2b('zzz'));
        $this->assertNull(Languages::getPart2b(null));
    }

    public function testGetPart2bWithDefault()
    {
        $this->assertEquals('fre', Languages::getPart2b('zzz', 'fre'));
        $this->assertEquals('fre', Languages::getPart2b(null, 'fre'));
    }
}
