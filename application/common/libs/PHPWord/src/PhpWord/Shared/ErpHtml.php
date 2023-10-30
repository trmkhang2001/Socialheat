<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2016 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Shared;

use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\Style\Table;

/**
 * Common Html functions
 *
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod) For readWPNode
 */
class ErpHtml extends Html
{
    //public static $phpWord=null;

    /**
     *  Hold styles from parent elements,
     *  allowing child elements inherit attributes.
     *  So if you whant your table row have bold font
     *  you can do:
     *     <tr style="font-weight: bold; ">
     *  instead of
     *     <tr>
     *       <td>
     *           <p style="font-weight: bold;">
     *       ...
     *
     *  Before DOM element children are processed,
     *  the parent DOM element styles are added to the stack.
     *  The styles for each child element is composed by
     *  its styles plus the parent styles.
     */
    public static $stylesStack=null;
    private static $rowCounter = 0;
    private static $cellCounter = 0;
    private static $listResetStyle = 0;
    private  static   $isMerge = FALSE;
    private static $cellMergeIndex = [];
    private static $rowEndMerge = 0;
    private static $nodeStack = array();
    private static $gridSpan = array();
    private static $numberTable = 0;
    /**
     * Add HTML parts.
     *
     * Note: $stylesheet parameter is removed to avoid PHPMD error for unused parameter
     *
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element Where the parts need to be added
     * @param string $html The code to parse
     * @param bool $fullHTML If it's a full HTML, no need to add 'body' tag
     * @return void
     */
    public static function addHtml($element, $html, $style = array(), $fullHTML = false, $preserveWhiteSpace = true, $options = null)
    {
        /*
         * @todo parse $stylesheet for default styles.  Should result in an array based on id, class and element,
         * which could be applied when such an element occurs in the parseNode function.
         */
        self::$options = $options;
        // Preprocess: remove all line ends, decode HTML entity,
        // fix ampersand and angle brackets and add body tag for HTML fragments
        $html = str_replace(array("\n", "\r"), '', $html);
        $html = str_replace(array('&lt;', '&gt;', '&amp;'), array('_lt_', '_gt_', '_amp_'), $html);
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
        $html = str_replace('&', '&amp;', $html);
        $html = str_replace(array('_lt_', '_gt_', '_amp_'), array('&lt;', '&gt;', '&amp;'), $html);
        if (false === $fullHTML) {
            $html = '<body>' . $html . '</body>';
        }
        // Load DOM
        libxml_disable_entity_loader(true);
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = $preserveWhiteSpace;
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
//        $dom->loadXML($html);
        self::$xpath = new \DOMXPath($dom);
        $node = $dom->getElementsByTagName('body');
        self::parseNode($node->item(0), $element,$style);
    }


