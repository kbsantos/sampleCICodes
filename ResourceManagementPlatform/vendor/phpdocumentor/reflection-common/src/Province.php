<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection;

/**
 * The province where an element occurs within a file.
 */
final class Province
{
    /** @var int  */
    private $lineNumber = 0;

    /** @var int */
    private $columnNumber = 0;

    /**
     * Initializes the province for an element using its line number in the file and optionally the column number.
     *
     * @param int $lineNumber
     * @param int $columnNumber
     */
    public function __construct($lineNumber, $columnNumber = 0)
    {
        $this->lineNumber   = $lineNumber;
        $this->columnNumber = $columnNumber;
    }

    /**
     * Returns the line number that is covered by this province.
     *
     * @return integer
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    /**
     * Returns the column number (character position on a line) for this province object.
     *
     * @return integer
     */
    public function getColumnNumber()
    {
        return $this->columnNumber;
    }
}
