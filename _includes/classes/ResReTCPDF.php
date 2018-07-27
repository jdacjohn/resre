<?php
namespace resre;
/*
 * resre
 * ResReTCPDF
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Jul 26, 2018 8:37:21 AM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

/**
 * Description of ResReTCPDF
 *
 * @author John Arnold <john@jdacsolutions.com>
 */
class ResReTCPDF extends \TCPDF {
    //put your code here
    
    /**
     * Set header data.
     * @param string $logoFileName - header image logo
     * @param int $logoWidth - header image logo width in mm
     * @param string $title - string to print as title on document header
     * @param string $headerString - string to print on document header
     * @param string $headerSubject - The subject to be printed under the header string
     * @param array $textColor - RGB array color for text.
     * @param array $lineColor - RGB array color for line.
     * @public
     */
    public function setHeaderData($logoFileName = '', $logoWidth = 0, $title = '', $headerString = '', $headerSubject = '', $textColor = array(0, 0, 0), $lineColor = array(0, 0, 0)) {
        $this->header_logo = ($logoFileName == '') ? PDF_HEADER_LOGO : $logoFileName;
        $this->header_logo_width = ($logoWidth == 0) ? PDF_HEADER_LOGO_WIDTH : $logoWidth;
        $this->header_title = $title;
        $this->header_string = $headerString;
        $this->subject = $headerSubject;
        $this->header_text_color = $textColor;
        $this->header_line_color = $lineColor;
    }

        /**
     * Returns header data:
     * <ul><li>$ret['logo'] = logo image</li><li>$ret['logo_width'] = width of the image logo in user units</li><li>$ret['title'] = header title</li><li>$ret['string'] = header description string</li></ul>
     * @return array()
     * @public
     * @since 4.0.012 (2008-07-24)
     */
    public function getHeaderData() {
        $ret = array();
        $ret['logo'] = $this->header_logo;
        $ret['logo_width'] = $this->header_logo_width;
        $ret['title'] = $this->header_title;
        $ret['string'] = $this->header_string;
        $ret['subject'] = $this->subject;
        $ret['keywordString'] = $this->keywords;
        $ret['text_color'] = $this->header_text_color;
        $ret['line_color'] = $this->header_line_color;
        return $ret;
    }

    /**
     *  Returns the header subject
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }
    
    /**
     * This method is used to render the page header.
     * It is automatically called by AddPage() and could be overwritten in your own inherited class.
     * @public
     */
    public function Header() {
        if ($this->header_xobjid === false) {
            // start a new XObject Template
            $this->header_xobjid = $this->startTemplate($this->w, $this->tMargin);
            $headerfont = $this->getHeaderFont();
            $headerdata = $this->getHeaderData();
            $this->y = $this->header_margin;
            if ($this->rtl) {
                $this->x = $this->w - $this->original_rMargin;
            } else {
                $this->x = $this->original_lMargin;
            }
            if (($headerdata['logo']) AND ( $headerdata['logo'] != K_BLANK_IMAGE)) {
                $imgtype = \TCPDF_IMAGES::getImageFileType(K_PATH_IMAGES . $headerdata['logo']);
                if (($imgtype == 'eps') OR ( $imgtype == 'ai')) {
                    $this->ImageEps(K_PATH_IMAGES . $headerdata['logo'], '', '', $headerdata['logo_width']);
                } elseif ($imgtype == 'svg') {
                    $this->ImageSVG(K_PATH_IMAGES . $headerdata['logo'], '', '', $headerdata['logo_width']);
                } else {
                    $this->Image(K_PATH_IMAGES . $headerdata['logo'], '', '', $headerdata['logo_width']);
                }
                $imgy = $this->getImageRBY();
            } else {
                $imgy = $this->y;
            }
            $cell_height = $this->getCellHeight($headerfont[2] / $this->k);
            // set starting margin for text data cell
            if ($this->getRTL()) {
                $header_x = $this->original_rMargin + ($headerdata['logo_width'] * 1.1);
            } else {
                $header_x = $this->original_lMargin + ($headerdata['logo_width'] * 1.1);
            }
            $cw = $this->w - $this->original_lMargin - $this->original_rMargin - ($headerdata['logo_width'] * 1.1);
            $this->SetTextColorArray($this->header_text_color);
            // header title
            $this->SetFont($headerfont[0], 'B', $headerfont[2] + 1);
            $this->SetX($header_x);
            $this->Cell($cw, $cell_height, $headerdata['title'], 0, 1, 'R', 0, '', 0);
            // Change text color to slate now
            $this->SetTextColor(26,45,60);
            // header string
            $this->SetFont($headerfont[0], $headerfont[1], $headerfont[2]);
            $this->SetX($header_x);
            $this->MultiCell($cw, $cell_height, $headerdata['string'], 0, 'R', 0, 1, '', '', true, 0, false, true, 0, 'M', false);
            // header keyword title
            $this->SetFont($headerfont[0], $headerfont[1], $headerfont[2]);
            $this->SetX($header_x);
            $this->MultiCell($cw, $cell_height, $headerdata['keywordString'], 0, 'R', 0, 1, '', '', true, 0, false, true, 0, 'B', false);
            // print an ending header line
            $this->SetLineStyle(array('width' => 0.85 / $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
            $this->SetY((2.835 / $this->k) + max($imgy, $this->y));
            if ($this->rtl) {
                $this->SetX($this->original_rMargin);
            } else {
                $this->SetX($this->original_lMargin);
            }
            $this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
            $this->endTemplate();
        }
        // print header template
        $x = 0;
        $dx = 0;
        if (!$this->header_xobj_autoreset AND $this->booklet AND ( ($this->page % 2) == 0)) {
            // adjust margins for booklet mode
            $dx = ($this->original_lMargin - $this->original_rMargin);
        }
        if ($this->rtl) {
            $x = $this->w + $dx;
        } else {
            $x = 0 + $dx;
        }
        $this->printTemplate($this->header_xobjid, $x, 0, 0, 0, '', '', false);
        if ($this->header_xobj_autoreset) {
            // reset header xobject template at each page
            $this->header_xobjid = false;
        }
    }

    /**
     * This method is used to render the page footer.
     * It is automatically called by AddPage() and could be overwritten in your own inherited class.
     * @public
     */
    public function Footer() {
        $cur_y = $this->y;
        $this->SetTextColorArray($this->footer_text_color);
        //set style for cell border
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));

        $w_page = isset($this->l['w_page']) ? $this->l['w_page'] . ' ' : '';
        if (empty($this->pagegroups)) {
            $pagenumtxt = $w_page . $this->getAliasNumPage() . ' / ' . $this->getAliasNbPages();
        } else {
            $pagenumtxt = $w_page . $this->getPageNumGroupAlias() . ' / ' . $this->getPageGroupAlias();
        }

        $this->SetY($cur_y);
        $this->SetX($this->original_rMargin);
        $time = time();
        // Print date
        //Print date and page number
        if ($this->getRTL()) {
            $this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
        } else {
            $this->Cell(20,0, date("d F Y H:i:s", $time), 'T', 0, 'L');
            $this->Cell(0, 0, $this->getAliasRightShift() . $pagenumtxt, 'T', 0, 'R');            
        }
    }
    
}