    protected static function parseNode($node, $element, $styles = array(), $data = array())
    {
        // Populate styles array
        $styleTypes = array('font', 'paragraph', 'list', 'table', 'row', 'cell'); //@change
        foreach ($styleTypes as $styleType) {
            if (!isset($styles[$styleType])) {
                $styles[$styleType] = array();
            }
        }

        // Node mapping table
        $nodes = array(
            // $method        $node   $element    $styles     $data   $argument1      $argument2
            'p'         => array('Paragraph',   $node,  $element,   $styles,    null,   null,           null),
            'h1'        => array('Heading',     $node,   $element,   $styles,    null,   'Heading1',     null),
            'h2'        => array('Heading',     $node,   $element,   $styles,    null,   'Heading2',     null),
            'h3'        => array('Heading',     $node,   $element,   $styles,    null,   'Heading3',     null),
            'h4'        => array('Heading',     $node,   $element,   $styles,    null,   'Heading4',     null),
            'h5'        => array('Heading',     $node,   $element,   $styles,    null,   'Heading5',     null),
            'h6'        => array('Heading',     $node,   $element,   $styles,    null,   'Heading6',     null),
            '#text'     => array('Text',        $node,  $element,   $styles,    null,    null,          null),
            'strong'    => array('Property',    null,   null,       $styles,    null,   'bold',         true),
            'em'        => array('Property',    null,   null,       $styles,    null,   'italic',       true),
            'i'         => array('Property',    null,   null,       $styles,    null,   'italic',       true),
            'u'         => array('Property',    null,   null,       $styles,    null,   'underline',    'single'),
            'sup'       => array('Property',    null,   null,       $styles,    null,   'superScript',  true),
            'sub'       => array('Property',    null,   null,       $styles,    null,   'subScript',    true),
            'span'      => array('Span',        $node,  null,       $styles,    null,   null,           null),
            'font'      => array('Span',        $node,  null,       $styles,    null,   null,           null),
            'table'     => array('Table',       $node,  $element,   $styles,    null,   'addTable',     true),
            'thead'     => array('Table',       $node,  $element,   $styles,    null,   'skipTbody',    true), //added to catch tbody in html.
            'tbody'     => array('Table',       $node,  $element,   $styles,    null,   'skipTbody',    true), //added to catch tbody in html.
            'tr'        => array('Table',       $node,  $element,   $styles,    null,   'addRow',       true),
            'td'        => array('Table',       $node,  $element,   $styles,    null,   'addCell',      true),
            'th'        => array('Table',       $node,  $element,   $styles,    null,   'addCell',      true),
            'ul'        => array('List',        $node,  $element,   $styles,    $data,  3,              null),
            'ol'        => array('List',        $node,  $element,   $styles,    $data,  7,              null),
            'li'        => array('ListItem',    $node,  $element,   $styles,    $data,  null,           null),
            'img'       => array('Image',       $node,  $element,   $styles,    null,   null,           null),
            'br'        => array('LineBreak',   null,   $element,   $styles,    null,   null,           null),
//            'a'         => array('Link',        $node,  $element,   $styles,    null,   null,           null),
        );

        $newElement = null;
        $keys = array('node', 'element', 'styles', 'data', 'argument1', 'argument2');

        if (isset($nodes[$node->nodeName])) {
//            if($node->nodeName != '#text')
//                array_push(self::$nodeStack, $node->nodeName);

            // Execute method based on node mapping table and return $newElement or null
            // Arguments are passed by reference
            $arguments = array();
            $args = array();
            list($method, $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]) = $nodes[$node->nodeName];
            for ($i = 0; $i <= 5; $i++) {
                if ($args[$i] !== null) {
                    $arguments[$keys[$i]] = &$args[$i];
                }
            }
            $method = "parse{$method}";
            $newElement = call_user_func_array(array('PhpOffice\PhpWord\Shared\ErpHtml', $method), $arguments);

            // Retrieve back variables from arguments
            foreach ($keys as $key) {
                if (array_key_exists($key, $arguments)) {
                    $$key = $arguments[$key];
                }
            }
        }

        if ($newElement === null) {
            $newElement = $element;
        }

        self::parseChildNodes($node, $newElement, $styles, $data);

        // After the parent element be processed,
        // its styles are removed from stack.
//        self::popStyles();
    }

    /**
     * Parse child nodes.
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array $styles
     * @param array $data
     * @return void
     */
    public static function parseChildNodes($node, $element, $styles, $data)
    {
        if(!in_array(end(self::$nodeStack), array('ol', 'ul', 'li', 'table', 'tbody', 'tr', 'td', 'th')))
            self::$listResetStyle = 0;

        if ($node->nodeName != 'li') {
            $cNodes = $node->childNodes;
            if (!empty($cNodes)) {
                if (count($cNodes) > 0) {
                    foreach ($cNodes as $cNode) {
                        // Added to get tables to work
                        $htmlContainers = array(
                        'tbody',
                            'tr',
                            'td',
                            'th'
                        );
                        if (in_array($cNode->nodeName, $htmlContainers)) {
                            self::parseNode($cNode, $element, $styles, $data);
                        }
                        // All other containers as defined in AbstractContainer
                        if ($element instanceof AbstractContainer) {
                            self::parseNode($cNode, $element, $styles, $data);
                        }
                    }
                }
            }
        }
    }

    /**
     * merge dong A1:A2 cell A1 vMerge restart cell A2 vMerge continue (merge dong dau tien vMerge luon = restart dong 2 luon continue)
     * @param \DOMNode $node
     * @param   \PhpOffice\PhpWord\Element\Table $element
     * @param array $styles
     * @param $argument1
     * @return AbstractContainer|\PhpOffice\PhpWord\Element\Table
     *
     */
    private static function parseTable($node, $element, &$styles, $argument1)
    {
		//echo "<pre>";print_r('chay');die;
        $newElement = '';
        $target = '';
        switch ($argument1) {
            case 'addTable':
                ++self::$numberTable;
                self::$cellMergeIndex = [];
                /**
                 * @var $element AbstractContainer|\PhpOffice\PhpWord\Element\Table
                 */
                $elementStyles = self::parseInlineStyle($node, $styles['table']);
                $newElement = $element->addTable($elementStyles);
                break;
            case 'skipTbody':
                $newElement = $element;
                break;
            case 'addRow':
                self::$rowCounter++;
                self::$cellCounter = 0;
                self::$isMerge = FALSE;
                $elementStyles = self::parseInlineStyle($node, $styles['row']);
                $elementStyles['exactHeight'] = true;
                $elementStyles['cantSplit'] = true;
                $newElement = $element->addRow(null, $elementStyles);
                /**
                 * them cell khi chuoi html thieu cell
                 */
                if(self::$rowEndMerge < self::$rowCounter){
                    self::$cellMergeIndex= [];
                }
                if ( self::$rowEndMerge >= self::$rowCounter) {

                    $gridSpan = [];
                    if(!empty(self::$gridSpan[self::$rowEndMerge])){
                        $gridSpan = self::$gridSpan[self::$rowEndMerge];
                    }
                    foreach (self::$cellMergeIndex as $key =>  $index){
                        $elementStyles['vMerge'] = "continue";
                       if(!empty($gridSpan[$index])){
                           $elementStyles['gridSpan'] = $gridSpan[$index];
                       }
                        $element->addCell(null,$elementStyles);
                        ++self::$cellCounter;
                    }

                }
                break;
            case 'addCell':
                $elementStyles = self::parseInlineStyle($node, $styles['cell']);
                $indexCell = ++self::$cellCounter;
                /**
                 * @var $node \DOMElement
                 */
                $colSpan = $node->getAttribute('colspan');
                if (!empty($colSpan)) {
                    $elementStyles['gridSpan'] = $colSpan;
                    self::$cellCounter =+ $colSpan;
//                    $elementStyles['vMerge'] = "continue";
                }
                $rowSpan = $node->getAttribute('rowspan');
                if (!empty($rowSpan)) {
                    self::$rowEndMerge =  self::$rowCounter + ($rowSpan -1);
                    array_push(self::$cellMergeIndex,$indexCell);
                    $elementStyles['vMerge'] = "restart";

//                    if(self::$isMerge == FALSE){
//                        self::$isMerge = TRUE;
//                    }
//                    elseif(self::$isMerge === TRUE){
//                        $elementStyles['vMerge'] = "restart";
////                        $elementStyles['vMerge'] = "continue";
//                    }
                    if($colSpan){
                       $gridSpan[$indexCell] = $colSpan;
                        self::$gridSpan[self::$rowEndMerge][$indexCell] = $colSpan;
                    }
                }

                $elementStyles['vAlign'] = "both";
                $cellStyles = self::recursiveParseStylesInHierarchy($node, $styles['cell']);
                $newStyles = array_merge($elementStyles,$cellStyles);
                $newElement = $element->addCell(null, $newStyles);
//                echo "<pre>";
//                print_r($node);
//

                if (self::shouldAddTextRun($node)) {
                    return $newElement->addTextRun(self::parseInlineStyle($node, $styles['paragraph']));
                }
                break;
        };
        return $newElement;
    }
}